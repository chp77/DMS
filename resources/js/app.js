require('./bootstrap');

window.Vue = require('vue').default;

// https://github.com/uwla/vue-data-table
import DataTable from '@andresouzaabreu/vue-data-table';
import '@andresouzaabreu/vue-data-table/dist/DataTable.css';
Vue.config.productionTip = false;
Vue.component("data-table", DataTable);

import Form from 'vform';
import HasError from 'vform';
import AlertError from 'vform';
window.Form  = Form;
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
    // Dashboard
    { path: '/dashboard', component:require('./components/Dashboard/dashboard.vue').default },

    // Manage
    { path: '/devices', component:require('./components/Manage/devices.vue').default },
    { path: '/groups', component:require('./components/Manage/groups.vue').default },

    // Advanced
    { path: '/profile', component:require('./components/Advanced/profile.vue').default },
    { path: '/apps', component:require('./components/Advanced/apps.vue').default },
    { path: '/input-switch', component:require('./components/Advanced/inputSwitch.vue').default },
    { path: '/firmware-update', component:require('./components/Advanced/firmwareUpdate.vue').default },
    { path: '/software-update', component:require('./components/Advanced/softwareUpdate.vue').default },
    { path: '/pop-ups-blocker', component:require('./components/Advanced/popUpsBlocker.vue').default },

    // Records
    { path: '/history', component:require('./components/Records/history.vue').default },
    { path: '/in-schedule', component:require('./components/Records/inSchedule.vue').default },
    { path: '/action-log', component:require('./components/Records/actionLog.vue').default },

    // Resources
    { path: '/resources', component:require('./components/Resources/resources.vue').default },

    // System
    { path: '/user-management', component:require('./components/System/users.vue').default },
    { path: '/organization', component:require('./components/System/organization.vue').default },
    { path: '/password', component:require('./components/System/password.vue').default },
    { path: '/settings', component:require('./components/System/settings.vue').default },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router
});
