// import './plugins/daterangepicker.js';
require('./bootstrap');

window.Vue = require('vue').default;

// https://github.com/uwla/vue-data-table
import DataTable from '@andresouzaabreu/vue-data-table';
import '@andresouzaabreu/vue-data-table/dist/DataTable.css';
Vue.config.productionTip = false;
Vue.component("data-table", DataTable);

import VueQRCodeComponent from 'vue-qrcode-component';
Vue.component('qr-code', VueQRCodeComponent);

import $ from 'jquery';
window.$ = window.jQuery = $;
import Form from 'vform';
import HasError from 'vform';
import AlertError from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

let Fire =new Vue();
window.Fire = Fire;
//Import Alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

// Progress Bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '20px'
});

import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter);

let routes =[
    // tracking page
    { path: '/check-device', component:require('./components/Public/check.vue').default },

    // Asset Listing
    { path: '/assets', component:require('./components/Assets/assets.vue').default },
    { path: '/asset-add', component:require('./components/Assets/addAsset.vue').default },
    { path: '/asset/show/:id', component:require('./components/Assets/editAsset.vue').default },

    // Component Listing
    { path: '/components', component:require('./components/Components/components.vue').default },
    { path: '/component-add', component:require('./components/Components/addComponent.vue').default },
    { path: '/component/show/:id', component:require('./components/Components/editComponent.vue').default },

    // Brands
    { path: '/brands', component:require('./components/Brands/brands.vue').default },
    { path: '/brand-add', component:require('./components/Brands/addBrand.vue').default },
    { path: '/brand/show/:id', component:require('./components/Brands/editBrand.vue').default },

    // Models
    { path: '/models', component:require('./components/Models/models.vue').default },
    { path: '/model-add', component:require('./components/Models/addModel.vue').default },
    { path: '/model/show/:id', component:require('./components/Models/editModel.vue').default },

    // Sku
    { path: '/skus', component:require('./components/Skus/skus.vue').default },
    { path: '/sku-add', component:require('./components/Skus/addSku.vue').default },
    { path: '/sku/show/:id', component:require('./components/Skus/EditSku.vue').default },

    // Import CSV
    { path: '/import-csv', component:require('./components/Csv/csv.vue').default },

    // Users
    { path: '/users', component:require('./components/System/users.vue').default },
    { path: '/user-add', component:require('./components/System/addUser.vue').default },
    { path: '/user/show/:id', component:require('./components/System/editUser.vue').default },

    // Customers
    { path: '/customers', component:require('./components/Customer/customers.vue').default },
    { path: '/customer-add', component:require('./components/Customer/addCustomer.vue').default },
    { path: '/customer/show/:id', component:require('./components/Customer/editCustomer.vue').default },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router
});
