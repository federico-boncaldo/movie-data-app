require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('movie-list', require('./components/MovieList.vue').default);


const app = new Vue({
    el: '#app',
});
