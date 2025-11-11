<template>
    <div>
        <div class="action-btn-wrapper">
            <router-link :to="`/customer/show/${this.data.id}`"><i class="fas fa-edit click-able"></i></router-link>
            &nbsp;&nbsp;&nbsp;
            <a href="#" @click="deleteUser"><i class="fas fa-trash-alt text-blue"></i></a>
        </div>
  </div>
</template>

<script>

    export default {
        name: 'CustomerActionsBtn',
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
            deleteUser() {
                Swal.fire({
                    title: "Are you sure you want to delete ''" + this.data.email + "' ?",
                    text: "Click Cancel To Cancel Deletion",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete"
                }).then(result => {
                    if (result.value) {
                        this.form
                            .delete("customer/delete/" + this.data.id)
                            .then(() => {
                                Swal.fire(
                                    "Deleted",
                                    "Customer ''" + this.data.email + "' have been deleted!",
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