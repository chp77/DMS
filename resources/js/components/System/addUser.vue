<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header">
                <h2>Add User</h2>

                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        New user added successfully, will redirect to the user listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <div class="card card-primary col-md-6" style="padding: 0 0 0 0;">
                <div class="card-header">
                    <h3 class="card-title">New User</h3>
                </div>

                <form @submit.prevent="storeData()">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-name">Username<span style="color: red;"> *</span></label>
                            <input type="text" v-model="form.name" class="form-control" id="inputName" required>
                        </div>

                        <div class="form-group">
                            <label for="input-email">Email address<span style="color: red;"> *</span></label>
                            <input type="email" v-model="form.email" class="form-control" id="inputEmail1" required>
                        </div>

                        <div class="form-group">
                            <label for="input-password">Password<span style="color: red;"> *</span></label>
                            <input type="password" v-model="form.password" class="form-control" id="inputPassword" @input="checkPassword" required>
                            <div class="invalid_input">Password and confirm password does not match!</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-confirm-password">Confirm Password<span style="color: red;"> *</span></label>
                            <input type="password" v-model="form.confirm_password" class="form-control" id="inputConfirmPassword" @input="checkPassword" required>
                            <div class="invalid_input">Password and confirm password does not match!</div>
                        </div>
                    </div>

                    <div class="card-footer" style="display: row; justify-content: space-between;">
                        <router-link to="users" class="btn btn-primary btn-add fa-pull-right" style="float: left; background-color: #ccc; border-color: transparent;">Cancel</router-link>
                        <button button type="submit" class="btn btn-success" style="float: right;" :disabled="disabled">
                            Add <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
    import { Form } from 'vform';

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
            this.timeoutId = null;
        },
        methods: {
            checkPassword(event) {
                const password = document.getElementById("inputPassword");
                const confirmPassword = document.getElementById("inputConfirmPassword");
                const inputField = event.target;

                if (inputField.value !== (this.form.password || this.form.confirm_password) && (this.form.confirm_password !== '')) {
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
            storeData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                // API post request
                this.form.post('user/add')
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'User added successfully.'
                        });

                        this.form.reset();
                        this.$Progress.finish();
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
                            icon: 'error',
                            title: response.data.error
                        });

                        this.$Progress.fail();
                        this.counter = 5;
                    }
                    this.loading = false;
                    this.disabled = false;
                })
                .catch((error) => {
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
        created() {
            Fire.$on("refreshData", () => {
            });
        }
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
</style>