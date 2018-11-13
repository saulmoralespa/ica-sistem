
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

Vue.component('datepicker', require('./components/datepicker'));
Vue.component('main-contract-student', require('./components/mainContractStudent'));
Vue.component('select-student', require('./components/selectStudent'));

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
            assign_deposit: '',
            date: '',
            students: '',
            elSelectStudent: '',
            buttonSavePayment: false,
            previousElementStudent: '',
            mainContractStudentkey: 0,
            operation_number: ''
        },
        methods: {
            onChange:function(){
                if (this.gradeBachelor){
                    this.getData();
                }else{
                    this.table = false;
                }
            },
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
            cancel: function () {
                this.table = false;
                this.gradeBachelor = '';
                this.nameContract = '';
            },
            contractForm: function(e){
                e.preventDefault();
                let form = $("form#createContract");
                let nameContract = $("#gradeBachelor option:selected").text();
                form.find("#nameContract").val(nameContract);
                let year = $('#year').val();
                $.ajax({
                    url: createContract,
                    type: 'post',
                    dataType: 'json',
                    data: $(form).serialize(),
                    beforeSend: () => {
                        $(form).find('button').prop( "disabled", true );
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
                    async: true,
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
                    }
                }.bind(this));
            },
            loadContractPay: async function(){
                const student_id = this.student_id;
                await $.ajax({
                    url: showContract,
                    type: 'post',
                    dataType: 'json',
                    async: true,
                    data: {
                        id:  student_id,
                        _token: $('meta[name=csrf-token]').attr('content')
                    },
                    beforeSend: function(){
                        $('body').css('cursor', 'wait');
                    }
                }).then(function(res){
                    console.log(res);
                    const select = this.elSelectStudent;
                    const divStudent = $(select).parents('div.mainStudent');

                    if (res.constructor !== Array){
                        const table = divStudent.find('table');
                        const services = res.services;
                        const fees = res.fees;
                        const enrollment = `<tr>
                        <td>${textEnrollment}</td>    
                        <td>
                                            ${res.enrollment_cost}
                                        </td>
                                        <td class="enrollmentCostPay">
                                        <input type="text" name="enrollmentCost" value="${  assignValueEnrollment(res.enrollment_cost) }" ${!isSuperAdmin ? 'readonly' : '' }  >
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>`;
                        let obligatoryServices = '';
                        services.forEach(function(service){
                            obligatoryServices += `<tr>
                                            <td>
                                                ${service.name}
                                            </td>
                                            <td>
                                                ${service.cost}
                                            </td>
                                            <td class="servicePay">
                                            <input type="text"  name="serviceObligatoryCost[]" value="${ assignValueService(service.cost) }" ${!isSuperAdmin ? 'readonly' : '' }>
                                            </td>
                                            </tr>`;
                        });
                        table.find('tbody').append(enrollment);
                        table.find('tbody').append(obligatoryServices);
                        //surcharges
                        //fees expired
                        //services
                        if (this.services){
                            let serviceHTML = '';
                            for (let service of this.services){
                                serviceHTML += `<tr>
                                <td>${service.dataset.name}</td>
                                <td>${service.dataset.price}</td>
                                <td><input type="text" data-id="${service.id}" name="serviceCost" value="${ assignValueService(service.dataset.price) }"></td>
                                </tr>`
                            }
                            table.find('tbody').append(serviceHTML);
                        }
                        //fees without caducity
                        table.find('tbody').append(`<tr class="contract">
                                        <td>${res.name}</td>
                                        <td>
                                        ${ totalAnnuity(res.fees) }
                                        </td>
                                        <td>
                                        <input type="text" name="annuityCost" value="${ this.totalAnnuity = assignValueAnnuity(totalAnnuity(res.fees)) }" ${!isSuperAdmin ? 'readonly' : '' }>
                                        </td>
                                        </tr>`);
                        let feesHTML = '';
                        let  totalAnnuityInt = Number(this.totalAnnuity);

                        for(let fee of fees){
                            if (totalAnnuityInt > 0 && totalAnnuityInt >= fee.price){
                                totalAnnuityInt -= fee.price;
                                feesHTML += ` <td>
                                <input type="text" name="fees[]" value="${fee.price}" readonly>
                                </td>`;
                                continue;
                            }
                            if(totalAnnuityInt > 0 && totalAnnuityInt < fee.price){
                                feesHTML += ` <td>
                                <input type="text" name="fees[]" value="${totalAnnuityInt.toFixed(2)}" readonly>
                                </td>`;
                                totalAnnuityInt = 0;
                                continue;
                            }

                            if (totalAnnuityInt === 0){
                                feesHTML += ` <td>
                                <input type="text" name="fees[]" value="0.00" readonly>
                                </td>`;
                            }
                        }


                        table.find('.contract').append(feesHTML);

                        divStudent.find('.tableDebt').show();
                    }else{
                        divStudent.find('.tableDebt').hide();
                    }
                    const elementStudentId = $('input[name="student_id"]');
                    if (elementStudentId.length){
                        divStudent.find(elementStudentId).val(student_id);
                    }else{
                        //not contracts
                        divStudent.append(`<input type="hidden" name="student_id" value="${student_id}">`);
                    }
                    divStudent.find('.studentDetail').show();
                    const nameStudent = select.options[select.selectedIndex].text;
                    $(divStudent).find('p').text(`${textStudent} ${nameStudent}`);
                    $('body').css('cursor', 'default');
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
            changeSelectStudent: function(e){
                let select = e.target;
                this.elSelectStudent = select;
                this.showSaveButtonpayment(true);
                if (select.value){
                    const date = new Date();
                    this.mainContractStudentkey = date.getTime();
                    if (this.previousElementStudent)
                        this.getCostsReassingAmount();
                    this.student_id = select.options[select.selectedIndex].value;
                    this.loadContractPay();
                }else{
                    const divStudent = $(select).parents('div.mainStudent');
                    divStudent.find('.studentDetail').hide();
                    divStudent.find('.tableDebt').hide();
                    if (this.previousElementStudent)
                        this.getCostsReassingAmount(true)
                }

            },
            focusSelectStudent: function(e){
                let select = e.target;
                const divStudent = $(select).parents('div.mainStudent');
                if (select.value){
                    this.previousElementStudent = divStudent
                }
            },
            showSaveButtonpayment: function(amounts){
                if (amounts && this.checkisFirstSelect()){
                    this.buttonSavePayment = true;
                }else{
                    this.buttonSavePayment = false;
                }
            },
            checkisFirstSelect: function(){
                let  val = $('select.selectStudent').map(function(idx, elem) {
                    return $(elem).val();
                }).get();

                if(val[0].length > 0){
                    return true;
                }else{
                    return false;
                }
            },
            statusSelectStudent: function(disable = true){
                if (disable){
                    $('.selectStudent').removeAttr('disabled');
                    $('.selectStudent').selectpicker('refresh');
                }else{
                    $('.selectStudent').attr('disabled',true);
                    $('.selectStudent').selectpicker('refresh');
                }
            },
            getCostsReassingAmount: function(reset = false){
                const elStudent = this.previousElementStudent;
                const elEnrollmentCost = $(`input[name=enrollmentCost]`);

                //when student have a contract create or assign costs  servicios, etc

                if (elEnrollmentCost.length){
                    const enrollmentCost = $(elStudent).find(elEnrollmentCost).val();
                    let servicesCostObligatory = 0;
                    $(`input[name^=serviceObligatoryCost]`).map(function(){
                        servicesCostObligatory += Number($(this).val());
                    });

                    let services = 0;
                    if (this.services){
                       services = _.reduce(this.services, function(memo, service) {
                            return memo + Number(service.dataset.price);
                        }, 0);
                        this.services = '';
                    }

                    const annuityCost = $(elStudent).find(`input[name=annuityCost]`).val();

                    const total = Number(enrollmentCost) + servicesCostObligatory + services + Number(annuityCost);

                    const leftover = Number(this.assign_deposit);
                    const valueReAssign = Number(leftover) + total;
                    this.assign_deposit = valueReAssign.toFixed(2);
                    if (reset)
                        this.previousElementStudent = ''
                }

            },
            addPayment: function(e){
                //submit form add pay
                let form = $(e.originalTarget);
                console.log($(form).serialize());
            }
        },
        computed: {
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
                    this.statusSelectStudent();
                    this.showSaveButtonpayment(true)
                }else{
                    this.statusSelectStudent(false);
                    this.showSaveButtonpayment(false)
                }
                this.assign_deposit = this.amount_deposit;

            },
            date: function(val, oldVal){
                if (val && this.date){
                    this.statusSelectStudent();
                    this.showSaveButtonpayment(true)
                }else{
                    this.statusSelectStudent(false);
                    this.showSaveButtonpayment(false)
                }
                this.assign_deposit = this.amount_deposit;
            },
            operation_number: function(val, oldval) {
                if (val && this.date){
                    this.statusSelectStudent();
                    this.showSaveButtonpayment(true)
                }else{
                    this.statusSelectStudent(false);
                    this.showSaveButtonpayment(false)
                }
                this.assign_deposit = this.amount_deposit;
            }
        }
    });
}