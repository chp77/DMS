<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header">
                <h2>Add Model</h2>
 
                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        New model added successfully, will redirect to the model listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary" style="padding: 0 0 0 0;">
                        <div class="card-header">
                            <h3 class="card-title">Add Model</h3>
                        </div>

                        <form @submit.prevent="storeData()">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="input-name">Brand<span style="color: red;"> *</span></label>
                                            <multiselect
                                                v-model="form.brand_id"
                                                :options="brandOptions"
                                                :multiple="false"
                                                name="name"
                                                label="name"
                                                track-by="name"
                                                placeholder="Select the brand"
                                                :allow-empty="false"
                                            ></multiselect>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-name">Model name<span style="color: red;"> *</span></label>
                                            <input type="text" v-model="form.name" class="form-control" id="inputName" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="display: row; justify-content: space-between;">
                                <router-link to="/models" class="btn btn-primary btn-add" style="float: left; background-color: #ccc; border-color: transparent;">Cancel</router-link>
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
                brandOptions: [],
                timeoutId: null,
                counter: 5,
                disabled: false,
                loading: false,
                form: new Form({
                    name: '',
                    brand_id: ''
                }),
            }
        },
        watch: {
            'form.brand_id': function(newVal) {
                this.onBrandSelect(newVal);
            }
        },
        computed: {
            
        },
        mounted() {
            this.timeoutId = null;
            this.brands();
            this.form.reset();
        },
        methods: {
            onBrandSelect(selectedBrand) {
                this.form.brand_id = selectedBrand;
            },
            brands() {
                axios.get('/brands/listing')
                .then(response => {
                    if (response.data.statusCode === 200) {[
                        this.brandOptions = response.data.data,
                    ]
                    } else {
                        Swal.fire(
                            "500",
                            "Internal server error, please contact the service provider!",
                            "warning"
                        );
                    }
                })
                .catch(error => {
                    Swal.fire(
                        "500",
                        "Internal server error!",
                        "warning"
                    );
                });
            },
            storeData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                if ((this.form.brand_id).length == 0) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please select the brand!'
                    });

                    this.loading = false;
                    this.disabled = false;
                    this.$Progress.fail();
                    return false;
                }

                // API post request
                this.form.post('model/add')
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
                            this.$router.push('/models'); // Redirect to the desired route
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