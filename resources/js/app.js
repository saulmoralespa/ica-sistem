
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

Vue.component('datepicker', require('./components/datepicker'));

if(document.getElementById("app")){
    window.contractStudent = new Vue({
        el: '#app',
        data: {
            gradeBachelor: '',
            services: '',
            enrollmentCost: '',
            observations: '',
            annuity: '',
            year: '',
            yearChange: '',
            table: false,
            totalAnnuity: 0,
            fees: '',
            student_id: '',
            nameContract: '',
            idContract: '',
            date_created_at: '',
            username: '',
            years: '',
            isReadOnly: false,
            amount_deposit: '',
            date: '',
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
                this.nameContract = '';
            },
            contractForm: function(e){
                e.preventDefault();
                let nameContract = $("#gradeBachelor option:selected").text();
                $("#nameContract").val(nameContract);
                let student_id = $('#student_id').val();
                let year = $('#year').val();
                $.ajax({
                    url: createContract,
                    type: 'post',
                    dataType: 'json',
                    data: $('form#createContract').serialize(),
                    beforeSend: () => {
                        $('form#createContract').find('button').prop( "disabled", true );
                        $('body').css('cursor', 'wait');
                    }
                }).then(function(res){
                    $('body').css('cursor', 'default');
                    window.location.reload();
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
                    if (res.constructor !== Array){
                        this.student_id = student_id;
                        this.enrollmentCost = res.enrollment_cost;
                        this.services = res.services;
                        this.observations = res.observations;
                        this.fees = res.fees;
                        this.nameContract = res.name;
                        this.idContract = res.id;
                        this.date_created_at = res.date_created;
                        this.username = res.username;
                        this.years = res.years;
                    }else{
                        console.log('no hay contractos');
                    }
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
                        idContract: this.idContract,
                        idstudent: this.student_id,
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                }).then(function(res){
                    window.location.reload();
                }.bind(this));
            },
            changeSelectStudent: function(){
                console.log(this.$refs.formAddPay);
                let textStudent = this.$refs.nameStudent.text;
                this.$refs.nameStudent.textContent = `${textStudent} Name student`;
                const select = this.$refs.formAddPay[4];
                const nameStudent = select.options[select.selectedIndex].text;

                if (this.student_id)
                    this.loadContract(this.student_id);

            },
            statusSelectStudent: function(disable = true){
                if (disable){
                    $('.selectStudent').removeAttr('disabled');
                    $('.selectStudent').selectpicker('refresh');
                }else{
                    $('.selectStudent').attr('disabled',true);
                    $('.selectStudent').selectpicker('refresh');
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
                   },
                   beforeSend: () => {
                       $('body').css('cursor', 'wait');
                   }
               }).then(function(res){
                   this.services = res.services;
                   this.enrollmentCost = Number(res.enrollmentCost);
                   this.annuity = res.annuity;
                   this.year = res.year;
                   this.isReadOnly = res.annuity.discount_edit;
                   this.table = true;
                   $('body').css('cursor', 'default');
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
        },
        watch: {
            amount_deposit: function(val, oldVal) {
                if (val && this.date){
                    this.statusSelectStudent()
                }else{
                    this.statusSelectStudent(false)
                }

            },
            date: function(val, oldVal){
                if (val && this.amount_deposit){
                    this.statusSelectStudent()
                }else{
                    this.statusSelectStudent(false)
                }
            }
        }
    });
}