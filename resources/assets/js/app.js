
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

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});


window.Pusher = require('pusher-js');

import Echo from "laravel-echo"



window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '0ae9aa0311b9c4a9c3df',
    cluster: 'ap1',
    encrypted: true
});

 Echo.private('App.User.1')
      .notification((notification) => {
          console.log(notification.type);
      });


});
