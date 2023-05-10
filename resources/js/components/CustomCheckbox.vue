<template>
    <div class="checkbox-wrapper">
        <input type="checkbox" v-model="checked" />
    </div>
</template>
<script>
    import EventBus from "./EventBus.js";

    export default {
        name: "CustomCheckbox",
        data() {
            return {
                checked: false,
            };
        },
        methods: {
            setInitialCheckboxValue() {
                if (this.data.selected !== this.checked) {
                    this.checked = this.data.selected;
                }
            },
        },
        watch: {
            checked() {
                EventBus.emit("setSelected", this.data.id, this.checked);
            },
            data: {
                immediate: true,
                handler: "setInitialCheckboxValue",
            },
        },
        props: {
            data: Object,
        },
    };
</script>
<style>
    .checkbox-wrapper {
        text-align: center;
    }
    .checkbox-wrapper input {
        display: inline;
    }
</style>
