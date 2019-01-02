import Vue from 'vue';
import Cars from './components/Cars.vue';

const cars = new Vue({
    el: '#carsList',
    components: { Cars }
});