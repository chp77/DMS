<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Advanced / </span><strong>Pop-ups blocker</strong>
                </div>
            </div>
            <div class="header">
                <h2>Pop-ups blocker</h2>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="card-body row">
                            <div class="col-md-10 tab-custom-content">
                                Blocked pop-ups for bound windows devices
                            </div>
                            <div class="col-md-2 card-tools">
                                <button type="button" class="btn btn-command fa-pull-right btn-disabled">Start blocking</button>
                            </div>

                            <div class="col-md-12 divider">
                                Windows only. Discover more pop-ups to block by client reporting
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body row">
                        <label>Instruction</label>
                        <img class="img-resize" :src="imgSrc" alt="pop-ups-blocker">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                imgSrc: require('./img/pop_ups_blocker.png')
            }
        }
    }
</script>

<style>
    .img-resize {
        object-fit: contain;
    }
</style>