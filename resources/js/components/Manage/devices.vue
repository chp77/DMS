<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Manage / </span><strong>Devices</strong>
                </div>
            </div>

            <div class="header">
                <h2>Devices
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
                        { key: "device_name", title: "Device name" },
                        { key: "is_online", title: "Status" },
                        { key: "type", title: "Device Type" },
                        { key: "tags", title: "Tags" },
                        { key: "", ketitley: "Self-created groups" },
                        { key: "timezone", title: "Time zone" },
                        { key: "", title: "Next command" },
                        { key: "", title: "Associated Profile" },
                        { key: "serial_number", title: "Serial number" },
                        { key: "modal_brand",title: "Modal-brand" },
                        { key: "os", title: "OS" },
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
                axios.get('api/devices/listing')
                    .then(response => {
                        if (response.data.statusCode === 200) {
                            this.tableProps.data = response.data.data
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
            this.loadData();
            Fire.$on("refreshData", () => {
                this.loadData();
            });
        }
    };
</script>

<style>
    .btn-command {
        border-color: #4965d6 !important;
        color: #4965d6;
        min-width: 160px;
    }

    .btn-command:hover {
        background-color: #9eb1ff;
    }

    .dropdown-menu {
        min-width: 200px;
    }

    .menu-styles {
        margin-top: 15px;
        margin-right: 20px;
    }

    .dropdown-menu.columns-2 {
        min-width: 400px;
    }

    .dropdown-menu.columns-3 {
        min-width: 450px;
    }

    .dropdown-menu li a {
        padding: 5px 15px;
        font-weight: 300;
    }

    .multi-column-dropdown {
        list-style: none;
        margin: 0px;
        padding: 0px;
    }

    .multi-column-dropdown li a {
        display: block;
        clear: both;
        line-height: 1.428571429;
        color: #333;
        white-space: normal;
    }

    .multi-column-dropdown li a:hover {
        text-decoration: none;
        color: #262626;
        background-color: #999;
    }
    
    @media (max-width: 767px) {
        .dropdown-menu.multi-column {
            min-width: 150px !important;
            overflow-x: hidden;
        }
        .menu-styles {
            margin-top: 15px;
            margin-left: 0px;
        }
    }

    .dropdown-header-2 {
        color: grey;
        margin-left: 10px;
    }

    .dropdown-item-2 {
        padding: 5px 10px 5px 10px;
        color: #4965d6; 
        cursor: pointer;
    }

    .dropdown-item-2:hover {
        background-color: #4965d6;
        color: white;
    }

    .data-table-pagination {
        position: absolute;
        right: 15px;
        bottom: 0;
    }

    .pagination-search {
        display: none !important;
    }
</style>
