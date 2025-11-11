<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="modal fade" id="modal-component" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Components:</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body row" v-if="(form.selected_components).length > 0">
                            <div class="col-md-6" v-for="item in form.selected_components" :key="item.id">
                                <div class="form-group" v-if="item['category'] === 'Android Motherboard'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">System Version</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['system version'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">CPU</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['cpu'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">GPU</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['gpu'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">RAM</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['ram'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Storage</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['storage'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Wifi</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['wifi'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Hotspot</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['hotspot'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Bluetooth</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['bluetooth'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">WAN</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['wan'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'OPS'">
                                    <h4>{{ item['label_name'] }}</h4>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'Front Board'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">USB</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['usb'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Type-C</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['type-c'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">HDMI</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['hdmi'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Touch</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['touch'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Light Sensitivity</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['light sensitivity'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">IR</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['ir'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">LED</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['led'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'Tempered Glass'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Size</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['size'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Thickness</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['thickness'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">AG</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['ag'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Silk Screen Color</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['color'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'Touch'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Size</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['size'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Touch Mode</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['mode'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Touch Point</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['point'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'Power Board'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Size</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['size'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Total Power</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['total power'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">LED Power</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['led power'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'OC'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Size</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['size'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Level</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['level'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Resolution</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['resolution'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Contrast</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['contrast'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'Materials'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Size</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['size'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Fitting Method</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['fitting method'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Color</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['color'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'Logic Board'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Resolution</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['resolution'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group" v-if="item['category'] === 'LED Light Strip'">
                                    <h4>{{ item['label_name'] }}</h4>
                                    <table class="table-tb">
                                        <tr class="table-tr">
                                            <th class="table-th">Type</th>
                                            <th class="table-th">Value</th>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Size</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['size'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Lamp Power</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['lamp power'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Number of Lamp Beads</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['number of lamp beads'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Number of Light Bars</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['number of light bars'] }}</td>
                                        </tr>
                                        <tr class="table-tr">
                                            <td class="table-td">Adaptable Backplane</td>
                                            <td class="table-td">{{ JSON.parse(item['specification'])[0]['adaptable backplane'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a class="btn btn-primary btn-add" style="float: left; margin-left: 10px; background-color: #ccc; border-color: transparent;" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header">
                <h2>Add Asset</h2>
 
                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        New asset added successfully, will redirect to the asset listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <form @submit.prevent="storeData()">
                <div class="row">
                    <div class="card card-primary" style="padding: 0 0 0 0;">
                        <div class="card-header">
                            <h3 class="card-title">New Asset</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="input-customer-name">Order number<span style="color: red;"> *</span><span style="color: grey; margin-left: 20px;">exp: 10293</span></label>
                                        <input type="text" v-model="form.order_number" class="form-control" id="inputOrderNumber" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="input-customer-name">Type<span style="color: red;"> *</span></label>
                                        <multiselect
                                            v-model="form.type"
                                            :options="typeOptions"
                                            :multiple="false"
                                            placeholder="Select type"
                                            :allow-empty="false"
                                        ></multiselect>
                                        <div class="alert-red" v-if="form.errors.has('type')" v-html="form.errors.get('type')"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-customer-order-number">Customer order number</label>
                                        <input type="text" v-model="form.customer_order_number" class="form-control" id="inputCustomerOrderNumber" />
                                    </div>

                                    <div class="form-group">
                                        <label for="input-brand">Brand<span style="color: red;"> *</span></label>
                                        <!-- <input class="form-control" v-model="form.brand" type="text" id="inputBrand" required />  -->
                                        <multiselect
                                            v-model="form.brand"
                                            :options="brandOptions"
                                            :multiple="false"
                                            name="name"
                                            label="name"
                                            track-by="name"
                                            placeholder="Select the brand"
                                            :allow-empty="false"
                                        ></multiselect>
                                        <div class="alert-red" v-if="form.errors.has('brand')" v-html="form.errors.get('brand')"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-model">Model<span style="color: red;"> *</span></label>
                                        <!-- <input type="text" v-model="form.model" class="form-control" id="inputModel" required /> -->
                                        <multiselect
                                            v-model="form.model"
                                            :options="modelOptions"
                                            :multiple="false"
                                            name="name"
                                            label="name"
                                            track-by="name"
                                            placeholder="Select the model"
                                            :allow-empty="false"
                                        ></multiselect>
                                        <div class="alert-red" v-if="form.errors.has('model')" v-html="form.errors.get('model')"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-sku">SKU code<span style="color: red;"> *</span></label>
                                        <!-- <input type="text" v-model="form.sku" class="form-control" id="inputSku" required /> -->
                                        <multiselect
                                            v-model="form.sku"
                                            :options="skuOptions"
                                            :multiple="false"
                                            name="name"
                                            label="name"
                                            track-by="name"
                                            placeholder="Select the SKU"
                                            :allow-empty="false"
                                        ></multiselect>
                                        <div class="alert-red" v-if="form.errors.has('sku')" v-html="form.errors.get('sku')"></div>
                                    </div>

                                    <div class="form-group" v-if="form.type === 'Panel'">
                                        <label for="input-serial-number">Serial no.<span style="color: red;"> *</span></label>
                                        <input class="form-control" v-model="form.serial_number" type="text" id="inputSerialNumber" required /> 
                                    </div>

                                    <div class="form-group">
                                        <label for="input-quantity">MAC address</label>
                                        <input class="form-control" v-model="form.mac_address" type="text" /> 
                                    </div>

                                    <div class="form-group">
                                        <label for="input-qa-video-link">QA video link</label>
                                        <input class="form-control" v-model="form.qa_video_link" type="text" /> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-body">
                                    <!-- <div class="form-group">
                                        <label for="input-purchase-daet">Purchase date<span style="color: red;"> *</span></label>
                                        <input class="form-control" v-model="form.purchase_date" type="text" id="inputPurchaseDate" required /> 
                                    </div> -->

                                    <div class="form-group">
                                        <label for="input-manufacture-date">Manufacture date<span style="color: red;"> *</span></label>
                                        
                                        <datepicker
                                            placeholder=""
                                            format="yyyy-MM-dd"
                                            input-class ="my-picker-class"
                                            v-model="form.manufacture_date"
                                            :min-date="minDate"
                                            :disabled-dates="disabledDates"
                                            :class="{ 'is-invalid': form.errors.has('manufacture_date'), 'form-control': true, 'float-right': true }"
                                        ></datepicker>
                                                <!-- <input type="text" class="form-control float-right" v-model="form.manufacture_date" id="date_picker" :class="{ 'is-invalid' : form.errors.has('manufacture_date') }" /> -->
                                          
                                        <div class="alert-red" v-if="form.errors.has('manufacture_date')" v-html="form.errors.get('manufacture_date')"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-warranty-period">Warranty period<span style="color: red;"> *</span></label>
                                        <input class="form-control" v-model="form.warranty_period" type="text" id="inputWarrantyPeriod" required /> 
                                    </div>

                                    <div class="form-group">
                                        <label for="input-warranty-start-date">Warranty start date<span style="color: red;"> *</span></label>
                                        <datepicker
                                            placeholder=""
                                            format="yyyy-MM-dd"
                                            input-class ="my-picker-class"
                                            v-model="form.warranty_start_date"
                                            :min-date="minDate"
                                            :disabled-dates="disabledDates"
                                            :class="{ 'is-invalid': form.errors.has('warranty_start_date'), 'form-control': true, 'float-right': true }"
                                        ></datepicker>
                                        <!-- <input class="form-control" v-model="form.warranty_start_date" type="text" id="inputWarrantyStartDate" required />  -->
                                        <div class="alert-red" v-if="form.errors.has('warranty_start_date')" v-html="form.errors.get('warranty_start_date')"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-warranty-expiry-date">Warranty expiry date<span style="color: red;"> *</span></label>
                                        <datepicker
                                            placeholder=""
                                            format="yyyy-MM-dd"
                                            input-class ="my-picker-class"
                                            v-model="form.warranty_expiry_date"
                                            :min-date="minDate"
                                            :disabled-dates="disabledDates"
                                            :class="{ 'is-invalid': form.errors.has('warranty_expiry_date'), 'form-control': true, 'float-right': true }"
                                        ></datepicker>
                                        <!-- <input class="form-control" v-model="form.warranty_expiry_date" type="text" id="inputWarrantyExpiryDate" required />  -->
                                        <div class="alert-red" v-if="form.errors.has('warranty_expiry_date')" v-html="form.errors.get('warranty_expiry_date')"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-warranty-expiry-date">Components</label>
                                        <multiselect
                                            v-model="form.selected_components"
                                            :options="components"
                                            :multiple="true"
                                            label="label_name"
                                            track-by="id"
                                            placeholder="Select the components"
                                            :close-on-select="false"
                                        ></multiselect>
                                        <div style="margin-top: 5px; cursor: pointer;" v-if="(form.selected_components).length > 0">
                                            <a style="margin-right: 5px;" href="#" data-toggle="modal" data-target="#modal-component">
                                                View
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-warranty-expiry-date">Customer</label>
                                        <multiselect
                                            v-model="form.selected_customer"
                                            :options="customers"
                                            :multiple="false"
                                            name="name"
                                            label="name"
                                            track-by="id"
                                            placeholder="Select the customer"
                                            :allow-empty="true"
                                        ></multiselect>
                                    </div>

                                    <div class="form-group">
                                        <label for="input-component-remarks">Remarks</label>
                                        <textarea
                                            style="border: 1px solid #ced4da;"
                                            v-model="form.remarks"
                                            id="myTextarea"
                                        >
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="display: row; justify-content: space-between;">
                            <router-link to="/assets" class="btn btn-primary btn-add" style="float: left; background-color: #ccc; border-color: transparent;">Cancel</router-link>
                            <button type="submit" class="btn btn-success" style="float: right;" :disabled="disabled">
                                Save <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import { Form } from 'vform';
    import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";

    const state = {
        date: new Date(),
    };
    
    export default {
        components: {
            Multiselect,
            Datepicker
        },
        props: {
            user: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                minDate: new Date(), // Set the minimum date to today's date
                disabledDates: {
                    to: "" // Disable all dates up to today's date
                },
                modelOptions: [],
                brandOptions: [],
                typeOptions: ['Panel', 'Spare parts'],
                skuOptions: [],
                timeoutId: null,
                components: [],
                customers: [],
                selectedFile: null,
                previewImage: null,
                editorContent: '',
                counter: 5,
                disabled: false,
                loading: false,
                form: new Form({
                    order_number: '',
                    type: 'Panel',
                    customer_order_number: '',
                    model: '',
                    sku: '',
                    brand: '',
                    ram: '',
                    storage: '',
                    wifi: '',
                    serial_number: '',
                    mac_address: '',
                    qa_video_link: '',
                    manufacture_date: '',
                    warranty_period: '',
                    warranty_start_date: '',
                    warranty_expiry_date: '',
                    component_id: '',
                    customer_id: '',
                    remarks: '',
                    selected_customer: [],
                    selected_components: [],
                    brand_id: ''
                }),
            }
        },
        watch: {
            'form.brand': function(newVal) {
                this.onBrandSelect(newVal);
            }
        },
        computed: {
            
        },
        mounted() { 
            this.timeoutId = null;
            this.form.reset();

            axios.get('/brands/listing')
                .then(response => {
                    if (response.data.statusCode === 200) {[
                        this.brandOptions = response.data.data,
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
                    Swal.fire(
                        "500",
                        "Internal server error!",
                        "warning"
                    );
                });

            axios.get('/skus/listing')
                .then(response => {
                    if (response.data.statusCode === 200) {[
                        this.skuOptions = response.data.data,
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
                    Swal.fire(
                        "500",
                        "Internal server error!",
                        "warning"
                    );
                });
            
            axios.get('components/listing')
                .then(response => {
                    if (response.data.statusCode === 200) {[
                        this.components = response.data.data
                    ]
                    } else {
                        Swal.fire(
                            response.data.statusCode,
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

            axios.get('customers/listing')
                .then(response => {
                    if (response.data.statusCode === 200) {[
                        this.customers = response.data.data
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
        },
        methods: {
            validStart() {
                this.form.manufacture_date = $('#date_picker').val();
            },
            onBrandSelect(selectedBrand) {
                this.form.brand_id = selectedBrand['id'];
                console.log(this.form.brand_id);

                if (this.form.brand_id !== '') {
                    axios.get(`/models/${(this.form.brand_id)}`)
                        .then(response => {
                            if (response.data.statusCode === 200) {[
                                this.modelOptions = response.data.data,
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
                            Swal.fire(
                                "500",
                                "Internal server error!",
                                "warning"
                            );
                        });
                }
            },
            storeData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                if (this.form.brand == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please select the asset brand!'
                    });
                    this.loading = false;
                    this.disabled = false;
                    this.$Progress.fail();
                    return false;
                } else if (this.form.model == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please select the asset model!'
                    });
                    this.loading = false;
                    this.disabled = false;
                    this.$Progress.fail();
                    return false;
                } else if (this.form.sku == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please select the asset SKU code!'
                    });
                    this.loading = false;
                    this.disabled = false;
                    this.$Progress.fail();
                    return false;
                } 
                // else if ((this.form.selected_customer).length == 0) {
                //     Toast.fire({
                //         icon: 'error',
                //         title: 'Please select the customer!'
                //     });
                //     this.loading = false;
                //     this.disabled = false;
                //     this.$Progress.fail();
                //     return false;
                // }

                // API post request
                this.form.post('asset/add')
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'Asset added successfully.'
                        });

                        this.$Progress.finish();
                        $('.hide-message').css('display', 'block');
                        this.counter = 5;

                        const interval = setInterval(() => {
                            this.counter--;  // Update countdown every second
                        }, 1000);

                        // Wait 5 seconds, then redirect to "/assets"
                        this.timeoutId = setTimeout(() => {
                            clearInterval(interval);
                            $('.hide-message').css('display', 'none');
                            this.$router.push('/assets'); // Redirect to the desired route
                        }, 5000); // 5-second delay
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.data.error
                        });

                        this.$Progress.fail();
                        this.counter = 5;
                    }
                    this.loading = false;
                    this.disabled = false;
                })
                .catch((error) => {
                    console.log(error);
                    Swal.fire(
                        "500",
                        error.response.data.message,
                        "error"
                    );

                    this.$Progress.fail();
                    this.counter = 5;
                    this.loading = false;
                    this.disabled = false;
                });
            }
        },
        beforeDestroy() {
            if (this.timeoutId) {
                clearTimeout(this.timeoutId);
            }
        },
    }
</script>

<style>
    .my-picker-class {
        border: 1px solid transparent;
        width: 100%;
        outline: none;
    }
    textarea {
        width: 100%;
        height: 150px;
    }

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