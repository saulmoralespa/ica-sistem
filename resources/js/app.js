
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.PerfectScrollbar = require('perfect-scrollbar').default;
window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
import ClickConfirm from 'click-confirm'
Vue.component('clickConfirm', ClickConfirm);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

if(document.getElementById("app")){
    window.contractStudent = new Vue({
        el: '#app',
        data: {
            gradeBachelor: '',
            services: '',
            enrollmentCost: '',
            annuity: '',
            year: '',
            yearChange: '',
            table: false,
            totalAnnuity: 0,
            fees: '',
            nameContract: '',
            idContract: '',
            date_created_at: '',
            username: '',
            years: '',
            isReadOnly: false
        },
        methods: {
            onChange:function(){
                if (this.gradeBachelor){
                    this.getData;
                }else{
                    this.table = false;
                }
            },
            cancel: function () {
                this.table = false;
                this.gradeBachelor = '';
            },
            contractForm: function(e){
                e.preventDefault();
                let nameContract = $("#gradeBachelor option:selected").text();
                $("#nameContract").val(nameContract);
                let student_id = $(view).find('#student_id').val();
                let year = $(view).find('#year').val();
                $.ajax({
                    url: createContract,
                    type: 'post',
                    dataType: 'json',
                    data: $('form#createContract').serialize(),
                    beforeSend: () => {
                        $(this).find('button').prop( "disabled", true );
                        $(view).css('cursor', 'wait');
                    }
                }).then(function(res){
                    $(view).css('cursor', 'default');
                    $("#newContract").hide();
                    $('#contracts').show();
                    dt.ajax.reload();
                    this.loadContract(student_id, year);
                }.bind(this));

            },
            loadContract: async function(student_id, year = ''){
               await $.ajax({
                    url: showContract,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id:  student_id,
                        year: year,
                        _token: $('meta[name=csrf-token]').attr('content')
                    },
                }).then(function(res){
                   this.student_id = student_id;
                   this.enrollmentCost = res.enrollment_cost;
                   this.services = res.services;
                   this.fees = res.fees;
                   this.nameContract = res.name;
                   this.idContract = res.id;
                   this.date_created_at = res.date_created;
                   this.username = res.username;
                   this.years = res.years;
                }.bind(this));
            },
            onChangeYear: function () {
                if (this.yearChange)
                this.loadContract(this.student_id,this.yearChange);
            },
            changeFees: function () {
                $.ajax({
                    url: updateFee,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: this.idContract,
                        fees: JSON.stringify(this.fees),
                        _token: $('meta[name=csrf-token]').attr('content')
                    },
                });
            },
            cancelContract: function(){
                $.ajax({
                    url: deleteContract,
                    type: 'post',
                    data: {
                        id: this.idContract,
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                }).then(function(res){
                    this.nameContract = '';
                    $(view).modal('hide');
                }.bind(this));
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
                   this.enrollmentCost = Number(res.enrollmentCost);
                   this.annuity = res.annuity;
                   this.year = res.year;
                   this.isReadOnly = res.annuity.discount_edit;
                   this.table = true;
                   }.bind(this));
           },
            subtotal: function() {
                return _.reduce(this.services, function(memo, service) {
                    return memo + Number(service.cost);
                }, 0)
            },
            totalfees: function() {
                return _.reduce(this.fees, function(memo, fee) {
                    return memo + Number(fee.price);
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