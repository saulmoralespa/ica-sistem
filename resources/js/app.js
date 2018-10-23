
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

if(document.getElementById("app")){
    const app = new Vue({
        el: '#app',
        data: {
            gradeBachelor: '',
            services: '',
            enrollmentCost: '',
            annuity: '',
            table: false
        },
        methods: {
            onChange:function(){
                if (this.gradeBachelor){
                    this.getData;
                }else{
                    this.table = false;
                }
            }
        },
        computed: {
           getData: async function() {
               await jQuery.ajax({
                   url: dataCreateContract,
                   type: 'post',
                   dataType: 'json',
                   data: {
                       '_token': $('meta[name=csrf-token]').attr('content'),
                       'id': this.gradeBachelor
                   }
               }).then(function(res){
                   this.services = res.services;
                   this.enrollmentCost = res.enrollmentCost;
                   this.annuity = res.annuity;
                   this.table = true;
                   }.bind(this));
           },
            subtotal: function() {
                return _.reduce(this.services, function(memo, service) {
                    return memo + Number(service.cost);
                }, 0)
            }
        },
        filters:{
            price: function(value){
                return value.toFixed(2);
            }
        }
    });
}
