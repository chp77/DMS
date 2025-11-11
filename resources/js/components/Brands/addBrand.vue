<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header">
                <h2>Add Brand</h2>
 
                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        New brand added successfully, will redirect to the brand listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary" style="padding: 0 0 0 0;">
                        <div class="card-header">
                            <h3 class="card-title">Add Brand</h3>
                        </div>

                        <form @submit.prevent="storeData()">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="input-name">Brand name<span style="color: red;"> *</span></label>
                                            <input type="text" v-model="form.name" class="form-control" id="inputName" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="display: row; justify-content: space-between;">
                                <router-link to="/brands" class="btn btn-primary btn-add" style="float: left; background-color: #ccc; border-color: transparent;">Cancel</router-link>
                                <button type="submit" class="btn btn-success" style="float: right;" :disabled="disabled">
                                    Save <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import { Form } from 'vform';
    import Multiselect from 'vue-multiselect';
    import Spinner from "../Spinner.vue";

    export default {
        components: {
            Multiselect
        },
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
                }),
            }
        },
        computed: {
            
        },
        mounted() {
            this.timeoutId = null;
            this.form.reset();
        },
        methods: {
            storeData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                // API post request
                this.form.post('brand/add')
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'Brand added successfully.'
                        });

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
                            this.$router.push('/brands'); // Redirect to the desired route
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

    .img-thumbnail {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
    }
</style>