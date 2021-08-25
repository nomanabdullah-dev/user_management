
require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all');
window.Vue = require('vue').default;



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('users-management-dashboard', require('./components/users/UsersManagementDashboard.vue').default);
Vue.component('user-account-settings', require('./components/accounts/UserAccountSettings.vue').default);



const app = new Vue({
    el: '#app',
});
