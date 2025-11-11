<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header" id="edit-user-header">
                <h2>Edit User</h2>
 
                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        User updated successfully, will redirect to the user listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <div class="card card-primary col-md-6" style="padding: 0 0 0 0;">
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>

                <form @submit.prevent="updateData()">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-user-name">Name<span style="color: red;"> *</span></label>
                            <input type="text" v-model="form.name" class="form-control" id="inputUserName" required />
                        </div>

                        <div class="form-group">
                            <label for="input-email">Email address<span style="color: red;"> *</span></label>
                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" required readonly />
                        </div>

                        <div class="form-group">
                            <label for="input-password">Password</label>
                            <input type="password" v-model="form.password" class="form-control" id="inputPassword" @input="checkPassword" />
                            <div class="invalid_input">Password and confirm password does not match!</div>
                        </div>

                        <div class="form-group">
                            <label for="input-confirm-password">Confirm password</label>
                            <input type="password" v-model="form.confirm_password" class="form-control" id="inputConfirmPassword" @input="checkPassword" />
                            <div class="invalid_input">Password and confirm password does not match!</div>
                        </div>
                    </div>

                    <div class="card-footer" style="display: row; justify-content: space-between;">
                        <router-link to="/customers" class="btn btn-primary btn-add" style="float: left; background-color: #ccc; border-color: transparent;">Cancel</router-link>
                        <button type="submit" class="btn btn-success" style="float: right;" :disabled="disabled">
                            Save <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
    import { Form } from 'vform';
    import Spinner from "../Spinner.vue";
    import countryList from 'country-list';

    export default {
        props: {
            user: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                timeoutId: null,
                selectedCountry: ["cn", "my"],
                counter: 5,
                disabled: false,
                loading: false,
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    confirm_password: '',
                }),
            }
        },
        computed: {
            
        },
        mounted() {
            this.form.reset();
            this.timeoutId = null;
            const currentUrl = window.location.href;
            const userId = currentUrl.split("show/");
            
            axios.get(`/user/edit/${userId[1]}`)
                .then(response => {
                    if (response.data.statusCode === 200) {
                        const userInfo = response.data.data;

                        // parse the data to the form
                        this.form.name = userInfo.name;
                        this.form.email = userInfo.email;
                    } else {
                        Swal.fire(
                            "500",
                            "Internal server error, please contact the service provider!",
                            "warning"
                        );
                    }
                })
                .catch(error => {
                    if (error.response) {
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }

                    Swal.fire(
                        "500",
                        "Internal server error!",
                        "warning"
                    );
                });
        },
        methods: {
            checkPassword(event) {
                const password = document.getElementById("inputPassword");
                const confirmPassword = document.getElementById("inputConfirmPassword");
                const inputField = event.target;

                if ((this.form.password !== this.form.confirm_password)) {
                    password.classList.add("error");
                    password.scrollIntoView({ behavior: "smooth", block: "center" });

                    confirmPassword.classList.add("error");
                    confirmPassword.scrollIntoView({ behavior: "smooth", block: "center" });

                    $('.invalid_input').css('display', 'block');
                    this.disabled = true;
                    return false;
                } else {
                    password.classList.remove("error");
                    confirmPassword.classList.remove("error");
                    $('.invalid_input').css('display', 'none');
                    this.disabled = false;
                    return true;
                }
            },
            updateData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                const currentUrl2 = window.location.href;
                const userId2 = currentUrl2.split("show/");

                // API post request
                this.form.post(`/user/update/${userId2[1]}`)
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'User info updated.'
                        });

                        this.$Progress.finish();

                        const element = document.getElementById('edit-user-header');
                        if (element) {
                            element.scrollIntoView({ behavior: 'smooth' });
                        }

                        $('.hide-message').css('display', 'block');
                        this.counter = 5;

                        const interval = setInterval(() => {
                            this.counter--;  // Update countdown every second
                        }, 1000);

                        // Wait 5 seconds, then redirect to "/customers"
                        this.timeoutId = setTimeout(() => {
                            clearInterval(interval);
                            $('.hide-message').css('display', 'none');
                            this.$router.push('/users'); // Redirect to the desired route
                        }, 5000); // 5-second delay
                    } else {
                        Toast.fire({
                            icon: 'faild',
                            title: response.data.error
                        });

                        this.$Progress.fail();
                        this.counter = 5;
                    }
                    this.loading = false;
                    this.disabled = false;
                })
                .catch((error) => {
                    console.log(error);
                    Swal.fire(
                        "Error",
                        error.message,
                        "error"
                    );

                    this.$Progress.fail();
                    this.counter = 5;
                    this.loading = false;
                    this.disabled = false;
                });
            }
        },
        beforeDestroy() {
            if (this.timeoutId) {
                clearTimeout(this.timeoutId);
            }
        },
    }
</script>

<style>
    .card-title {
        margin-top: 5px;
    }
    
    .remove-padding {
        padding: 0;
    }

    .micro-text {
        font-size: 11px;
    }

    .iti--allow-dropdown {
        width: 100%;
    }

    .error {
        border: 2px solid red;
    }

    .error:focus {
        border: 2px solid red;
        border-radius: 12px;
        outline: none;
    }

    .invalid_input {
        display: none;
        color: red;
        margin-top: 5px;
    }

    .btn-success {
        background-color: rgb(4, 129, 4);
        color: white;
    }

    .btn-success:hover {
        background-color: rgb(4, 129, 4);
        color: white;
    }

    .hide-message {
        display: none;
    }
</style>