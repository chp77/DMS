<template>
    <div class="container-full">
        <div class="breadcrumb row">
            <div class="breadcrumb-item">
                
            </div>
        </div>
        <div class="header">
            <h2>Asset Listing</h2>

            <div class="card">
                <div class="card-body row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-2 card-tools">
                        <router-link to="asset-add" class="btn btn-primary btn-add fa-pull-right">Add asset</router-link>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button style="background: white; box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Action
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu default-menu" aria-labelledby="dropdownMenu1">
                    <li><a style="text-decoration: none; color: #373737;" href="#" @click="logSelectedCheckbox">Bulk print QR codes</a></li>
                </ul>
            </div>

            <div class="card mt-1 card-outline card-purple">
                <div style="padding-top: 10px; padding-left: 15px;" v-if="isChecked == false">
                    <input type="checkbox" :checked="isChecked" @change="selectAll"/> Select All
                </div>
                <div style="padding-top: 10px; padding-left: 15px;" v-else>
                    <input type="checkbox" :checked="isChecked" @change="deselectAll"/> Select All
                </div>
                <div class="card-body row">
                    <data-table v-bind="tableProps"/>
                </div>
            </div>

            <!-- Modal update group -->
            <!-- <div v-for="form in this.tableProps.data" :key="'edit-'+form.id"> -->
                <!-- <div class="modal fade" :id="'modal-view-'+form.id" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View asset</h5>
                                <button type="button" @click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <div class="modal-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group_name"><strong>Order number:</strong> <span style="color: #574f4f;">{{form.order_number}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Customer order number:</strong> <span style="color: #574f4f;">{{form.customer_order_number}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Customer name:</strong> <span style="color: #574f4f;">{{form.name}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Reseller name:</strong> <span style="color: #574f4f;">{{form.reseller_name}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Model:</strong> <span style="color: #574f4f;">>{{form.model}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>RAM:</strong> <span style="color: #574f4f;">{{form.ram}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Storage:</strong> <span style="color: #574f4f;">>{{form.storage}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Wifi:</strong> <span style="color: #574f4f;">{{form.wifi}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Serial number:</strong> <span style="color: #574f4f;">{{form.serial_number}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>MAC address:</strong> <span style="color: #574f4f;">{{form.mac_address}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label v-if = "form.qa_video_url !== ''" for="group_name"><strong>QA video link:</strong> <span style="color: #574f4f;"><a :href="form.qa_video_url" target="_blank">{{form.qa_video_url}}</a></span></label>
                                        <label v-else for="group_name"><strong>QA video link:</strong> <span style="color: #574f4f;">{{form.qa_video_url}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Components:</strong> <span style="color: #574f4f;">{{form.component_names}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Remarks:</strong> <span style="color: #574f4f;">{{form.remarks}}</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group_name"><strong>Purchase date:</strong> <span style="color: #574f4f;">{{form.purchase_date}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Manufacture_date:</strong> <span style="color: #574f4f;">{{form.manufacture_date}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Warranty period:</strong> <span style="color: #574f4f;">{{form.warranty_period}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Warranty start date:</strong> <span style="color: #574f4f;">{{form.warranty_started_date}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_name"><strong>Warranty expiry date:</strong> <span style="color: #574f4f;">{{form.warranty_expiry_date}}</span></label>
                                    </div>
                                    <qr-code style="justify-content: center; display: flex" size="200" :text="form.mac_address"></qr-code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            <!-- </div> -->
        </div>
    </div>
</template>

<script>
    import Spinner from "../Spinner.vue";
    import Multiselect from 'vue-multiselect';
    import AssetActionsBtn from "../AssetActionBtn.vue";
    import EditAssetActionBtn from "../EditAssetActionBtn.vue";
    import CheckAssetActionBtn from "../CheckAssetActionBtn.vue";
    import CheckboxEvent from "../CheckboxEvent.js";
    
    $('.btn-default').on('click',function(){
        $('.default-menu').slideToggle();
        $('.dropdown-overlay').show();
    });

    $('.dropdown-overlay').on('click',function(){
        $('.default-menu').hide(); 
        $(this).hide();
    });

    $('.btn-danger').on('click',function(){
        $('.slide-menu').slideToggle();
        $('.dropdown-overlay').show();
    });

    $('.dropdown-overlay').on('click',function(){
        $('.slide-menu').hide();
        $(this).hide();
    });

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
                isChecked: false,
                selectedIds: '',
                tableProps: {
                    data: [], // Initialize the data array as empty
                    columns: [
                        {
                            key: '',
                            title: '',
                            sortable: false,
                            component: CheckAssetActionBtn,
                        },
                        {
                            key: 'actions',
                            title: 'Actions',
                            sortable: false,
                            component: AssetActionsBtn,
                        },
                        {
                            key: 'actions',
                            title: 'Order no.',
                            sortable: true,
                            component: EditAssetActionBtn,
                        },
                        // { key: "customer_order_number", title: "Customer order no." },
                        { key: "type", title: "Type" },
                        { key: "brand", title: "Brand" },
                        { key: "model", title: "Model" },
                        { key: "sku", title: "SKU code" },
                        { key: "serial_number", title: "Serial no." },
                        // { key: "manufacture_date", title: "Manufacture date" },
                        { key: "warranty_period", title: "Warranty period" },
                        { key: "warranty_started_date", title: "Warranty start date" },
                        { key: "warranty_expiry_date", title: "Warranty expiry date" },
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
                    perPageSizes: [10, 25, 50, 100, 500, 1000],
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
            selectAll() {
                axios.get('assets/listing').then(({data}) => {
                    console.log(data.data);
                    if (data.statusCode === 200) {
                        this.isChecked = true;
                        for (let i = 0; i < (data.data).length; i += 1) {
                            data.data[i].selected = true;
                        }

                        CheckboxEvent.listen("setSelected", function (id, checked) {
                            for (let i = 0; i < (data.data).length; i += 1) {
                                if (data.data[i].id === id) {
                                    data.data[i].selected = checked;
                                }
                            }
                        });
                        this.tableProps.data = data.data;
                    } else {
                        Swal.fire(
                            "500",
                            "Internal server error, please contact the service provider!",
                            "warning"
                        );
                    }
                });
            },
            deselectAll() {
                this.isChecked = false;
                this.loadData();
            },
            logSelectedCheckbox() {
                const selectedIds = this.tableProps.data
                                    .filter((f) => f.selected)
                                    .map((o) => o.id)
                                    .join('&');
                this.selectedIds = selectedIds;

                // open new window if ids are not empty
                if (this.selectedIds !== '') {
                    const url = `https://ams.epasia.cc/bulk/qr-code/${selectedIds}`;
                    this.openPopup(url);
                    this.loadData();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please select at least one checkbox!'
                    });

                    return false;
                }
            },
            loadData() {
                this.$Progress.start();

                axios.get('assets/listing')
                    .then(response => {
                        if (response.data.statusCode === 200) {[
                            this.tableProps.data = response.data.data == '{}' ? [] : response.data.data,
                            this.users = response.data.data,
                            CheckboxEvent.listen("setSelected", function (id, checked) {
                                for (let i = 0; i < (response.data.data).length; i += 1) {
                                    if (response.data.data[i].id === id) {
                                        response.data.data[i].selected = checked;
                                    }
                                }
                            })
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
            openPopup(url) {
                this.isChecked = false;
                const width = 800;
                const height = 600;
                const left = (window.screen.width / 2) - (width / 2);
                const top = (window.screen.height / 2) - (height / 2);

                window.open(
                    url,
                    'popupWindow',
                    `width=${width},height=${height},top=${top},scrollbars=yes,resizable=yes`
                );
            }
        },
        created() {
            Fire.$on("refreshData", () => {
                this.loadData();
                this.selectedIds = '';
            });
        }
    }
</script>

<style>
    .dropdown-overlay
    {
        width: 100%;
        height: 100%;
        background-color: transparent;
        position: absolute;
        display: none;
    }
    .dropdown.dropup
    {
        padding-top: 100px;
        .slide-menu
        {
            margin-bottom: -1px;
            bottom: 28%;
            top: auto;
        }
    }
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