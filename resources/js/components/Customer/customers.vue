<template>
    <div class="container-full">
        <div class="breadcrumb row">
            <div class="breadcrumb-item">
                
            </div>
        </div>
        <div class="header">
            <h2>Customer Listing</h2>

            <div class="card">
                <div class="card-body row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-2 card-tools">
                        <router-link to="customer-add" class="btn btn-primary btn-add fa-pull-right">Add customer</router-link>
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
    import CustomerActionsBtn from "../CustomerActionBtn.vue";
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
                tableProps: {
                    data: [], // Initialize the data array as empty
                    columns: [
                        { key: "row_number", title: "ID", sortable: false },
                        { key: "name", title: "Customer Name" },
                        { key: "email", title: "Email" },
                        { key: "company_name", title: "Company Name" },
                        { key: "company_address", title: "Address" },
                        { key: "contact_number", title: "Contact Number" },
                        { key: "country", title: "Country" },
                        { key: "created_at", title: "Created at" },
                        {
                            key: 'actions',
                            title: 'Actions',
                            sortable: false,
                            component: CustomerActionsBtn,
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
                    perPageSizes: [10, 25, 50, 100, 500, 1000],
                    showPagination: true,
                    defaultPerPage: 10,
                    showSearchFilter: true,
                    // showDownloadButton: true,
                    allowedExports: ["csv"] 
                },
            };
        },
        mounted() {
            this.loadData();
            setTimeout(() => {
                this.tableProps.isLoading = false;
            }, 1000);
        },
        methods: {
            loadData() {
                this.$Progress.start();

                axios.get('customers/listing')
                    .then(response => {
                        if (response.data.statusCode === 200) {[
                            this.tableProps.data = response.data.data == '{}' ? [] : response.data.data,
                            this.users = response.data.data
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
            },
        },
        created() {
            Fire.$on("refreshData", () => {
                this.loadData();
            });
        }
    }
</script>

<style>
    .btn-add:hover {
        background-color: #007bff;
    }
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