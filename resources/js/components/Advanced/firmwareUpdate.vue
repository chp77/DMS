<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Advanced / </span><strong>Firmware update</strong>
                </div>
            </div>
            <div class="header">
                <h2>
                    Firmware update
                    <button type="button" class="btn btn-command fa-pull-right">Firmware update</button>
                </h2>

                <div class="card mt-3">
                    <div class="card-body row box">
                    <data-table class="data-table-d" v-bind="tableProps" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
</template>

<script>
    import CustomCheckbox from "../CustomCheckbox.vue";
    import Spinner from "../Spinner.vue";

    export default {
        data() {
            return{
                loading: false,
                disabled: false,
                statusModal: false,
                tableProps: {
                    data: [], // Initialize the data array as empty
                    columns: [
                        { key: "", title: "", sortable: false, component: CustomCheckbox },
                        { key: "name", title: "Device name" },
                        { key: "email", title: "Update status", sortable: false },
                        { key: "email", title: "Current version" },
                        { key: "role", title: "Latest version", sortable: false },
                        { key: "role", title: "Model", sortable: false },
                        { key: "role", title: "Status" },
                        { key: "role", title: "Tags", sortable: false },
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

                // axios.get('api/users/listing').then(({data}) => (this.tableProps.data = data));
                Fire.$on("refreshData", () => {
                    this.loadData();
                });

                this.$Progress.finish();
                
                setTimeout(() => {
                    this.tableProps.isLoading = false;
                }, 800);
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
