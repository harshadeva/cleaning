require('./bootstrap');
import Vue from 'vue'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import StarRating from 'vue-star-rating'

Vue.component('report-form',require('./components/ReportForm.vue').default);
Vue.component('report-form-edit',require('./components/ReportFormEdit.vue').default);
Vue.component('report-view',require('./components/ReportView.vue').default);
Vue.component("v-select", vSelect);
Vue.component('star-rating', StarRating)

const app = new Vue({
    el:'#app',
});
