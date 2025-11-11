<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header">
                <h2>Brand Listing</h2>
            </div>

            <div class="card">
                <div class="card-body row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-2 card-tools">
                        <router-link to="brand-add" class="btn btn-primary btn-add fa-pull-right">Add brand</router-link>
                    </div>
                </div>
            </div>

            <div class="card mt-4 card-outline card-purple">
                <div class="card-body row">
                    <data-table v-bind="tableProps"/>
                </div>
            </div>
        </div>
</template>

<script>
    import { Form } from 'vform';
    import Spinner from "../Spinner.vue";
    import BrandActionBtn from "../BrandActionBtn.vue";

    export default {
        props: {
            user: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                counter: 5,
                disabled: false,
                loading: false,
                form: new Form({
                    name: ''
                }),
                tableProps: {
                    data: [],
                    columns: [
                        { key: "row_number", title: "ID", sortable: false },
                        { key: "name", title: "Brand" },
                        { key: "created_at", title: "Created at" },
                        {
                            key: 'actions',
                            title: 'Actions',
                            sortable: false,
                            component: BrandActionBtn,
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
                    perPageOptions: [10, 25, 50, 100, 500, 1000],
                    defaultPerPage: 10,
                },
            }
        },
        computed: {
            
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

                axios.get('brands/listing')
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