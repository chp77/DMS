<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Manage / </span><strong>Groups</strong>
                </div>
            </div>

            <div class="header">
                <h2>groups
                    <a href="#" class="btn btn-command fa-pull-right" data-toggle="dropdown">Select command</a>
                    <ul class="dropdown-menu multi-column columns-3 menu-styles">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header-2">Device control</li>
                                    <li class="dropdown-item-2">Power on</li>
                                    <li class="dropdown-item-2">Power off</li>
                                    <li class="dropdown-item-2">Screen off</li>
                                    <li class="dropdown-item-2">Reboot</li>
                                    <li class="dropdown-item-2">Bells</li>
                                    <li class="dropdown-item-2">Screen lock</li>
                                </ul>
                            </div>
                            <div class="col-sm-4 border-left">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header-2">Message</li>
                                    <li class="dropdown-item-2">Text</li>
                                    <li class="dropdown-item-2">Multimedia</li>
                                    <li class="dropdown-item-2">File publish</li>
                                    <li class="dropdown-item-2">Live channel</li>
                                </ul>
                            </div>
                            <div class="col-sm-4 border-left">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header-2">Device settings</li>
                                    <li class="dropdown-item-2">Wallpaper</li>
                                    <li class="dropdown-item-2">Boot logo</li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </h2>

                <div class="card mt-4">
                    <div class="card-body row">
                        <div class="col-md-10">
                            The devices in the group will automatically execute the commands that have been associated with the group.
                            <br>
                            All devices will automatically go to the default group.
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body row">
                    <data-table v-bind="tableProps" />
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
            return {
                tableProps: {
                    data: [], // Initialize the data array as empty
                    columns: [
                        { key: "id", title: "", sortable: false, component: CustomCheckbox },
                        { key: "title", title: "Group name" },
                        { key: "type", title: "Group type" },
                        { key: "", title: "Device No." },
                        { key: "", title: "Profile" },
                        { key: "", title: "Command" },
                        {
                            key: "actions",
                            label: "Actions",
                            formatter: (value, key, item) => {
                                return `
                                <button class="btn btn-sm btn-primary" @click="editItem(${item.id})">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-danger" @click="deleteItem(${item.id})">
                                    Delete
                                </button>
                                `;
                            }
                        },
                    ],
                    text: {
                        emptyTableText: "No data"
                    },
                    sortingMode: "multiple",
                    loadingComponent: Spinner,
                    isLoading: true,
                    showDownloadButton: false,
                    footerComponent: null
                },
            };
        },
        mounted() {
            setTimeout(() => {
                this.tableProps.isLoading = false;
            }, 800);
        },
        methods: {
            loadData() {
                this.$Progress.start();
                axios.get('api/groups/listing').then(({data}) => (this.tableProps.data = data));

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
    };
</script>
