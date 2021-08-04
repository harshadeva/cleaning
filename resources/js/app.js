require('./bootstrap');
import Vue from 'vue'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import StarRating from 'vue-star-rating'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'


Vue.component('report-form',require('./components/ReportForm.vue').default);
Vue.component('report-form-edit',require('./components/ReportFormEdit.vue').default);
Vue.component('report-view',require('./components/ReportView.vue').default);
Vue.component("v-select", vSelect);
Vue.component('star-rating', StarRating)
Vue.component('vue-dropzone', vue2Dropzone)

Vue.use(CoolLightBox);

const app = new Vue({
    el:'#app',
});
