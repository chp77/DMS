<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header">
                <h2>Add Component</h2>
 
                <div class="card col-md-12 hide-message" style="padding: 0 0 0 0; background-color: #117f2a; color: white;">
                    <div class="card-header">
                        New component added successfully, will redirect to the component listing page in {{counter}} seconds ...
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-tabs" style="padding: 0 0 0 0;">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-general-tab" ref="generalTab" data-toggle="pill" href="#custom-tabs-one-general" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">General</a>
                                </li>
                                <li class="nav-item" v-if="form.category !== ''">
                                    <a class="nav-link" id="custom-tabs-one-info-tab" ref="infoTab" data-toggle="pill" href="#custom-tabs-one-info" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Info</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="storeData()">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-general" role="tabpanel" aria-labelledby="custom-tabs-one-general-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="input-component-category">Category<span style="color: red;"> *</span></label>
                                                        <multiselect
                                                            v-model="form.category"
                                                            :options="categoryOptions"
                                                            :multiple="false"
                                                            placeholder="Select the category"
                                                            :close-on-select="true"
                                                            :allow-empty="false"
                                                            class="category-class"
                                                        ></multiselect>
                                                        <span id="categoryError" class="text-danger hide">This field is required</span>
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
                                                            class="brand-class"
                                                        ></multiselect>
                                                        <span id="brandError" class="text-danger hide">This field is required</span>
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
                                                            :allow-empty="false"
                                                            class="model-class"
                                                        ></multiselect>
                                                        <span id="modelError" class="text-danger hide">This field is required</span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="input-component-price">Price<span style="color: red;"> *</span></label>
                                                        <input type="number" v-model="form.price" class="form-control" id="inputComponentPrice" min="1" />
                                                        <span id="priceError" class="text-danger hide">This field is required</span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="input-component-currency">Currency<span style="color: red;"> *</span></label>
                                                        <input type="text" v-model="form.currency" class="form-control" id="inputComponentCurrency" />
                                                        <span id="currencyError" class="text-danger hide">This field is required</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="input-component-product-image">Product image</label>
                                                        <input
                                                            type="file"
                                                            @change="handleImageUpload"
                                                            accept="image/*"
                                                            class="form-control"
                                                            id="inputComponentProductImage"
                                                        />
                                                    </div>
                                                    
                                                    <div v-if="previewImage">
                                                        <label class="col-md-2">Preview:</label>
                                                        <img :src="previewImage" alt="Image preview" class="img-thumbnail" />
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
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-info" role="tabpanel" aria-labelledby="custom-tabs-one-info-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-body" v-if="form.category == 'Android Motherboard'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Android Motherboard</h3>
                                                        </div>

                                                        <div class="card-body row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-system-version">System Version<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardSystemVersion" id="inputMotherBoardSystemVersion" />
                                                                    <span id="motherBoardSystemVersionError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-cpu">CPU<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardCpu" id="inputMotherBoardCpu" />
                                                                    <span id="motherBoardCpuError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-gpu">GPU<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardGpu" id="inputMotherBoardGpu" />
                                                                    <span id="motherBoardGpuError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-ram">RAM<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardRam" id="inputMotherBoardRam" />
                                                                    <span id="motherBoardRamError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-storage">Storage<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardStorage" id="inputMotherBoardStorage" />
                                                                    <span id="motherBoardStorageError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-wifi">Wifi<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardWifi" id="inputMotherBoardWifi" />
                                                                    <span id="motherBoardWifiError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-hotspot">Hotspot<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardHotspot" id="inputMotherBoardHotspot" />
                                                                    <span id="motherBoardHotspotError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-bluetooth">Bluetooth<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardBluetooth" id="inputMotherBoardBluetooh" />
                                                                    <span id="motherBoardBluetoothError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="input-mother-board-wan">WAN<span style="color: red;"> *</span></label>
                                                                    <input type="text" class="form-control" v-model="form.androidMotherboardWan" id="inputMotherBoardWan" />
                                                                    <span id="motherBoardWanError" class="text-danger hide">This field is required</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'OPS'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">OPS</h3>
                                                        </div>

                                                        <div class="card-body row">
                                                            <div class="form-group">
                                                                <label for="input-ops-cpu">CPU<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.opsCpu" id="inputOpsCpu" />
                                                                <span id="opsCpuError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-ops-ram">RAM<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.opsRam" id="inputOpsRam" />
                                                                <span id="opsRamError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-ops-harddisk">Hard Disk<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.opsHarddisk" id="inputOpsHarddisk" />
                                                                <span id="opsHarddiskError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'Front Board'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Front Board</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-pre-version-usb">USB<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.preVersionUsb" id="inputPreVersiondUsb" />
                                                                <span id="preVersionUsbError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-pre-version-type-c">Type-C<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.preVersionTypeC" id="inputPreVersiondTypeC" />
                                                                <span id="preVersionTypeCError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-pre-version-hdmi">HDMI<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.preVersionHdmi" id="inputPreVersiondHdmi" />
                                                                <span id="preVersionHdmiError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-pre-version-touch">Touch<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.preVersionTouch" id="inputPreVersiondTouch" />
                                                                <span id="preVersionTouchError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-pre-version-light-sensitivity">Light Sensitivity<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.preVersionLightSensitivity" id="inputPreVersiondLightSensitivity" />
                                                                <span id="preVersionLightSensitivityError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-pre-version-ir">IR<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.preVersionIr" id="inputPreVersiondIr" />
                                                                <span id="preVersionIrError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-pre-version-led">LED<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.preVersionLed" id="inputPreVersiondLed" />
                                                                <span id="preVersionLedError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'Tempered Glass'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Tempered Glass</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-tempered-glass-size">Size<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.temperedGlassSize" id="inputTemperedGlassSize" />
                                                                <span id="temperedGlassSizeError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-tempered-glass-thickness">Thickness<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.temperedGlassThickness" id="inputTemperedGlassThickness" />
                                                                <span id="temperedGlassThicknessError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-tempered-glass-ag">AG<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.temperedGlassAg" id="inputTemperedGlassAg" />
                                                                <span id="temperedGlassAgError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-tempered-glass-silk-screen-color">Silk Screen Color<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.temperedGlassSilkGreenColor" id="inputTemperedGlassSilsScreenColor" />
                                                                <span id="temperedGlassSilkScreenColorError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'Touch'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Touch</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-touch-size">Size<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.touchSize" id="inputTouchSize" />
                                                                <span id="touchSizeError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-touch-touch-mode">Touch Mode<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.touchTouchMode" id="inputTouchTouchMode" />
                                                                <span id="touchTouchModeError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-touch-touch-point">Touch Point<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.touchTouchPoint" id="inputTouchTouchPoint" />
                                                                <span id="touchTouchPointError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="card-body" v-else-if="form.category == 'Power Board'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Power Board</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-power-board-size">Size<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.powerBoardSize" id="inputPowerBoardSize" />
                                                                <span id="powerBoardSizeError" class="text-danger hide">This field is required</span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="input-power-board-total-power">Total Power<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.powerBoardTotalPower" id="inputPowerBoardTotalPower" />
                                                                <span id="powerBoardTotalPowerError" class="text-danger hide">This field is required</span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="input-power-board-led-power">LED Power<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.powerBoardLedPower" id="inputPowerBoardLedPower" />
                                                                <span id="powerBoardLedPowerError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'OC'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">OC</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-oc-size">Size<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ocSize" id="inputOcSize" />
                                                                <span id="ocSizeError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-oc-level">Level<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ocLevel" id="inputOcLevel" />
                                                                <span id="ocLevelError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-oc-resolution">Resolution<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ocResolution" id="inputOcResolution" />
                                                                <span id="ocResolutionError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-oc-contrast">Contrast<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ocContrast" id="inputOcContrast" />
                                                                <span id="ocContrastError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'Materials'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Materials</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-profile-size">Size<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.profileSize" id="inputProfileSize" />
                                                                <span id="profiletSizeError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-profile-fitting-method">Fitting Method<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.profileFittingMethod" id="inputProfileFittingMethod" />
                                                                <span id="profileFittingMethodError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-oc-color">Color<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.profileColor" id="inputProfileCcolor" />
                                                                <span id="profileColorError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'Logic Board'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Logic Board</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-logic-board-resolution">Resolution<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.logicBoardResolution" id="inputLogicBoardResolution" />
                                                                <span id="logicBoardResolutiontError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body" v-else-if="form.category == 'LED Light Strip'">
                                                    <div class="card card-warning">
                                                        <div class="card-header">
                                                            <h3 class="card-title">LED Light Strip</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="input-led_light-stript-size">Size<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ledLightStripSize" id="inputLedLightStriptSize" />
                                                                <span id="ledLightStripeSizeError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-led_light-stript-lamp-power">Lamp Power<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ledLightStripLampPower" id="inputLedLightStriptLampPower" />
                                                                <span id="ledLightStripeLampPowerError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-led_light-stript-number-of-lamp-beads">Number of Lamp Beads<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ledLightStripNumberOfLampBeads" id="inputLedLightStriptNumberOfLampBeads" />
                                                                <span id="ledLightStripeNumberOfLampBeadsError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-led_light-stript-number-of-light-bars">Number of Light Bars<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ledLightStripNumberOfLightBars" id="inputLedLightStriptNumberOfLightBars" />
                                                                <span id="ledLightStripeNumberOfLightBarsError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-led_light-stript-adaptable-backplane">Adaptable Backplane<span style="color: red;"> *</span></label>
                                                                <input type="text" class="form-control" v-model="form.ledLightStripAdaptableBackplane" id="inputLedLightStriptAdaptableBackplane" />
                                                                <span id="ledLightStripeAdaptableBackplaneError" class="text-danger hide">This field is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import { Form } from 'vform';
