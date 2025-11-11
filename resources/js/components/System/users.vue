<template>
    <div class="container-full">
        <div class="breadcrumb row">
            <div class="breadcrumb-item">
                
            </div>
        </div>
        <div class="header">
            <h2>User Listing</h2>

            <div class="card">
                <div class="card-body row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-2 card-tools">
                        <router-link to="user-add" class="btn btn-primary btn-add fa-pull-right">Add user</router-link>
                    </div>
                </div>
            </div>

            <div class="card mt-4 card-outline card-purple">
                <div class="card-body row">
                    <data-table v-bind="tableProps"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserActionsBtn from "../UserActionsBtn.vue";
    import Spinner from "../Spinner.vue";
    import Multiselect from 'vue-multiselect';
    
    export default {
        components: { Multiselect },
        props: {
            user: {
                type: String,
                required: true
            }
        },
        data() {
            return{
                error: new Form({
                    message: '',
                    errors: []
                }),
                form: new Form({
                    id: "",
                    name: "",
                    
                }),
                tableProps: {
                    data: [], // Initialize the data array as empty
                    columns: [
                        { key: "row_number", title: "ID", sortable: false },
                        { key: "name", title: "Username" },
                        { key: "email", title: "Email" },
                        { key: "created_at", title: "Created at" },
                        {
                            key: 'actions',
                            title: 'Actions',
                            sortable: false,
                            component: UserActionsBtn,
                        },
                    ],
                    text: {
                        emptyTableText: "No data"
                    },
                    sortingMode: "multiple",
                    loadingComponent: Spinner,
                    isLoading: true,
                    showDownloadButton: false,
                    footerComponent: null,
                    showSearchFilter: false,
                    showEntriesInfo: true,
                    showPerPage: true,
                    showPagination: true,
                    perPageOptions: [10, 25, 50, 100, 1000],
                    defaultPerPage: 10,
                },
            };
        },
        mounted() {
            setTimeout(() => {
                this.tableProps.isLoading = false;
            }, 1000);
        },
        methods: {
            loadData() {
                this.$Progress.start();

                axios.get('users/listing')
                    .then(response => {
                        if (response.data.statusCode === 200) {[
                            this.tableProps.data = response.data.data == '{}' ? [] : response.data.data,
                            this.users = response.data.data]
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
                    setTimeout(() => {
                        this.tableProps.isLoading = false;
                    }, 1000);

                this.$Progress.finish();

                axios.get('/timezone/listing')
                    .then(response => {
                        if (response.data.statusCode === 200) {
                            this.timeZoneOptions = response.data.response;
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unable to get the timezone list!'
                            });
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
                            "Internal server error, unable to get commands list!",
                            "warning"
                        );
                    });
            },
            addUser() {
                this.statusModal = false;
                this.selectedTimezone = null;
                this.form.reset();
                $("#modalAddUser").modal("show");
            },
            storeData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;
                this.form.timezone = this.selectedTimezone;

                // API post request
                this.form.post('user/add')
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // reload the users data
                        Fire.$emit("refreshData");

                        $("#modalAddUser").modal("hide");

                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'User added successfully.'
                        });

                        this.form.reset();
                        
                        this.loadData();
                        this.$Progress.finish();
                    } else {
                        Swal.fire(
                            "" + response.data.statusCode + "",
                            response.data.error,
                            "warning"
                        );

                        $("#modalAddUser").modal("hide");

                        this.$Progress.fail();
                    }
                    this.loading = false;
                    this.disabled = false;
                })
                .catch((error) => {
                    this.$Progress.fail();
                    this.loading = false;
                    this.disabled = false;
                });
            },
            updateData(d) {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                // get form data
                this.data.id = d.id;
                this.data.name = $("#form_username_" + d.id).val();
                this.data.email = $("#form_email_" + d.id).val();
                this.data.password = $("#form_password_" + d.id).val();
                this.data.role = d.role;
                this.data.access_settings = d.access_settings;
                this.data.device_access_settings = d.device_access_settings;
                this.data.group_access_settings = d.group_access_settings;
                this.data.timezone = d.timezone;

                // API post request
                this.data.post('user/update/' + d.id)
                .then(response => {
                    $('[data-dismiss="modal"]').trigger('click');

                    if (response.data.statusCode === 200) {
                        Toast.fire({
                            icon: 'success',
                            title: 'User updated successfully.'
                        });

                        this.$Progress.finish();
                        this.accordionItems = {
                            1: {
                                open: false,
                            },
                            2: {
                                open: false,
                            },
                            3: {
                                open: false,
                            },
                            4: {
                                open: false,
                            },
                            5: {
                                open: false,
                            },
                            6: {
                                open: false,
                            },
                            7: {
                                open: false,
                            },
                            8: {
                                open: false,
                            },
                            9: {
                                open: false,
                            },
                            10: {
                                open: false,
                            }
                        };
                        this.data.reset();
                        this.error.reset();

                        setTimeout(() => {
                            this.loadData();
                        }, 1000);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.data.error
                        });

                        this.$Progress.fail();
                    }
                })
                .catch(error => {
                    this.error.message = error.response.data.message;
                    this.error.errors = error.response.data.errors;

                    this.$Progress.fail();
                });

                this.loading = false;
                this.disabled = false;
            },
            closeModal() {
                $("#modalAddUser").modal("hide");
            }
        },
        created() {
            this.loadData();
            Fire.$on("refreshData", () => {
                this.loadData();
            });
        }
    }
</script>

<style>
    .scheduler-alert {
        z-index: 10000 !important;
    }
    .left-container {
        overflow: hidden;
        position: relative;
        height: 99vh;
        display: inline-block;
        width: 100%;
    }
    .action-background-light-grey {
        background-color: #eee;
        padding: 18px 18px 10px 18px;
    }
    .dropdown-icon {
        margin-top: -8px;
        margin-bottom: 5px;
    }
    .main-module {
        margin-bottom: 5px;
    }
    .side-module {
        margin-left: 20px !important;
    }
    .h6-weight {
        font-weight: 600;
    }
    .accordion-content {
        padding: 20px 20px;
        display: grid;
    }
    .alert-red {
        color: red !important;
    }
    .swal2-container {
        z-index: 10000;
    }
    .accordion-bar {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }
    .active-accordion-bar, .accordion-bar:hover {
        background-color: #ccc;
    }
    .accordion-bar:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }
    .active-accordion-bar:after {
        content: "\2212";
    }
    .panel-block {
        padding: 0 18px;
        background-color: white;
        max-height: 140px;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }
</style>