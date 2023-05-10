<template>
    <div class="container-full">
        <div class="row justify-content-center mt-4">
            <div class="breadcrumb row">
                <div class="breadcrumb-item">
                    <span style="color: grey;">Advanced / </span><strong>Profile</strong>
                </div>
            </div>
            <div class="header">
                <h2>
                    Profile <i class="fa fa-refresh"></i>
                </h2>

                <div class="card mt-3">
                    <div class="card-body row record-wrapper">
                        <div class="col-md-10 col-sm-12">
                            A policy is a set of configurations and restrictions designed to manage and secure devices enrolled in Bytello DMS.
                            <br>
                            After setting a profile as a default, when a device enrolled to your organization, it will automatically receive and execute the default profile.
                        </div>
                        <div class="col-md-2 card-tools">
                            <li class="nav-item dropdown btn btn-primary btn-create fa-pull-right">
                                <a class="nav-link text-white" data-toggle="dropdown" href="#">
                                    Create new <i class="fa fa-chevron-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right create-new-menu">
                                    <a href="#" class="dropdown-item">
                                        Android
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Window
                                    </a>
                                </div>
                            </li>
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
    .fa-refresh {
        font-size: 18px;
    }

    .fa-chevron-down {
        font-size: 9px;
        margin-left: 5px;
    }

    .btn-create {
        min-width: 121px;
        background-color: #4965d6;
        border-color: #4965d6;
    }

    .create-new-menu{
        top: 7px !important;
        left: 13px !important;
        min-width: 127px;
    }
</style>