import { triggerRef } from 'vue';
    import Multiselect from 'vue-multiselect';
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
                minDate: new Date(), // Set the minimum date to today's date
                disabledDates: {
                    to: "" // Disable all dates up to today's date
                },
                brandOptions: [],
                modelOptions: [],
                timeoutId: null,
                statusOptions: ['In Order', 'Out of Order'],
                categoryOptions: ['Android Motherboard', 'Power Board', 'OPS', 'OC', 'Logic Board', 'Tempered Glass', 'LED Light Strip', 'Touch', 'Front Board', 'Materials'],
                selectedFile: null,
                previewImage: null,
                counter: 5,
                disabled: false,
                loading: false,
                form: new Form({
                    brand: '',
                    model: '',
                    category: '',
                    remarks: '',
                    price: '',
                    currency: '',
                    product_image: '',
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
                    opsCpu:'',
                    opsRam: '',
                    opsHarddisk: '',
                    profileSize: '',
                    profileFittingMethod: '',
                    profileColor: '',
                    logicBoardResolution: '',
                    ledLightStripSize: '',
                    ledLightStripLampPower: '',
                    ledLightStripNumberOfLampBeads: '',
                    ledLightStripNumberOfLightBars:'',
                    ledLightStripAdaptableBackplane: '',
                }),
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
        },
        watch: {
            'form.category': function(val) {
                if (val !== '') {
                    $('.category-class').css('border', '1px solid #ced4da');
                    $('#categoryError').addClass('hide');
                }
            },
            'form.brand': function(newVal) {
                this.onBrandSelect(newVal);

                if (newVal !== '') {
                    $('.brand-class').css('border', '1px solid #ced4da');
                    $('#brandError').addClass('hide');
                }
            },
            'form.model': function(val) {
                if (val !== '') {
                    $('.model-class').css('border', '1px solid #ced4da');
                    $('#modelError').addClass('hide');
                }
            },
            'form.price': function(val) {
                if (val !== '') {
                    $('#inputComponentPrice').css('border', '1px solid #ced4da');
                    $('#priceError').addClass('hide');
                }
            },
            'form.currency': function(val) {
                if (val !== '') {
                    $('#inputComponentCurrency').css('border', '1px solid #ced4da');
                    $('#currencyError').addClass('hide');
                }
            },
            'form.androidMotherboardSystemVersion': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardSystemVersion').css('border', '1px solid #ced4da');
                    $('#motherBoardSystemVersionError').addClass('hide');
                }
            },
            'form.androidMotherboardCpu': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardCpu').css('border', '1px solid #ced4da');
                    $('#motherBoardCpuError').addClass('hide');
                }
            },
            'form.androidMotherboardGpu': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardGpu').css('border', '1px solid #ced4da');
                    $('#motherBoardGpuError').addClass('hide');
                }
            },
            'form.androidMotherboardRam': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardRam').css('border', '1px solid #ced4da');
                    $('#motherBoardRamError').addClass('hide');
                }
            },
            'form.androidMotherboardStorage': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardStorage').css('border', '1px solid #ced4da');
                    $('#motherBoardStorageError').addClass('hide');
                }
            },
            'form.preVersionTouch': function(val) {
                if (val !== '') {
                    $('#inputPreVersiondTouch').css('border', '1px solid #ced4da');
                    $('#preVersionTouchError').addClass('hide');
                }
            },
            'form.androidMotherboardWifi': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardWifi').css('border', '1px solid #ced4da');
                    $('#motherBoardWifiError').addClass('hide');
                }
            },
            'form.androidMotherboardHotspot': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardHotspot').css('border', '1px solid #ced4da');
                    $('#motherBoardHotspotError').addClass('hide');
                }
            },
            'form.androidMotherboardBluetooth': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardBluetooh').css('border', '1px solid #ced4da');
                    $('#motherBoardBluetoothError').addClass('hide');
                }
            },
            'form.androidMotherboardWan': function(val) {
                if (val !== '') {
                    $('#inputMotherBoardWan').css('border', '1px solid #ced4da');
                    $('#motherBoardWanError').addClass('hide');
                }
            },
            'form.preVersionUsb': function(val) {
                if (val !== '') {
                    $('#inputPreVersiondUsb').css('border', '1px solid #ced4da');
                    $('#preVersionUsbError').addClass('hide');
                }
            },
            'form.preVersionTypeC': function(val) {
                if (val !== '') {
                    $('#inputPreVersiondTypeC').css('border', '1px solid #ced4da');
                    $('#preVersionTypeCError').addClass('hide');
                }
            },
            'form.preVersionHdmi': function(val) {
                if (val !== '') {
                    $('#inputPreVersiondHdmi').css('border', '1px solid #ced4da');
                    $('#preVersionHdmiError').addClass('hide');
                }
            },
            'form.preVersionLightSensitivity': function(val) {
                if (val !== '') {
                    $('#inputPreVersiondLightSensitivity').css('border', '1px solid #ced4da');
                    $('#preVersionLightSensitivityError').addClass('hide');
                }
            },
            'form.preVersionIr': function(val) {
                if (val !== '') {
                    $('#inputPreVersiondIr').css('border', '1px solid #ced4da');
                    $('#preVersionIrError').addClass('hide');
                }
            },
            'form.preVersionLed': function(val) {
                if (val !== '') {
                    $('#inputPreVersiondLed').css('border', '1px solid #ced4da');
                    $('#preVersionLedError').addClass('hide');
                }
            },
            'form.temperedGlassSize': function(val) {
                if (val !== '') {
                    $('#inputTemperedGlassSize').css('border', '1px solid #ced4da');
                    $('#temperedGlassSizeError').addClass('hide');
                }
            },
            'form.temperedGlassThickness': function(val) {
                if (val !== '') {
                    $('#inputTemperedGlassThickness').css('border', '1px solid #ced4da');
                    $('#temperedGlassThicknessError').addClass('hide');
                }
            },
            'form.temperedGlassAg': function(val) {
                if (val !== '') {
                    $('#inputTemperedGlassAg').css('border', '1px solid #ced4da');
                    $('#temperedGlassAgError').addClass('hide');
                }
            },
            'form.temperedGlassSilkGreenColor': function(val) {
                if (val !== '') {
                    $('#inputTemperedGlassSilsScreenColor').css('border', '1px solid #ced4da');
                    $('#temperedGlassSilkScreenColorError').addClass('hide');
                }
            },
            'form.touchSize': function(val) {
                if (val !== '') {
                    $('#inputTouchSize').css('border', '1px solid #ced4da');
                    $('#touchSizeError').addClass('hide');
                }
            },
            'form.touchTouchMode': function(val) {
                if (val !== '') {
                    $('#inputTouchTouchMode').css('border', '1px solid #ced4da');
                    $('#touchTouchModeError').addClass('hide');
                }
            },
            'form.touchTouchPoint': function(val) {
                if (val !== '') {
                    $('#inputTouchTouchPoint').css('border', '1px solid #ced4da');
                    $('#touchTouchPointError').addClass('hide');
                }
            },
            'form.powerBoardSize': function(val) {
                if (val !== '') {
                    $('#inputPowerBoardSize').css('border', '1px solid #ced4da');
                    $('#powerBoardSizeError').addClass('hide');
                }
            },
            'form.powerBoardTotalPower': function(val) {
                if (val !== '') {
                    $('#inputPowerBoardTotalPower').css('border', '1px solid #ced4da');
                    $('#powerBoardTotalPowerError').addClass('hide');
                }
            },
            'form.powerBoardLedPower': function(val) {
                if (val !== '') {
                    $('#inputPowerBoardLedPower').css('border', '1px solid #ced4da');
                    $('#powerBoardLedPowerError').addClass('hide');
                }
            },
            'form.ocSize': function(val) {
                if (val !== '') {
                    $('#inputOcSize').css('border', '1px solid #ced4da');
                    $('#ocSizeError').addClass('hide');
                }
            },
            'form.ocLevel': function(val) {
                if (val !== '') {
                    $('#inputOcLevel').css('border', '1px solid #ced4da');
                    $('#ocLevelError').addClass('hide');
                }
            },
            'form.ocResolution': function(val) {
                if (val !== '') {
                    $('#inputOcResolution').css('border', '1px solid #ced4da');
                    $('#ocResolutionError').addClass('hide');
                }
            },
            'form.ocContrast': function(val) {
                if (val !== '') {
                    $('#inputOcContrast').css('border', '1px solid #ced4da');
                    $('#ocContrastError').addClass('hide');
                }
            },
            'form.profileSize': function(val) {
                if (val !== '') {
                    $('#inputProfileSize').css('border', '1px solid #ced4da');
                    $('#profiletSizeError').addClass('hide');
                }
            },
            'form.profileFittingMethod': function(val) {
                if (val !== '') {
                    $('#inputProfileFittingMethod').css('border', '1px solid #ced4da');
                    $('#profileFittingMethodError').addClass('hide');
                }
            },
            'form.profileColor': function(val) {
                if (val !== '') {
                    $('#inputProfileCcolor').css('border', '1px solid #ced4da');
                    $('#profileColorError').addClass('hide');
                }
            },
            'form.logicBoardResolution': function(val) {
                if (val !== '') {
                    $('#inputLogicBoardResolution').css('border', '1px solid #ced4da');
                    $('#logicBoardResolutiontError').addClass('hide');
                }
            },
            'form.ledLightStripSize': function(val) {
                if (val !== '') {
                    $('#inputLedLightStriptSize').css('border', '1px solid #ced4da');
                    $('#ledLightStripeSizeError').addClass('hide');
                }
            },
            'form.ledLightStripLampPower': function(val) {
                if (val !== '') {
                    $('#inputLedLightStriptLampPower').css('border', '1px solid #ced4da');
                    $('#ledLightStripeLampPowerError').addClass('hide');
                }
            },
            'form.ledLightStripNumberOfLampBeads': function(val) {
                if (val !== '') {
                    $('#inputLedLightStriptNumberOfLampBeads').css('border', '1px solid #ced4da');
                    $('#ledLightStripeNumberOfLampBeadsError').addClass('hide');
                }
            },
            'form.ledLightStripNumberOfLightBars': function(val) {
                if (val !== '') {
                    $('#inputLedLightStriptNumberOfLightBars').css('border', '1px solid #ced4da');
                    $('#ledLightStripeNumberOfLightBarsError').addClass('hide');
                }
            },
            'form.ledLightStripAdaptableBackplane': function(val) {
                if (val !== '') {
                    $('#inputLedLightStriptAdaptableBackplane').css('border', '1px solid #ced4da');
                    $('#ledLightStripeAdaptableBackplaneError').addClass('hide');
                }
            },
            'form.opsCpu': function(val) {
                if (val !== '') {
                    $('#inputOpsCpu').css('border', '1px solid #ced4da');
                    $('#opsCpuError').addClass('hide');
                }
            },
            'form.opsRam': function(val) {
                if (val !== '') {
                    $('#inputOpsRam').css('border', '1px solid #ced4da');
                    $('#opsRamError').addClass('hide');
                }
            },
            'form.opsHarddisk': function(val) {
                if (val !== '') {
                    $('#inputOpsHarddisk').css('border', '1px solid #ced4da');
                    $('#opsHarddiskError').addClass('hide');
                }
            }
        },
        methods: {
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
            handleImageUpload(event) {
                // Get the file from the input
                const file = event.target.files[0];
                if (file) {
                    this.form.product_image = file;
                    this.selectedFile = file; // Save the selected file
                    this.previewImage = URL.createObjectURL(file); // Create a preview URL
                }
            },
            storeData() {
                if (this.form.price === '' || this.form.currency === '' || this.form.category === '' || this.form.brand === '' || this.form.model === '') {
                    this.$refs.generalTab.click();

                    if (this.form.category === '') {
                        $('.category-class').css('border', '1px solid red');
                        $('.category-class').css('border-radius', '5px');
                        $('#categoryError').removeClass('hide');
                    }

                    if (this.form.brand === '') {
                        $('.brand-class').css('border', '1px solid red');
                        $('.brand-class').css('border-radius', '5px');
                        $('#brandError').removeClass('hide');
                    }

                    if (this.form.model === '') {
                        $('.model-class').css('border', '1px solid red');
                        $('.model-class').css('border-radius', '5px');
                        $('#modelError').removeClass('hide');
                    }

                    if (this.form.price === '') {
                        $('#inputComponentPrice').css('border', '1px solid red');
                        $('#priceError').removeClass('hide');
                    }

                    if (this.form.currency === '') {
                        $('#inputComponentCurrency').css('border', '1px solid red');
                        $('#currencyError').removeClass('hide');
                    }

                    this.loading = false;
                    this.disabled = false;
                    return false;
                }

                if (this.form.category === 'Android Motherboard') {
                    if (this.form.androidMotherboardSystemVersion === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardSystemVersion').css('border', '1px solid red');
                        $('#inputMotherBoardSystemVersion').css('border-radius', '5px');
                        $('#motherBoardSystemVersionError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardCpu === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardCpu').css('border', '1px solid red');
                        $('#inputMotherBoardCpu').css('border-radius', '5px');
                        $('#motherBoardCpuError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardGpu === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardGpu').css('border', '1px solid red');
                        $('#inputMotherBoardGpu').css('border-radius', '5px');
                        $('#motherBoardGpuError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardRam === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardRam').css('border', '1px solid red');
                        $('#inputMotherBoardRam').css('border-radius', '5px');
                        $('#motherBoardRamError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardStorage === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardStorage').css('border', '1px solid red');
                        $('#inputMotherBoardStorage').css('border-radius', '5px');
                        $('#motherBoardStorageError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardWifi === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardWifi').css('border', '1px solid red');
                        $('#inputMotherBoardWifi').css('border-radius', '5px');
                        $('#motherBoardWifiError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardHotspot === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardHotspot').css('border', '1px solid red');
                        $('#inputMotherBoardHotspot').css('border-radius', '5px');
                        $('#motherBoardHotspotError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardBluetooth === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardBluetooh').css('border', '1px solid red');
                        $('#inputMotherBoardBluetooh').css('border-radius', '5px');
                        $('#motherBoardBluetoothError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardWan === '') {
                        this.$refs.infoTab.click();
                        $('#inputMotherBoardWan').css('border', '1px solid red');
                        $('#inputMotherBoardWan').css('border-radius', '5px');
                        $('#motherBoardWanError').removeClass('hide');
                    }

                    if (this.form.androidMotherboardWifi === '' || this.form.androidMotherboardHotspot === '' || this.form.androidMotherboardBluetooth === '' || this.form.androidMotherboardWan === '' || this.form.androidMotherboardSystemVersion === '' || this.form.androidMotherboardCpu === '' || this.form.androidMotherboardGpu === '' || this.form.androidMotherboardRam === '' || this.form.androidMotherboardStorage === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'Front Board') {
                    if (this.form.preVersionUsb === '') {
                        this.$refs.infoTab.click();
                        $('#inputPreVersiondUsb').css('border', '1px solid red');
                        $('#inputPreVersiondUsb').css('border-radius', '5px');
                        $('#preVersionUsbError').removeClass('hide');
                    }

                    if (this.form.preVersionTypeC === '') {
                        this.$refs.infoTab.click();
                        $('#inputPreVersiondTypeC').css('border', '1px solid red');
                        $('#inputPreVersiondTypeC').css('border-radius', '5px');
                        $('#preVersionTypeCError').removeClass('hide');
                    }

                    if (this.form.preVersionHdmi === '') {
                        this.$refs.infoTab.click();
                        $('#inputPreVersiondHdmi').css('border', '1px solid red');
                        $('#inputPreVersiondHdmi').css('border-radius', '5px');
                        $('#preVersionHdmiError').removeClass('hide');
                    }

                    if (this.form.preVersionTouch === '') {
                        this.$refs.infoTab.click();
                        $('#inputPreVersiondTouch').css('border', '1px solid red');
                        $('#inputPreVersiondTouch').css('border-radius', '5px');
                        $('#preVersionTouchError').removeClass('hide');
                    }

                    if (this.form.preVersionLightSensitivity === '') {
                        this.$refs.infoTab.click();
                        $('#inputPreVersiondLightSensitivity').css('border', '1px solid red');
                        $('#inputPreVersiondLightSensitivity').css('border-radius', '5px');
                        $('#preVersionLightSensitivityError').removeClass('hide');
                    }

                    if (this.form.preVersionIr === '') {
                        this.$refs.infoTab.click();
                        $('#inputPreVersiondIr').css('border', '1px solid red');
                        $('#inputPreVersiondIr').css('border-radius', '5px');
                        $('#preVersionIrError').removeClass('hide');
                    }

                    if (this.form.preVersionLed === '') {
                        this.$refs.infoTab.click();
                        $('#inputPreVersiondLed').css('border', '1px solid red');
                        $('#inputPreVersiondLed').css('border-radius', '5px');
                        $('#preVersionLedError').removeClass('hide');
                    }

                    if (this.form.preVersionLed === '' || this.form.preVersionIr === '' || this.form.preVersionLightSensitivity === '' || this.form.preVersionTouch === '' || this.form.preVersionHdmi === '' || this.form.preVersionTypeC === '' || this.form.preVersionUsb === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'Tempered Glass') {
                    if (this.form.temperedGlassSize === '') {
                        this.$refs.infoTab.click();
                        $('#inputTemperedGlassSize').css('border', '1px solid red');
                        $('#inputTemperedGlassSize').css('border-radius', '5px');
                        $('#temperedGlassSizeError').removeClass('hide');
                    }

                    if (this.form.temperedGlassThickness === '') {
                        this.$refs.infoTab.click();
                        $('#inputTemperedGlassThickness').css('border', '1px solid red');
                        $('#inputTemperedGlassThickness').css('border-radius', '5px');
                        $('#temperedGlassThicknessError').removeClass('hide');
                    }

                    if (this.form.temperedGlassAg === '') {
                        this.$refs.infoTab.click();
                        $('#inputTemperedGlassAg').css('border', '1px solid red');
                        $('#inputTemperedGlassAg').css('border-radius', '5px');
                        $('#temperedGlassAgError').removeClass('hide');
                    }

                    if (this.form.temperedGlassSilkGreenColor === '') {
                        this.$refs.infoTab.click();
                        $('#inputTemperedGlassSilsScreenColor').css('border', '1px solid red');
                        $('#inputTemperedGlassSilsScreenColor').css('border-radius', '5px');
                        $('#temperedGlassSilkScreenColorError').removeClass('hide');
                    }

                    if (this.form.temperedGlassSilkGreenColor === '' || this.form.temperedGlassAg === '' || this.form.temperedGlassThickness === '' || this.form.temperedGlassSize === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'Touch') {
                    if (this.form.touchTouchMode === '') {
                        this.$refs.infoTab.click();
                        $('#inputTouchTouchMode').css('border', '1px solid red');
                        $('#inputTouchTouchMode').css('border-radius', '5px');
                        $('#touchTouchModeError').removeClass('hide');
                    }

                    if (this.form.touchTouchPoint === '') {
                        this.$refs.infoTab.click();
                        $('#inputTouchTouchPoint').css('border', '1px solid red');
                        $('#inputTouchTouchPoint').css('border-radius', '5px');
                        $('#touchTouchPointError').removeClass('hide');
                    }

                    if (this.form.touchSize === '') {
                        this.$refs.infoTab.click();
                        $('#inputTouchSize').css('border', '1px solid red');
                        $('#inputTouchSize').css('border-radius', '5px');
                        $('#touchSizeError').removeClass('hide');
                    }

                    if (this.form.touchTouchMode === '' || this.form.touchTouchPoint === '' || this.form.touchSize === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'Power Board') {
                    if (this.form.powerBoardSize === '') {
                        this.$refs.infoTab.click();
                        $('#inputPowerBoardSize').css('border', '1px solid red');
                        $('#inputPowerBoardSize').css('border-radius', '5px');
                        $('#powerBoardSizeError').removeClass('hide');
                    }

                    if (this.form.powerBoardTotalPower === '') {
                        this.$refs.infoTab.click();
                        $('#inputPowerBoardTotalPower').css('border', '1px solid red');
                        $('#inputPowerBoardTotalPower').css('border-radius', '5px');
                        $('#powerBoardTotalPowerError').removeClass('hide');
                    }

                    if (this.form.powerBoardLedPower === '') {
                        this.$refs.infoTab.click();
                        $('#inputPowerBoardLedPower').css('border', '1px solid red');
                        $('#inputPowerBoardLedPower').css('border-radius', '5px');
                        $('#powerBoardLedPowerError').removeClass('hide');
                    }

                    if (this.form.powerBoardLedPower === '' || this.form.powerBoardTotalPower === '' || this.form.powerBoardSize === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'OC') {
                    if (this.form.ocSize === '') {
                        this.$refs.infoTab.click();
                        $('#inputOcSize').css('border', '1px solid red');
                        $('#inputOcSize').css('border-radius', '5px');
                        $('#ocSizeError').removeClass('hide');
                    }

                    if (this.form.ocLevel === '') {
                        this.$refs.infoTab.click();
                        $('#inputOcLevel').css('border', '1px solid red');
                        $('#inputOcLevel').css('border-radius', '5px');
                        $('#ocLevelError').removeClass('hide');
                    }

                    if (this.form.ocResolution === '') {
                        this.$refs.infoTab.click();
                        $('#inputOcResolution').css('border', '1px solid red');
                        $('#inputOcResolution').css('border-radius', '5px');
                        $('#ocResolutionError').removeClass('hide');
                    }

                    if (this.form.ocContrast === '') {
                        this.$refs.infoTab.click();
                        $('#inputOcContrast').css('border', '1px solid red');
                        $('#inputOcContrast').css('border-radius', '5px');
                        $('#ocContrastError').removeClass('hide');
                    }

                    if (this.form.ocContrast === '' || this.form.ocResolution === '' || this.form.ocLevel === '' || this.form.ocSize === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'Materials') {
                    if (this.form.profileSize === '') {
                        this.$refs.infoTab.click();
                        $('#inputProfileSize').css('border', '1px solid red');
                        $('#inputProfileSize').css('border-radius', '5px');
                        $('#profiletSizeError').removeClass('hide');
                    }

                    if (this.form.profileFittingMethod === '') {
                        this.$refs.infoTab.click();
                        $('#inputProfileFittingMethod').css('border', '1px solid red');
                        $('#inputProfileFittingMethod').css('border-radius', '5px');
                        $('#profileFittingMethodError').removeClass('hide');
                    }

                    if (this.form.profileColor === '') {
                        this.$refs.infoTab.click();
                        $('#inputProfileCcolor').css('border', '1px solid red');
                        $('#inputProfileCcolor').css('border-radius', '5px');
                        $('#profileColorError').removeClass('hide');
                    }

                    if (this.form.profileColor === '' || this.form.profileFittingMethod === '' || this.form.profileSize === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'Logic Board') {
                    if (this.form.logicBoardResolution === '') {
                        this.$refs.infoTab.click();
                        $('#inputLogicBoardResolution').css('border', '1px solid red');
                        $('#inputLogicBoardResolution').css('border-radius', '5px');
                        $('#logicBoardResolutiontError').removeClass('hide');
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'OPS') {
                    if (this.form.opsCpu === '') {
                        this.$refs.infoTab.click();
                        $('#inputOpsCpu').css('border', '1px solid red');
                        $('#inputOpsCpu').css('border-radius', '5px');
                        $('#opsCpuError').removeClass('hide');
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }

                    if (this.form.opsRam === '') {
                        this.$refs.infoTab.click();
                        $('#inputOpsRam').css('border', '1px solid red');
                        $('#inputOpsRam').css('border-radius', '5px');
                        $('#opsRamError').removeClass('hide');
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }

                    if (this.form.opsHarddisk === '') {
                        this.$refs.infoTab.click();
                        $('#inputOpsHarddisk').css('border', '1px solid red');
                        $('#inputOpsHarddisk').css('border-radius', '5px');
                        $('#opsHarddiskError').removeClass('hide');
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                if (this.form.category === 'LED Light Strip') {
                    if (this.form.ledLightStripSize === '') {
                        this.$refs.infoTab.click();
                        $('#inputLedLightStriptSize').css('border', '1px solid red');
                        $('#inputLedLightStriptSize').css('border-radius', '5px');
                        $('#ledLightStripeSizeError').removeClass('hide');
                    }

                    if (this.form.ledLightStripLampPower === '') {
                        this.$refs.infoTab.click();
                        $('#inputLedLightStriptLampPower').css('border', '1px solid red');
                        $('#inputLedLightStriptLampPower').css('border-radius', '5px');
                        $('#ledLightStripeLampPowerError').removeClass('hide');
                    }

                    if (this.form.ledLightStripNumberOfLampBeads === '') {
                        this.$refs.infoTab.click();
                        $('#inputLedLightStriptNumberOfLampBeads').css('border', '1px solid red');
                        $('#inputLedLightStriptNumberOfLampBeads').css('border-radius', '5px');
                        $('#ledLightStripeNumberOfLampBeadsError').removeClass('hide');
                    }

                    if (this.form.ledLightStripNumberOfLightBars === '') {
                        this.$refs.infoTab.click();
                        $('#inputLedLightStriptNumberOfLightBars').css('border', '1px solid red');
                        $('#inputLedLightStriptNumberOfLightBars').css('border-radius', '5px');
                        $('#ledLightStripeNumberOfLightBarsError').removeClass('hide');
                    }

                    if (this.form.ledLightStripAdaptableBackplane === '') {
                        this.$refs.infoTab.click();
                        $('#inputLedLightStriptAdaptableBackplane').css('border', '1px solid red');
                        $('#inputLedLightStriptAdaptableBackplane').css('border-radius', '5px');
                        $('#ledLightStripeAdaptableBackplaneError').removeClass('hide');
                    }

                    if (this.form.ledLightStripSize === '' || this.form.ledLightStripLampPower === '' || this.form.ledLightStripNumberOfLampBeads === '' || this.form.ledLightStripNumberOfLightBars === ''|| this.form.ledLightStripAdaptableBackplane === '') {
                        this.loading = false;
                        this.disabled = false;
                        return false;
                    }
                }

                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                const formData = new FormData();

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
                formData.append('specification', this.form.specification);

                // If an image is selected, add it to the form data
                if (this.selectedFile) {
                    formData.append('product_image', this.form.product_image);
                    console.log(this.selectedFile);
                }

                // API post request
                this.form.post('component/add', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Important for file uploads
                    },
                })
                .then(response => {
                    if (response.data.statusCode === 200) {
                        // show success message
                        Toast.fire({
                            icon: 'success',
                            title: 'Component added successfully.'
                        });

                        this.$Progress.finish();
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
    .card-primary:not(.card-outline)>.card-header a.active {
        color: #1f2d3d;
    }
    .my-picker-class {
        border: 1px solid transparent;
        width: 100%;
        outline: none;
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

    .img-thumbnail {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
    }
</style>