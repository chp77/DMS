<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="header">
                <h2>Dashboard</h2>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="col-md-12">
                            <span style="font-weight: 600;">School 263364</span>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Organization code</label>
                                <p>21232</p>
                            </div>
                            <div class="col-md-2">
                                <label>Admin account</label>
                                <p>xxx@xxx.compp</p>
                            </div>
                            <div class="col-md-4">
                                <label>Credits</label>
                                <p>34</p>
                            </div>
                            <div class="col-md-2">
                                <span class="fa-pull-right">
                                    <label>Enrolled devices</label>
                                    <p style="margin-left: 55px;">1</p>
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="fa-pull-right">
                                    <label>Online devices</label>
                                <p style="margin-left: 45px;">0</p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <label>Online trend</label>

                    </div>
                </div>

                <div class="flex">
                    <div class="card col-md-8">
                        <div class="card-body">
                            <label>Offline devices</label>
                        </div>
                    </div>
                    <div class="card" style="margin-left: 20px; width: 90%;">
                        <div class="card-body">
                            <label>Today's command</label>
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
