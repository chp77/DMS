<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">System / </span><strong>Password</strong>
                </div>
            </div>
            <div class="header">
                <h2>Password</h2>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <label class="pass-title">Administrator password</label>
                            <p class="text-faded">
                                Enter the password to unenroll the device.
                            </p>
                        </div>
                        <div class="row">
                            <p class="text-faded">
                                Password
                                <input class="pass-field" type="password" disabled/>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <label class="pass-title">Unlock password</label>
                            <p class="text-faded">
                                Used to unlock device operations, including Screen lock, Settings lock and Factory menu lock
                            </p>
                        </div>
                        <div class="row">
                            <p class="text-faded">
                                Password
                                <input class="pass-field" type="password" disabled/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    .pass-title {
        font-size: 20px;
        margin-bottom: -10px;
    }

    .pass-field {
        box-sizing: border-box;
        margin: 0;
        font-variant: tabular-nums;
        list-style: none;
        font-feature-settings: "tnum";
        position: relative;
        display: inline-block;
        margin: 0 10px;
        padding: 4px 11px;
        color: #545559;
        font-size: 14px;
        line-height: 1.5715;
        background-color: #fff;
        background-image: none;
        border: 1px solid #bfc2c7;
        border-radius: 4px;
        transition: all .3s;
    }
</style>