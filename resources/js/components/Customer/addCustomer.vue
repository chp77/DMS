<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header">
                <h2>Add Customer</h2>
 
                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        New customer added successfully, will redirect to the customer listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <div class="card card-primary col-md-6" style="padding: 0 0 0 0;">
                <div class="card-header">
                    <h3 class="card-title">New Customer</h3>
                </div>

                <form @submit.prevent="storeData()">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-customer-name">Name<span style="color: red;"> *</span></label>
                            <input type="text" v-model="form.name" class="form-control" id="inputCustomerName" required />
                        </div>

                        <div class="form-group">
                            <label for="input-email">Email address<span style="color: red;"> *</span></label>
                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" required />
                        </div>

                        <div class="form-group">
                            <label for="input-company-name">Company name</label>
                            <input type="text" v-model="form.company_name" class="form-control" id="inputCompanyName" />
                        </div>

                        <div class="form-group">
                            <label for="input-company-address">Company address</label>
                            <input type="text" v-model="form.company_address" class="form-control" id="inputCompanyAddress" />
                        </div>

                        <div class="form-group">
                            <label for="input-email">Contact number</label>
                            <input class="form-control" v-model="form.contact_number" name="phone" type="text" id="phone" @input="validatePhoneInput" /> 
                            <div class="invalid_input">Invalid phone number format!</div>
                        </div>

                        <div class="form-group">
                            <label for="input-country">Country</label>
                            <input type="text" v-model="form.country" class="form-control" id="inputCountry" />
                        </div>

                        <div class="form-group">
                            <label for="input-reseller-name">Reseller name</label>
                            <input type="text" v-model="form.reseller_name" class="form-control" id="inputResellerName" />
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
                    company_name: '',
                    company_address: '',
                    contact_number: '',
                    phone_number: '',
                    country: '',
                    reseller_name: '',
                }),
            }
        },
        computed: {
            
        },
        mounted() {
            this.timeoutId = null;
            var input = document.querySelector("#phone");
            window.intlTelInput(input, {
                separateDialCode: true,
                excludeCountries: ["in", "il"],
                preferredCountries: ["cn", "my"]
            });
        },
        methods: {
            validatePhoneInput(event) {
                const allowedValue = /^\+[0-9]+$/;
                const inputField = event.target;
                const phoneInput = document.getElementById("phone");

                // get the country code and name
                const dialCodeElement = document.querySelector(".iti__selected-dial-code");
                const flagElement = document.querySelector('.iti__selected-flag');

                // Check if the element exists to avoid errors
                if (flagElement) {
                    const titleValue = flagElement.getAttribute('title'); // Get the value of the 'title' attribute
                    const splitArray = titleValue.split(':');
                    const countryName = splitArray[0].trim();
                    const countryNameParts = countryName.split(' ');

                    // insert the value to country field
                    this.form.country = countryNameParts[0];
                }

                if (!dialCodeElement) {
                    // throw an error
                    console.error("Element with class '.iti__selected-dial-code' not found.");
                } else {
                    const dialCode = dialCodeElement.textContent;
                    const phoneNumer = dialCode + inputField.value;
                    const validPhoneNumber = allowedValue.test(phoneNumer);

                    this.form.phone_number = phoneNumer;

                    if (!validPhoneNumber) {
                        phoneInput.classList.add("error");
                        // Scroll to the input field to bring it into view
                        phoneInput.scrollIntoView({ behavior: "smooth", block: "center" });
                        $('.invalid_input').css('display', 'block');
                        this.disabled = true;
                        return false;
                    } else {
                        // Remove the error class if the value is correct
                        phoneInput.classList.remove("error");
                        $('.invalid_input').css('display', 'none');
                        this.disabled = false;
                        return true;
                    }
                }
            },
            storeData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                // API post request
                this.form.post('customer/add')
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'Customer added successfully.'
                        });

                        this.form.reset();
                        this.phone = '';
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
                            this.$router.push('/customers'); // Redirect to the desired route
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