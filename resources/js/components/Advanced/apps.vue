<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Advanced / </span><strong>Apps</strong>
                </div>
            </div>
            <div class="header">
                <h2>Apps</h2>

                <div class="row mt-3">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-app-installation-tab" data-toggle="pill" href="#custom-content-below-app-installation" role="tab" aria-controls="custom-content-below-app-installation" aria-selected="true" @click="loadData('app-installation')">App installation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-app-management-tab" data-toggle="pill" href="#custom-content-below-app-management" role="tab" aria-controls="custom-content-below-app-management" aria-selected="false" @click="loadData('app-management')">App management</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active mt-4" id="custom-content-below-app-installation" role="tabpanel" aria-labelledby="custom-content-below-app-installation-tab">
                            </div>
                            <div class="tab-pane fade mt-4" id="custom-content-below-app-management" role="tabpanel" aria-labelledby="custom-content-below-app-management-tab">
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

                if (type === 'app-management') {
                    this.tableProps.columns = [
                        { key: "name", title: "Apps name" },
                        { key: "email", title: "Platforms" },
                        { key: "email", title: "Type" },
                        { key: "role", title: "Version" },
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
                } else {
                    this.tableProps.columns = [
                        { key: "name", title: "Apps name" },
                        { key: "email", title: "Platforms" },
                        { key: "role", title: "Version" },
                        { key: "updated_at", title: "Size" },
                        { key: "updated_at", title: "Install" },
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
                }

                // axios.get('api/users/listing').then(({data}) => (this.tableProps.data = data));
                Fire.$on("refreshData", () => {
                    this.loadData();
                });

                setTimeout(() => {
                    this.tableProps.isLoading = false;
                }, 1000);

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
    .btn-app {
        border-color: red;
    }
</style>