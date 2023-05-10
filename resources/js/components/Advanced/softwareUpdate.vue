<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Advanced / </span><strong>Software update</strong>
                </div>
            </div>
            <div class="header">
                <h2>Software update</h2>

                <div class="row mt-3">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-android-tab" data-toggle="pill" href="#custom-content-below-android" role="tab" aria-controls="custom-content-below-android" aria-selected="true" @click="loadData('android')">Android</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active mt-4" id="custom-content-below-android" role="tabpanel" aria-labelledby="custom-content-below-android-tab">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-10 tab-custom-content">
                                            Latest version: <strong>V1.8.5</strong>
                                            <br>
                                            Release date: <strong>2021/07/28</strong>
                                        </div>
                                        <div class="col-md-2 card-tools">
                                            <button type="button" class="btn btn-command fa-pull-right btn-disabled">Software update</button>
                                        </div>

                                        <div class="col-md-12 divider small-text">
                                            *Total 1 devices1 devices need to be update to V1.8.5
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body row box">
                            <data-table class="data-table-d" v-bind="tableProps" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Spinner from "../Spinner.vue";

    export default {
        data() {
            return{
                loading: false,
                disabled: false,
                statusModal: false,
                tableProps: {
                    data: [], // Initialize the data array as empty
                    columns: [],
                    text: {
                        emptyTableText: "No data"
                    },
                    sortingMode: "multiple",
                    loadingComponent: Spinner,
                    isLoading: true,
                    showDownloadButton: false,
                    footerComponent: null,
                    showSearchFilter: false,
                    showEntriesInfo: false,
                    showPerPage: false,
                    showPagination: false,
                    defaultPerPage: 10000
                },
            };
        },
        mounted() {
            setTimeout(() => {
                this.tableProps.isLoading = false;
            }, 1000);
        },
        methods: {
            loadData(type) {
                this.$Progress.start();
                this.tableProps.isLoading = true;

                this.tableProps.columns = [
                    { key: "name", title: "Device name" },
                    { key: "email", title: "Update status" },
                    { key: "email", title: "Tags" },
                    { key: "role", title: "Status" },
                    { key: "role", title: "Current version" },
                    { key: "updated_at", title: "Latest version" },
                    {
                        key: 'actions',
                        title: 'Actions',
                        sortable: false,
                        formatter: (value, key, item) => {
                            return `
                            <button @click="editUser(${item.id})">Edit</button>
                            <button @click="deleteUser(${item.id})">Delete</button>
                            `;
                        },
                    },
                ];

                // axios.get('api/users/listing').then(({data}) => (this.tableProps.data = data));
                Fire.$on("refreshData", () => {
                    this.loadData();
                });

                setTimeout(() => {
                    this.tableProps.isLoading = false;
                });
                
                this.$Progress.finish();
            },
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
    .btn-disabled, .btn-disabled:hover {
        color: #c5cef1;
        border-color: #c5cef1 !important;
        background-color: transparent;
        cursor: not-allowed !important;
        outline: none !important;
    }
</style>