<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Advanced / </span><strong>Input switch</strong>
                </div>
            </div>
            <div class="header">
                <div class="card-body row">
                    <div class="col-md-2">
                        <span style="font-size: 1.8rem; margin-top: 0; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2;">Input switch</span>
                    </div>
                    <div class="col-md-4 flex">
                        <span style="font-size: 22px; font-weight: 500; margin-right: 5px;">Group: </span>
                        <select class="form-control">
                            <option>All devices</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <button type="button" class="btn btn-command fa-pull-right">Switch input</button>
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
                        { key: "email", title: "Tags", sortable: false },
                        { key: "email", title: "Android", sortable: false },
                        { key: "role", title: "HDMI1", sortable: false },
                        { key: "role", title: "HDMI2", sortable: false },
                        { key: "role", title: "HDMI3", sortable: false},
                        { key: "role", title: "VGA1", sortable: false },
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
