<template>
    <div class="container-full">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    
                </div>
            </div>
            
            <div class="header">
                <h2>Import CSV</h2>
            </div>

            <div class="card">
                <div class="card-body row">
                    <div class="col-md-12">
                        <h3>CSV file format requirements</h3>
                        <p>When you create the CSV file for importing assets, make sure that the file meets the following formatting requirements:</p>
                        <ul>
                            <li>The file included the column headings. The AMS server assumes that each line in the file starts at line 2 and represents an asset.</li>
                            <li>The file is in UTF-8 format and includes the byte-order mark (BOM).</li>
                            <li>Character encodings such as BIG-5 have been converted to UTF-8. You can do this by opening the file in a text editor and using the Save As command.</li>
                            <li>If a remark includes an @ character that represents anything other than a domain separator, you need to refer to the symbol using the hexadecimal format: \0x40</li>
                        </ul>
                        <p>For example, user@fremont@mycompany.com should be user\0x40fremont@mycompany.com</p>
                        <span>Download the CSV file template <a href="/ams_csv_template.csv" download="asset_csv_template.csv">here</a>. </span>
                            
                        <ul>
                            <li>
                                The CSV file consist of "<span style="color: red;">Order number</span>", "Customer order number", "<span style="color: orange;">Type</span>", "<span style="color: red;">Brand</span>", "<span style="color: red;">Model</span>", "<span style="color: red;">SKU code</span>", "<span style="color: orange;">Serial number</span>", "Mac address", "QA video link",
                                "<span style="color: red;">Manufacture date</span>", "<span style="color: red;">Warranty period</span>",	"<span style="color: red;">Warranty start date</span>",	"<span style="color: red;">Warranty expiry date</span>",	"Remarks",	"Components",	"Customer name", "Customer email",	
                                "Customer company name", "Customer address", "Customer contact number",	"Customer country",	and "Reseller name" columns.
                            </li>
                            <li>
                                Red font indicates these columns are required fields.
                            </li>
                            <li>
                                Orange fonts indicate that these columns are mandatory fields. If the "Type" is Panel, then "Serial Number" is a mandatory field. There are only two Type (Panel/Spare parts).
                            </li>
                            <li>
                                The date format should be like "2024-01-10".
                            </li>
                            <li>
                                For components column, it is optional and only accept the json arrays. EXP: [1,5,6]
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-body row">
                    <div class="col-md-12">
                        <button type="button" class="col-md-2 btn btn-block bg-gradient-success" @click="uploadCsv">Bulk import assets</button>
                    </div>
                </div>
            </div>

            <!-- Modal to upload CSV file-->
            <div class="modal fade" id="modal-upload-csv">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload CSV</h5>
                            <button type="button" @click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="handleFileUpload">
                                <div class="form-group">
                                    <label for="fileInput">Choose CSV file<span style="color: red;"> *</span></label>
                                    <input type="file" id="fileInput" class="form-control-file" @change="handleFileChange" accept=".csv" required/>
                                    <div v-if="error" class="text-danger">{{ error }}</div>
                                </div>
                                <button type="submit" class="btn btn-success bg-gradient-success fa-pull-right">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Modal error log-->
             <div class="modal fade" id="modal-error-csv">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">CSV Errors</h5>
                            <button type="button" @click="closeErrorModal" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group" v-if="Object.keys(ErrorMessage).length > 0">
                                <div v-for="(messages, key) in ErrorMessage" :key="key">
                                    <label>Row {{ key }}:</label>
                                    <p style="line-height: 10px;" class="text-danger col-md-12" v-for="(message, index) in messages" :key="index">{{ message }}</p>
                                </div>
                            </div>
                                <!-- <button type="submit" class="btn btn-success bg-gradient-success fa-pull-right">Upload</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import { Form } from 'vform';

    export default {
        props: {
            user: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                selectedFile: null,
                error: '',
                ErrorMessage: [],
            }
        },
        computed: {
           
        },
        mounted() {
            
        },
        methods: {
            closeErrorModal() {
                $("#modal-error-csv").modal("hide");
            },
            closeModal() {
                $("#modal-upload-csv").modal("hide");
            },
            uploadCsv() {
                this.statusModal = false;
                // this.form.reset();
                $("#modal-upload-csv").modal("show");
            },
            async handleFileUpload() {
                this.closeModal();
                $('.screen').css('display', 'flex');
                this.$Progress.start();

                if (this.selectedFile) {
                    const formData = new FormData();
                    formData.append('file', this.selectedFile);

                    try {
                        const response = await axios.post('/asset/bulk-upload', formData, {
                            headers: {
                            'Content-Type': 'multipart/form-data',
                            },
                        });

                        if (response.data.statusCode === 200) {
                            // show success message
                            Toast.fire({
                                icon: 'success',
                                title: 'Bulk import successfully.'
                            });

                            this.$Progress.finish();
                        } else {
                            // Handle server errors
                            $("#modal-error-csv").modal("show");
                            const errorObject = response.data.error;
                            
                            this.ErrorMessage = Object(errorObject);
                            Toast.fire({
                                icon: 'error',
                                title: 'Some data is invalid!'
                            });

                            this.$Progress.fail();
                        }
                        this.resetForm();
                    } catch (error) {
                        // Handle network errors
                        this.error = 'Error uploading file.';
                        Swal.fire(
                            "500",
                            error.response.data.message,
                            "warning"
                        );
                        this.resetForm();
                        this.$Progress.fail();
                        console.error(error);
                    }
                } else {
                    this.error = 'Please select a CSV file to upload.';
                }

                $('.screen').css('display', 'none');
            },
            handleFileChange() {
                const file = event.target.files[0];
                if (file && file.type === 'text/csv') {
                    this.selectedFile = file;
                    this.error = '';
                } else {
                    this.selectedFile = null;
                    this.error = 'Please select a valid CSV file.';
                }
            },
            resetForm() {
                this.selectedFile = null;
                this.error = '';
                document.getElementById('fileInput').value = '';
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

    .bg-gradient-success {
        background: #28a745 linear-gradient(180deg,#48b461,#28a745) repeat-x !important;
        color: #fff;
    }
</style>