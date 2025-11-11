<template>
    <div>
        <div class="action-btn-wrapper">
            <router-link style="text-decoration: none;" :to="`/component/show/${this.data.id}`">{{ this.data.item_name }}</router-link>
        </div>
  </div>
</template>

<script>

    export default {
        name: 'ComponentLabel',
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