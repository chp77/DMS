<template>
    <div class="checkbox-wrapper">
        <input type="checkbox" v-model="checked" />
    </div>
</template>
<script>
    import CheckboxEvent from "./CheckboxEvent.js";

    export default {
        name: "AssetCheckbox",
        props: {
            data: Object,
        },
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
                CheckboxEvent.emit("setSelected", this.data.id, this.checked);
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
