<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Resources / </span><strong>Resources</strong>
                </div>
            </div>
            <div class="header">
                <h2>Resources</h2>
                <small>Storage: Used 41.89MB / 20GB</small>

                <div class="row mt-3">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-image-tab" data-toggle="pill" href="#custom-content-below-image" role="tab" aria-controls="custom-content-below-image" aria-selected="true" @click="loadData('image')">Image</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-video-tab" data-toggle="pill" href="#custom-content-below-video" role="tab" aria-controls="custom-content-below-video" aria-selected="false" @click="loadData('video')">Video</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-audio-tab" data-toggle="pill" href="#custom-content-below-audio" role="tab" aria-controls="custom-content-below-audio" aria-selected="false" @click="loadData('audio')">Audio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-apps-tab" data-toggle="pill" href="#custom-content-below-apps" role="tab" aria-controls="custom-content-below-apps" aria-selected="false" @click="loadData('apps')">Apps</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-certificates-tab" data-toggle="pill" href="#custom-content-below-certificates" role="tab" aria-controls="custom-content-below-certificates" aria-selected="false" @click="loadData('certificates')">Certificates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-others-tab" data-toggle="pill" href="#custom-content-below-others" role="tab" aria-controls="custom-content-below-others" aria-selected="false" @click="loadData('others')">Others</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active mt-4" id="custom-content-below-image" role="tabpanel" aria-labelledby="custom-content-below-image-tab">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-10 tab-custom-content">
                                            Format: <strong>JPG, PNG, WEBP, GIF, SVG, BMP</strong>
                                            <br>
                                            Size: <strong>600MB max</strong>
                                        </div>
                                        <div class="col-md-2 card-tools">
                                            <button type="button" class="btn btn-primary fa-pull-right btn-add">Add</button>
                                        </div>

                                        <div class="col-md-12 divider small-text">
                                            Apply command : Alert , Multimedia , File publish , Wallpaper , Boot logo , Profile
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-4" id="custom-content-below-video" role="tabpanel" aria-labelledby="custom-content-below-video-tab">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-10 tab-custom-content">
                                            Format: <strong>JMP4, AVI</strong>
                                            <br>
                                            Size: <strong>600MB max</strong>
                                        </div>
                                        <div class="col-md-2 card-tools">
                                            <button type="button" class="btn btn-primary fa-pull-right btn-add">Add</button>
                                        </div>

                                        <div class="col-md-12 divider small-text">
                                            Apply command : Multimedia , File publish
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-4" id="custom-content-below-audio" role="tabpanel" aria-labelledby="custom-content-below-audio-tab">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-10 tab-custom-content">
                                            Format: <strong>MP3, WAV, AAC, OGG</strong>
                                            <br>
                                            Size: <strong>600MB max</strong>
                                        </div>
                                        <div class="col-md-2 card-tools">
                                            <button type="button" class="btn btn-primary fa-pull-right btn-add">Add</button>
                                        </div>

                                        <div class="col-md-12 divider small-text">
                                            Apply command : Bells , Multimedia , File publish
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-4" id="custom-content-below-apps" role="tabpanel" aria-labelledby="custom-content-below-apps-tab">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-10 tab-custom-content">
                                            Format: <strong> APK, EXE, MSI</strong>
                                            <br>
                                            Size: <strong>600MB max</strong>
                                        </div>
                                        <div class="col-md-2 card-tools">
                                            <button type="button" class="btn btn-primary fa-pull-right btn-add">Add</button>
                                        </div>

                                        <div class="col-md-12 divider small-text">
                                            Apply command : Apps , File publish , Profile
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-4" id="custom-content-below-certificates" role="tabpanel" aria-labelledby="custom-content-below-certificates-tab">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-10 tab-custom-content">
                                            Format: <strong>PEM, CER, CRT, DER, P7B, P12, PFX</strong>
                                            <br>
                                            Size: <strong>600MB max</strong>
                                        </div>
                                        <div class="col-md-2 card-tools">
                                            <button type="button" class="btn btn-primary fa-pull-right btn-add">Add</button>
                                        </div>

                                        <div class="col-md-12 divider small-text">
                                            Apply command : Profile_Certificates, Profile_Wi-Fi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade mt-4" id="custom-content-below-others" role="tabpanel" aria-labelledby="custom-content-below-others-tab">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-10 tab-custom-content">
                                            Size: <strong>600MB max</strong>
                                        </div>
                                        <div class="col-md-2 card-tools">
                                            <button type="button" class="btn btn-primary fa-pull-right btn-add">Add</button>
                                        </div>

                                        <div class="col-md-12 divider-nowrap small-text">
                                            Apply command : File publish
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

                if (type === 'video' || type === 'audio') {
                    this.tableProps.columns = [
                        { key: "name", title: "Name" },
                        { key: "email", title: "Time" },
                        { key: "email", title: "Format" },
                        { key: "role", title: "Size" },
                        { key: "updated_at", title: "Added on" },
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
                } else if (type === 'apps') {
                    this.tableProps.columns = [
                        { key: "name", title: "Name" },
                        { key: "email", title: "Version" },
                        { key: "email", title: "Format" },
                        { key: "role", title: "Size" },
                        { key: "updated_at", title: "Added on" },
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
                } else if (type === 'certificates') {
                    this.tableProps.columns = [
                        { key: "name", title: "Certificate name" },
                        { key: "email", title: "Common name" },
                        { key: "email", title: "Usage" },
                        { key: "role", title: "Format" },
                        { key: "role", title: "Expires" },
                        { key: "updated_at", title: "Added on" },
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
                        { key: "name", title: "Name" },
                        { key: "email", title: "Format" },
                        { key: "role", title: "Size" },
                        { key: "updated_at", title: "Added on" },
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
    .btn-add {
        width: 110px;
        background-color: #4965d6;
    }

    .divider {
        border-top: 1px solid #ececec;
        margin-top: 10px;
        padding-top: 10px;
    }

    .divider-nowrap {
        border-top: 1px solid #ececec;
        padding-top: 10px;
    }
    
    .small-text {
        color: #909398;
        font-size: 14px;
    }

    .nav-tabs, .nav-link {
        --bs-nav-tabs-link-active-color:#4965d6;
        --bs-nav-tabs-link-active-border-color: transparent;
        --bs-nav-tabs-link-active-bg: transparent !important;
        font-size: 16px;
        color: #5c5d60;
        font-weight: 550;
    }

    .nav-link.active {
        border-bottom: 2px solid #4965d6 !important;
    }

    .box {
        min-height: 550px;
    }

    .data-table-d {
        display: block;
    }

    .data-table-d>div {
        margin-top: -17px;
    }

    tr {
        background-color: white;
    }
</style>
