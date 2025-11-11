<template>
    <div>
        <div class="action-btn-wrapper">
            <router-link style="text-decoration: none;" :to="`/asset/show/${this.data.id}`">{{ this.data.order_number }}</router-link>
        </div>
  </div>
</template>

<script>

    export default {
        name: 'EditAssetActionsBtn',
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
    };
</script>