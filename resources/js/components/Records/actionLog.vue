<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Records / </span><strong>Action log</strong>
                </div>
            </div>
            <div class="header">
                <h2>Action log</h2>

                <div class="card mt-3">
                    <div class="card-body row record-wrapper">

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
