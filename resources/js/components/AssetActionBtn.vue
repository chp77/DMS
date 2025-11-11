<template>
    <div>
        <div class="action-btn-wrapper">
            &nbsp;
            <i style="color: #0d6efd; cursor: pointer; padding: 5px;" class="fas fa-eye click-able" data-toggle="modal" :data-target="'#modal-view-'+this.data.id"></i>
            &nbsp;&nbsp;
            <router-link :to="`/asset/show/${this.data.id}`"><i class="fas fa-edit click-able"></i></router-link>
            &nbsp;&nbsp;
            <a href="#" @click="deleteAsset"><i class="fas fa-trash-alt text-blue"></i></a>
            &nbsp;
        </div>

        <div class="modal fade" :id="'modal-view-'+this.data.id" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View asset</h5>
                        <!-- <button type="button" @click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="group_name"><strong>Order number:</strong> <span style="color: #574f4f;">{{this.data.order_number}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Type:</strong> <span style="color: #574f4f;">{{this.data.type}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Customer order number:</strong> <span style="color: #574f4f;">{{this.data.customer_order_number}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Customer name:</strong> <span style="color: #574f4f;">{{this.data.name}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Reseller name:</strong> <span style="color: #574f4f;">{{this.data.reseller_name}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Model:</strong> <span style="color: #574f4f;">{{this.data.model}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name" v-if="data.type === 'Panel'"><strong>Serial number:</strong> <span style="color: #574f4f;">{{this.data.serial_number}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>MAC address:</strong> <span style="color: #574f4f;">{{this.data.mac_address}}</span></label>
                            </div>
                            <div class="form-group">
                                <label v-if = "this.data.qa_video_url !== ''" for="group_name" style="overflow: hide; width: 70%;"><strong>QA video link:</strong> <span style="color: #574f4f;"><a :href="this.data.qa_video_url" target="_blank">{{this.data.qa_video_url}}</a></span></label>
                                <label v-else for="group_name"><strong>QA video link:</strong> <span style="color: #574f4f;">{{this.data.qa_video_url}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Components:</strong> <span style="color: #574f4f;">{{this.data.component_names}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Remarks:</strong> <span style="color: #574f4f;">{{this.data.remarks}}</span></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="group_name"><strong>Manufacture_date:</strong> <span style="color: #574f4f;">{{this.data.manufacture_date}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Warranty period:</strong> <span style="color: #574f4f;">{{this.data.warranty_period}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Warranty start date:</strong> <span style="color: #574f4f;">{{this.data.warranty_started_date}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="group_name"><strong>Warranty expiry date:</strong> <span style="color: #574f4f;">{{this.data.warranty_expiry_date}}</span></label>
                            </div>
                            <div class="row" v-if="this.data.type === 'Panel'">
                                <qr-code ref="qrCode" :text="'https://ams.epasia.cc/warranty/retrieve/' + this.data.serial_number"></qr-code>
                            </div>
                            <div class="form-group" v-if="this.data.type === 'Panel'">
                                <a :href="'/warranty/retrieve/' + this.data.serial_number" target="_blank">View Asset Details page</a>
                            </div>
                            <button class="btn btn-success" v-if="this.data.type === 'Panel'" @click="downloadQRCode">Download QR Code</button>
                            <button v-if="data.serial_number !== null && this.data.type === 'Panel'" class="btn btn-primary integration-checklist__copy-button" @click="copyLink('https://ams.epasia.cc/warranty/retrieve/'+ data.serial_number)"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import { data } from 'jquery';

    export default {
        name: 'AssetActionsBtn',
        props: {
            data: Object,
        },
        data() {
            return{
                form: new Form({
                    id: this.data.id,
                }),
            }
        },
        methods: {
            copyLink(url) {
                navigator.clipboard.writeText(''+url+'').then(() => {
                    // alert('Link copied to clipboard: ' + url);
                }).catch(err => {
                    // console.error('Failed to copy: ', err);
                });
            },
            downloadQRCode() {
                const qrElement = this.$refs.qrCode.$el.querySelector('canvas');
                const dataURL = qrElement.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'ams_serial_no_' + this.data.serial_number + '.png';
                link.click();
            },
            deleteAsset() {
                Swal.fire({
                    title: "Are you sure you want to delete this asset?",
                    text: "Click Cancel To Cancel Deletion",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete"
                }).then(result => {
                    if (result.value) {
                        this.form
                            .delete("/asset/delete/" + this.data.id)
                            .then(() => {
                                Swal.fire(
                                    "Deleted",
                                    "Asset have been deleted!",
                                    "success"
                                );
                                Fire.$emit("refreshData");
                            })
                            .catch(() => {
                                Swal.fire(
                                    "Error",
                                    "Unable to performed this action",
                                    "warning"
                                );
                            });
                    }
                });
            },
        }
    };
</script>

<style>
.integration-checklist__copy-button {
  left: calc(50% - 20px);
  width: 40px;
  height: 40px;
  cursor: pointer;
  background-color: #fff;
  background-image: url('https://abs.twimg.com/emoji/v1/72x72/1f4cb.png');
  background-size: 60% auto;
  background-position: center center;
  background-repeat: no-repeat;
  border: 1px solid rgba(0,0,0,.29);
  border-bottom-color: rgba(0,0,0,.36);
  border-radius: 3px;
  box-shadow: 0 1px 1px rgba(0,0,0,.12);
  
  &:before {
    content: '';
    display: none;
    position: absolute;
    z-index: 9998;
    /* top: 35px; */
    right: 50px;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    /* border-bottom: 5px solid rgba(0,0,0,.72); */
  }

  &:after {
    content: 'Copy to Clipboard';
    display: none;
    position: absolute;
    z-index: 9999;
    /* top: 40px; */
    right: 50px;
    width: 114px;
    height: 36px;
    color: #fff;
    font-size: 10px;
    line-height: 36px;
    text-align: center;
    background: rgba(0,0,0,.72);
    border-radius: 3px;
  }
  
  &:hover {
    background-color: #eee;
    
    &:before, &:after {
      display: block;
    }
  }
  
  &:active, &:focus {
    outline: none;
    
    &:after {
      content: 'Copied!';
    }
  }
}
</style>