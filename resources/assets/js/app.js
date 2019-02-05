
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue').default);
Vue.component('side-bar', require('./components/Sidebar.vue').default);
Vue.component('home', require('./components/Home.vue').default);
// Vue.component('post', require('./components/Post'));
const app = new Vue({
    el: '#app',

    data(){
        return {
            siteTitle: 'Aplikasi Sosial'
        }
    }
});
