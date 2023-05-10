<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">System / </span><strong>User manage</strong>
                </div>
            </div>
            <div class="header">
                <h2>User Manage {{ appName }} </h2>

                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-10">
                            Supports adding new user with different roles and group rights to manage this organization.
                            <br>
                            * Limit 20 users in this organization
                        </div>
                        <div class="col-md-2 card-tools">
                            <button type="button" class="btn btn-primary fa-pull-right" @click="addUser">Add user</button>
                        </div>
                    </div>
                </div>

                <!-- <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Username</th>
                                        <th>Account</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr v-for="user in users" :key="user.id">
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.role }}</td>
                                        <td>
                                            <a href="#" @click="editUser(user)"><i class="fas fa-edit blue"></i></a> | <a href="#" @click="deleteUser(user.id)"><i class="fas fa-trash-alt red"></i></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="card mt-4">
                    <div class="card-body row">
                    <data-table v-bind="tableProps" @actionTriggered="handleAction"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal add user-->
        <!-- <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddUser1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserLabel" v-show="!statusModal">Add user</h5>
                        <h5 class="modal-title" id="addUserLabel" v-show="statusModal">Update user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="statusModal ? updateData() : storeData()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" v-model="form.name" class="form-control" placeholder="userName" :class="{ 'is-invalid' : form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="email" v-model="form.email" class="form-control" placeholder="Email" :class="{ 'is-invalid' : form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <select v-model="form.role" class="form-control select2" :class="{ 'is-invalid' : form.errors.has('role') }">
                                    <option disabled>Select role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Agent">Agent</option>
                                </select>
                                <has-error :form="form" field="role"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" :disabled="disabled" v-show="!statusModal">
                                <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                                Create
                            </button>
                            <button type="submit" class="btn btn-success" :disabled="disabled" v-show="statusModal">
                                <i v-show="loading" class="fa fa-spinner fa-spin"></i>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
    import CustomCheckbox from "../CustomCheckbox.vue";
    import Spinner from "../Spinner.vue";

    export default {
        computed: {
            appName() {
                return window.config.appName;
            }
        },
        data() {
            return{
                loading: false,
                disabled: false,
                statusModal: false,
                users :{},
                form: new Form({
                    id: "",
                    name: "",
                    role: "",
                    email: ""
                }),
                tableProps: {
                    data: [], // Initialize the data array as empty
                    columns: [
                        { key: "id", title: "", sortable: false, component: CustomCheckbox },
                        { key: "name", title: "Username" },
                        { key: "email", title: "Account" },
                        { key: "role", title: "Role" },
                        { key: "updated_at", title: "Latest operation" },
                        { key: "device_number", title: "Device No." },
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
            }, 1000);
        },
        methods: {
            handleAction(action, payload) {
                console.log(action, payload)
                window.alert("check out the console to see the data logged");
            },
            addUser() {
                this.statusModal = false;

                // clear the form
                this.form.reset();

                // hide the add user modal
                $("#modalAddUser").modal("show");
            },
            editUser(user) {
                this.statusModal = true;

                // clear the form
                this.form.reset();

                // hide the add user modal
                $("#modalAddUser").modal("show");

                // fill the form
                this.form.fill(user);
            },
            deleteUser(id) {
                Swal.fire({
                    title: "Are you sure you want to delete this user?",
                    text: "Click Cancel To Cancel Deletion",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete"
                }).then(result => {
                    if (result.value) {
                        this.form
                            .delete("api/user/" + id)
                            .then(() => {
                                Swal.fire(
                                    "Deleted",
                                    "User have been deleted!",
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
            loadData() {
                this.$Progress.start();
                this.tableProps.isLoading = true;

                axios.get('api/users/listing')
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

                this.$Progress.finish();
                this.tableProps.isLoading = false;
            },
            storeData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                // API post request
                this.form.post('api/user').then(() => {
                    // reload the users data
                    Fire.$emit("refreshData");

                    $("#modalAddUser").modal("hide");

                    // show success message
                    Toast.fire({
                        icon: 'success',
                        title: 'User added successfully.'
                    });

                    this.$Progress.finish();
                    this.loading = false;
                    this.disabled = false;
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.loading = false;
                    this.disabled = false;
                });
            },
            updateData() {
                this.$Progress.start();
                this.loading = true;
                this.disabled = true;

                // API post request
                this.form.put('api/user/' + this.form.id).then(() => {
                    // reload the users data
                    Fire.$emit("refreshData");

                    $("#modalAddUser").modal("hide");

                    // show success message
                    Toast.fire({
                        icon: 'success',
                        title: 'User updated successfully.'
                    });

                    this.$Progress.finish();
                    this.loading = false;
                    this.disabled = false;
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.loading = false;
                    this.disabled = false;
                });
            }
        },
        created() {
            this.loadData();
            Fire.$on("refreshData", () => {
                this.loadData();
            });
        }
    }
</script>
