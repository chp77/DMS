<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header" id="edit-component-header">
                <h2>Edit Component</h2>
 
                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        Component updated successfully, will redirect to the component listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" style="padding: 0 0 0 0;">
                        <div class="card-header">
                            <h3 class="card-title">Edit Component</h3>
                        </div>

                        <form @submit.prevent="updateData()">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="input-component-sku">Category<span style="color: red;"> *</span></label>
                                            <multiselect
                                                v-model="form.category"
                                                :options="categoryOptions"
                                                :multiple="false"
                                                placeholder="Select the category"
                                                :close-on-select="true"
                                                :allow-empty="false"
                                            ></multiselect>
                                        </div>

                                        <div class="form-group">
                                            <label for="input-component-brand">Brand<span style="color: red;"> *</span></label>
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
                                            <label for="input-component-model">Model<span style="color: red;"> *</span></label>
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
                                            <label for="input-component-price">Price<span style="color: red;"> *</span></label>
                                            <input type="number" v-model="form.price" class="form-control" min="1" id="inputComponentPrice" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="input-component-currency">Currency<span style="color: red;"> *</span></label>
                                            <input type="text" v-model="form.currency" class="form-control" id="inputComponentCurrency" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="input-component-product-image">Product image</label>
                                            <button type="button" @click="triggerFileInput" class="btn btn-success">Upload new image</button>
                                            <img v-if="form.product_image !== ''" :src="(form.product_image).replace(/[\[\]]/g, '')" alt="Image preview" class="row img-thumbnail" />
                                        </div>

                                        <input
                                            type="file"
                                            ref="fileInput"
                                            @change="handleImageUpload"
                                            accept="image/*"
                                            class="form-control"
                                            id="inputComponentProductImage"
                                            style="display: none;"
                                        />

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

                                <div class="col-md-6">
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'Android Motherboard'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>System Version<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardSystemVersion" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>CPU<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardCpu" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>GPU<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardGpu" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>RAM<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardRam" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Storage<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardStorage" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Wifi<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardWifi" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Hotspot<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardHotspot" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Bluetooth<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardBluetooth" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>WAN<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.androidMotherboardWan" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'Power Board'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>Size<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.powerBoardSize" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Total Power<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.powerBoardTotalPower" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>LED Power<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.powerBoardLedPower" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'OC'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>Size<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ocSize" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Level<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ocLevel" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Resolution<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ocResolution" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Contrast<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ocContrast" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'Logic Board'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>Resolution<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.logicBoardSize" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'Tempered Glass'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>Size<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.temperedGlassSize" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Thickness<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.temperedGlassThickness" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>AG<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.temperedGlassAg" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Color<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.temperedGlassSilkGreenColor" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'LED Light Strip'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>Size<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ledLightStripSize" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Lamp Power<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ledLightStripLampPower" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Number of Lamp Beads<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ledLightStripNumberOfLampBeads" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Number of Light Bars<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ledLightStripNumberOfLightBars" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Adaptable Backplane<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.ledLightStripAdaptableBackplane" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'Touch'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>Size<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.touchSize" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Mode<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.touchTouchMode" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Point<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.touchTouchPoint" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'Front Board'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>USB<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.preVersionUsb" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Type-C<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.preVersionTypeC" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>HDMI<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.preVersionHdmi" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Touch<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.preVersionTouch" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Light Sensitivity<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.preVersionLightSensitivity" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>IR<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.preVersionIr" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>LED<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.preVersionLed" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'Materials'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>Size<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.profileSize" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Fitting Method<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.profileFittingMethod" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Color<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.profileColor" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification !== '' && form.category === 'OPS'">
                                        <div v-for="(item, index) in form.specification" :key="index">
                                            <div class="form-group">
                                                <label>CPU<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.opsCpu" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>RAM<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.opsRam" class="form-control" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Hard Disk<span style="color: red;"> *</span></label>
                                                <input type="text" v-model="form.opsHarddisk" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" v-if="form.specification === '' && form.category === 'OPS'">
                                        <div class="form-group">
                                            <label>CPU<span style="color: red;"> *</span></label>
                                            <input type="text" v-model="form.opsCpu" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>RAM<span style="color: red;"> *</span></label>
                                            <input type="text" v-model="form.opsRam" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Hard Disk<span style="color: red;"> *</span></label>
                                            <input type="text" v-model="form.opsHarddisk" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="display: row; justify-content: space-between;">
                                <router-link to="/components" class="btn btn-primary btn-add" style="float: left; background-color: #ccc; border-color: transparent;">Cancel</router-link>
                                <button type="submit" class="btn btn-success" style="float: right;" :disabled="disabled">
                                    Save <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import { Form } from 'vform';
    import Spinner from "../Spinner.vue";
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            Multiselect
        },
        props: {
            user: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                brandOptions: [],
                modelOptions: [],
                categoryOptions: ['Android Motherboard', 'Power Board', 'OPS', 'OC', 'Logic Board', 'Tempered Glass', 'LED Light Strip', 'Touch', 'Front Board', 'Materials', 'Others'],
                statusOptions: ['In Order', 'Out of Order'],
                timeoutId: null,
                selectedFile: null,
                previewImage: null,
                counter: 5,
                disabled: false,
                loading: false,
                form: new Form({
                    brand: '',
                    model: '',
                    category: '',
                    status: '',
                    remarks: '',
                    price: '',
                    currency: '',
                    product_image: '',
                    new_product_image: '',
                    component_details_id: '',
                    specification: '',
                    androidMotherboardSystemVersion: '',
                    androidMotherboardCpu: '',
                    androidMotherboardGpu: '',
                    androidMotherboardRam: '',
                    androidMotherboardStorage: '',
                    androidMotherboardWifi: '',
                    androidMotherboardHotspot: '',
                    androidMotherboardBluetooth: '',
                    androidMotherboardWan: '',
                    preVersionUsb: '',
                    preVersionTypeC: '',
                    preVersionHdmi: '',
                    preVersionTouch: '',
                    preVersionLightSensitivity: '',
                    preVersionIr: '',
                    preVersionLed: '',
                    temperedGlassSize: '',
                    temperedGlassThickness: '',
                    temperedGlassAg: '',
                    temperedGlassSilkGreenColor: '',
                    touchSize: '',
                    touchTouchMode: '',
                    touchTouchPoint: '',
                    powerBoardSize: '',
                    powerBoardTotalPower: '',
                    powerBoardLedPower: '',
                    ocSize: '',
                    ocLevel: '',
                    ocResolution: '',
                    ocContrast: '',
                    profileSize: '',
                    profileFittingMethod: '',
                    profileColor: '',
                    logicBoardSize: '',
                    ledLightStripSize: '',
                    ledLightStripLampPower: '',
                    ledLightStripNumberOfLampBeads: '',
                    ledLightStripNumberOfLightBars:'',
                    ledLightStripAdaptableBackplane: '',
                    opsHarddisk: '',
                    opsCpu: '',
                    opsRam: '',
                }),
            }
        },
        computed: {
            
        },
        mounted() {
            this.form.reset();
            this.timeoutId = null;

            const currentUrl = window.location.href;
            const componentId = currentUrl.split("show/");
            
            axios.get(`/component/edit/${componentId[1]}`)
                .then(response => {
                    if (response.data.statusCode === 200) {
                        const componentInfo = response.data.data;
                        this.form.item_name = componentInfo.item_name;
                        this.form.brand = componentInfo.brand;
                        this.form.model = componentInfo.model;

                        if (componentInfo.category !== null) {
                            this.form.category = componentInfo.category;
                        }
                        
                        this.form.remarks = componentInfo.remarks;
                        this.form.specification = componentInfo.specification;
                        this.form.price = componentInfo.price;
                        this.form.currency = componentInfo.currency;

                        if (componentInfo.product_image !== null) {
                            this.form.product_image = componentInfo.product_image;
                        }

                        this.form.component_details_id = componentInfo.id;
                        
                        if (componentInfo.specification !== null || componentInfo.specification !== '' || componentInfo.specification !== '[]') {
                            if (this.form.category === 'Android Motherboard') {
                                this.form.androidMotherboardSystemVersion = componentInfo.specification[0]['system version'];
                                this.form.androidMotherboardCpu = componentInfo.specification[0]['cpu'];
                                this.form.androidMotherboardGpu = componentInfo.specification[0]['gpu'];
                                this.form.androidMotherboardRam = componentInfo.specification[0]['ram'];
                                this.form.androidMotherboardStorage = componentInfo.specification[0]['storage'];
                                this.form.androidMotherboardWifi = componentInfo.specification[0]['wifi'];
                                this.form.androidMotherboardHotspot = componentInfo.specification[0]['hotspot'];
                                this.form.androidMotherboardBluetooth = componentInfo.specification[0]['bluetooth'];
                                this.form.androidMotherboardWan = componentInfo.specification[0]['wan'];
                            } else if (this.form.category === 'Power Board') {
                                this.form.powerBoardSize = componentInfo.specification[0]['size'];
                                this.form.powerBoardTotalPower = componentInfo.specification[0]['total power'];
                                this.form.powerBoardLedPower = componentInfo.specification[0]['led power'];
                            } else if (this.form.category === 'OC') {
                                this.form.ocSize = componentInfo.specification[0]['size'];
                                this.form.ocLevel = componentInfo.specification[0]['level'];
                                this.form.ocResolution = componentInfo.specification[0]['resolution'];
                                this.form.ocContrast = componentInfo.specification[0]['contrast'];
                            } else if (this.form.category === 'Logic Board') {
                                this.form.logicBoardSize = componentInfo.specification[0]['size'];
                            } else if (this.form.category === 'Tempered Glass') {
                                this.form.temperedGlassSize = componentInfo.specification[0]['size'];
                                this.form.temperedGlassThickness = componentInfo.specification[0]['thickness'];
                                this.form.temperedGlassAg = componentInfo.specification[0]['ag'];
                                this.form.temperedGlassSilkGreenColor = componentInfo.specification[0]['color'];
                            } else if (this.form.category === 'LED Light Strip') {
                                this.form.ledLightStripSize = componentInfo.specification[0]['size'];
                                this.form.ledLightStripLampPower = componentInfo.specification[0]['lamp power'];
                                this.form.ledLightStripNumberOfLampBeads = componentInfo.specification[0]['number of lamp beads'];
                                this.form.ledLightStripNumberOfLightBars = componentInfo.specification[0]['number of light bars'];
                                this.form.ledLightStripAdaptableBackplane = componentInfo.specification[0]['adaptable backplane'];
                            } else if (this.form.category === 'Touch') {
                                this.form.touchSize = componentInfo.specification[0]['size'];
                                this.form.touchTouchMode = componentInfo.specification[0]['mode'];
                                this.form.touchTouchPoint = componentInfo.specification[0]['point'];
                            } else if (this.form.category === 'Front Board') {
                                this.form.preVersionUsb = componentInfo.specification[0]['usb'];
                                this.form.preVersionTypeC = componentInfo.specification[0]['type-c'];
                                this.form.preVersionHdmi = componentInfo.specification[0]['hdmi'];
                                this.form.preVersionTouch = componentInfo.specification[0]['touch'];
                                this.form.preVersionLightSensitivity = componentInfo.specification[0]['light sensitivity'];
                                this.form.preVersionIr = componentInfo.specification[0]['ir'];
                                this.form.preVersionLed = componentInfo.specification[0]['led'];
                            } else if (this.form.category === 'Materials') {
                                this.form.profileSize = componentInfo.specification[0]['size'];
                                this.form.profileFittingMethod = componentInfo.specification[0]['fitting method'];
                                this.form.profileColor = componentInfo.specification[0]['color'];
                            } else if (this.form.category === 'OPS' && componentInfo.specification) {
                                this.form.opsCpu = componentInfo.specification[0]['cpu'];
                                this.form.opsRam = componentInfo.specification[0]['ram'];
                                this.form.opsHarddisk = componentInfo.specification[0]['hard disk'];
                            }
                        }
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


        },
        watch: {
            'form.brand': function(newVal) {
                this.onBrandSelect(newVal);
            }
        },
        methods: {
            onBrandChange(selectedBrand) {
                this.form.model = '';
                console.log('asdasd'+this.form.model);
            },
            onBrandSelect(selectedBrand) {
                this.form.brand_id = selectedBrand['id'];

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
            triggerFileInput() {
                if (this.$refs.fileInput) {
                    // Simulate a click on the file input to open the file selection dialog
                    this.$refs.fileInput.click();
                } else {
                    console.log('File input reference not found.');
                }
            },
            handleImageUpload(event) {
                // Get the file from the input
                const file = event.target.files[0];

                if (file) {
                    this.form.new_product_image = file;
                    this.selectedFile = file; // Save the selected file
                    this.form.product_image = URL.createObjectURL(file);
                    this.previewImage = URL.createObjectURL(file); // Create a preview URL
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

                const formData = new FormData();

                const currentUrl2 = window.location.href;
                const componentId2 = currentUrl2.split("show/");

                // Append other form data
                formData.append('item_name', this.form.item_name);
                formData.append('brand', this.form.brand);
                formData.append('sku', this.form.sku);
                formData.append('serial_number', this.form.serial_number);
                formData.append('status', this.form.status);
                formData.append('purchase_date', this.form.purchase_date);
                formData.append('warranty_period', this.form.warranty_period);
                formData.append('warranty_start_date', this.form.warranty_start_date);
                formData.append('warranty_expiry_date', this.form.warranty_expiry_date);
                formData.append('remarks', this.form.remarks);
                formData.append('manufacture_by', this.form.manufacture_by);
                formData.append('factory_warranty', this.form.factory_warranty);
                formData.append('price', this.form.price);
                formData.append('currency', this.form.currency);

                // If an image is selected, add it to the form data
                if (this.selectedFile) {
                    formData.append('product_image', this.selectedFile);
                }

                if (this.form.new_product_image) {
                    formData.append('new_product_image', this.form.new_product_image);
                }

                // API post request
                this.form.post(`/component/update/${componentId2[1]}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Important for file uploads
                    },
                })
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'Component updated.'
                        });

                        this.$Progress.finish();

                        const element = document.getElementById('edit-component-header');
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
                            this.$router.push('/components'); // Redirect to the desired route
                        }, 5000); // 5-second delay
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.data.message
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
                        error.message,
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
            // Clean up the preview URL to avoid memory leaks
            if (this.previewImage) {
                URL.revokeObjectURL(this.previewImage);
            }

            if (this.timeoutId) {
                clearTimeout(this.timeoutId);
            }
        },
    }
</script>

<style>
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

    .img-thumbnail {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
        margin-top: 10px;
    }
</style>