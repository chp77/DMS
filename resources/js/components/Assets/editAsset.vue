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
        
        <div class="header" id="edit-asset-header">
            <h2>Edit Asset</h2>

            <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                <div class="card-header">
                    Asset updated successfully, will redirect to the asset listing page in {{counter}} seconds ...
                </div>
            </div>
        </div>

        <form @submit.prevent="updateData()">
            <div class="row">
                <div class="card card-primary" style="padding: 0 0 0 0;">
                    <div class="card-header">
                        <h3 class="card-title">Edit Asset</h3>
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
                                    <input type="text" v-model="form.type" class="form-control" id="inputType" readonly/>
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
                                        @input="onBrandChange"
                                    ></multiselect>
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
                                    ></multiselect>
                                </div>

                                <div class="form-group">
                                    <label for="input-sku">SKU code<span style="color: red;"> *</span></label>
                                    <!-- <input type="text" v-model="form.sku" class="form-control" id="inputSku" required /> -->
                                    <multiselect
                                        v-model="form.sku"
                                        :options="skuOptions"
                                        :multiple="false"
                                        placeholder="Select the SKU"
                                        name="name"
                                        label="name"
                                        track-by="name"
                                        :allow-empty="false"
                                    ></multiselect>
                                </div>

                                <div class="form-group" v-if="form.type === 'Panel'">
                                    <!-- <qr-code style="justify-content: center; display: flex" :text="form.serial_number"></qr-code> -->
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
                                    <!-- <input class="form-control" v-model="form.manufacture_date" type="text" id="inputManufactureDate" required />  -->
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
                                        :class="{ 'is-invalid': form.errors.has('manufacture_date'), 'form-control': true, 'float-right': true }"
                                    ></datepicker>
                                    <!-- <input class="form-control" v-model="form.warranty_start_date" type="text" id="inputWarrantyStartDate" required />  -->
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
                                        :class="{ 'is-invalid': form.errors.has('manufacture_date'), 'form-control': true, 'float-right': true }"
                                    ></datepicker>
                                    <!-- <input class="form-control" v-model="form.warranty_expiry_date" type="text" id="inputWarrantyExpiryDate" required />  -->
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
                componentDetails: [],
                minDate: new Date(), // Set the minimum date to today's date
                disabledDates: {
                    to: "" // Disable all dates up to today's date
                },
                modelOptions: [],
                brandOptions: [],
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
                    customer_order_number: '',
                    model: '',
                    brand: '',
                    ram: '',
                    sku: '',
                    storage: '',
                    wifi: '',
                    serial_number: '',
                    mac_address: '',
                    qa_video_link: '',
                    purchase_date: '',
                    manufacture_date: '',
                    warranty_period: '',
                    warranty_start_date: '',
                    warranty_expiry_date: '',
                    component_id: '',
                    customer_id: '',
                    remarks: '',
                    selected_customer: [],
                    selected_components: [],
                }),
                modalForm: new Form({
                    androidMotherboardCategory: '',
                    androidMotherboardSystemVersion: '',
                    androidMotherboardCpu: '',
                    androidMotherboardGpu: '',
                    androidMotherboardRam: '',
                    androidMotherboardStorage: '',
                    androidMotherboardWifi: '',
                    androidMotherboardHotspot: '',
                    androidMotherboardBluetooth: '',
                    androidMotherboardWan: '',
                    preVersionCategory: '',
                    preVersionUsb: '',
                    preVersionTypeC: '',
                    preVersionHdmi: '',
                    preVersionTouch: '',
                    preVersionLightSensitivity: '',
                    preVersionIr: '',
                    preVersionLed: '',
                    temperedGlassCategory: '',
                    temperedGlassSize: '',
                    temperedGlassThickness: '',
                    temperedGlassAg: '',
                    temperedGlassSilkGreenColor: '',
                    touchCategory: '',
                    touchSize: '',
                    touchTouchMode: '',
                    touchTouchPoint: '',
                    powerBoardCategory: '',
                    powerBoardSize: '',
                    powerBoardTotalPower: '',
                    powerBoardLedPower: '',
                    ocCategory: '',
                    ocSize: '',
                    ocLevel: '',
                    ocResolution: '',
                    ocContrast: '',
                    profileCategory: '',
                    profileSize: '',
                    profileFittingMethod: '',
                    profileColor: '',
                    logicBoardCategory: '',
                    logicBoardResolution: '',
                    ledLightStripCategory: '',
                    ledLightStripSize: '',
                    ledLightStripLampPower: '',
                    ledLightStripNumberOfLampBeads: '',
                    ledLightStripNumberOfLightBars:'',
                    ledLightStripAdaptableBackplane: '',
                })
            }
        },
        mounted() {
            this.form.reset();
            this.timeoutId = null;

            const currentUrl = window.location.href;
            const assetId = currentUrl.split("show/");
            
            axios.get(`/asset/edit/${assetId[1]}`)
                .then(response => {
                    if (response.data.statusCode === 200) {
                        const assetInfo = response.data.data;
                        this.form.order_number = assetInfo.order_number;
                        this.form.type = assetInfo.type;
                        this.form.customer_order_number = assetInfo.customer_order_number;
                        this.form.brand = assetInfo.brand;
                        this.form.model = assetInfo.model;
                        this.form.serial_number = assetInfo.serial_number;
                        this.form.mac_address = assetInfo.mac_address;
                        this.form.manufacture_date = assetInfo.manufacture_date;
                        this.form.warranty_period = assetInfo.warranty_period;
                        this.form.warranty_start_date = assetInfo.warranty_started_date;
                        this.form.warranty_expiry_date = assetInfo.warranty_expiry_date;
                        this.form.component_id = assetInfo.component_ids;
                        this.form.customer_id = assetInfo.customer_id;

                        if (assetInfo.customer_id !== null) {
                            this.form.selected_customer = assetInfo.customer_id;
                        }

                        if (assetInfo.component_ids !== null) {
                            this.form.selected_components = assetInfo.component_ids;
                        }

                        this.form.remarks = assetInfo.remarks;
                        this.form.sku = assetInfo.sku;
                        this.form.qa_video_link = assetInfo.qa_video_url;
                        // parse the data to the form
                    } else {
                        console.log(response);
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
                        error.response.data.message,
                        "warning"
                    );
                });
            
            axios.get('/components/listing')
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

            axios.get('/customers/listing')
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

            axios.get('/models/listing')
                .then(response => {
                    if (response.data.statusCode === 200) {[
                        this.modelOptions = response.data.data.map(model => model.name),
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
        },
        watch: {
            'form.brand': function(newVal) {
                this.onBrandSelect(newVal);
            },
        },
        methods: {
            onBrandChange(selectedBrand) {
                this.form.model = '';
            },
            onBrandSelect(selectedBrand) {
                this.form.brand_id = selectedBrand['id'];

                if (this.form.brand_id !== '') {
                    axios.get(`/models/${(this.form.brand['id'])}`)
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
            updateData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                if (this.form.model == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please select the model!'
                    });
                    this.loading = false;
                    this.disabled = false;
                    this.$Progress.fail();
                    return false;
                }

                const currentUrl2 = window.location.href;
                const assetId2 = currentUrl2.split("show/");

                // API post request
                this.form.post(`/asset/update/${assetId2[1]}`)
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'Asset updated.'
                        });

                        this.$Progress.finish();

                        const element = document.getElementById('edit-asset-header');
                        if (element) {
                            element.scrollIntoView({ behavior: 'smooth' });
                        }

                        $('.hide-message').css('display', 'block');
                        this.counter = 5;

                        const interval = setInterval(() => {
                            this.counter--;  // Update countdown every second
                        }, 1000);

                        // Wait 5 seconds, then redirect to "/customers"
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
                    Swal.fire(
                        "Error",
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
    .table-tb {
        width: 100%;
        border-collapse: collapse;
    }
    .table-tb, .table-th, .table-td {
        border: 1px solid black;
    }
    .table-th, .table-td {
        padding: 15px;
        text-align: left;
    }
    .table-th {
        background-color: #f2f2f2;
    }
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