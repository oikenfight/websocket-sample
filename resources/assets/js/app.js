
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('message-board', require('./components/MessageToBloadcastComponent.vue'));
// const message = new Vue({
//     el: '#message'
// });

Vue.component('message-to-user-board', require('./components/MessageToUserComponent.vue'));
// const message_to_limited_user = new Vue({
//     el: '#message-to-limited'
// });