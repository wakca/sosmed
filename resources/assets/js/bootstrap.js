
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

// window.$ = window.jQuery = require('jquery');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    window.moment = require('moment');
    require('bootstrap');
} catch (e) {}
// require('bootstrap-sass');
require('bootstrap');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');


moment.locale('id');

Vue.prototype.moment = moment;


var KLIPAA = {};
var $window = $(window),
    $document = $(document),
    $body = $('body'),
    $sidebar = $('.fixed-sidebar'),
    $preloader = $('#hellopreloader');

KLIPAA.preloader = function () {
    // $window.scrollTop(0);
    setTimeout(function () {
        $preloader.fadeOut(800);
    }, 500);
    return false;
};

//Scroll to top.
jQuery('.back-to-top').on('click', function () {
    $('html,body').animate({
        scrollTop: 0
    }, 1200);
    return false;
});


$(document).ready(function() {
    // KLIPAA.preloader();
    var sideslider = $('[data-toggle=collapse-side]');
    var sel = sideslider.attr('data-target');
    var sel2 = sideslider.attr('data-target-2');
    sideslider.click(function(event){
        $(sel).toggleClass('in');
        $(sel2).toggleClass('out');
    });


});



/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.baseURL = 'http://sosmed.test/api';

if (token) {

    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
