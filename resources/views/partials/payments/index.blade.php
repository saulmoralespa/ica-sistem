@extends('partials.template')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
@endpush
@section('bodycontent')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form @submit.prevent="addPayment"  id="addPayment">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p class="h5">{{ __("Agregar pago") }}</p>
                        </div>
                        <div class="col-sm-6">
                            <div v-show="buttonSavePayment" class="float-right">
                                <button type="submit" class="btn btn-primary"><li class="fas fa-save"></li> {{ __("Guardar") }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>{{ __("Fecha de depósito") }}</label>
                            <datepicker v-model="date"></datepicker>
                        </div>
                        <div class="col-sm-6">
                            <label>{{ __("Monto a depositar") }}</label>
                            <input type="text" name="amount_deposit" :disabled="disabled == 1 ? true : false" id="amount_deposit" v-model.number="amount_deposit" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>{{ __("N° de operación") }}</label>
                            <input type="number" id="operation_number" v-model.number="operation_number" class="form-control" required />
                        </div>
                        <div class="col-sm-6">
                            <label>{{ __("Pendiente por asignar") }}</label>
                            <input type="text" id="assign_deposit" v-model.number="assign_deposit" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="mainStudent">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <select-student></select-student>
                            </div>
                        </div>
                        <main-contract-student  :key="mainContractStudentkey"  servicetext="{{ __("Servicios") }}" refundtext="{{ __("Reembolso") }}" removetext="{{ __("Remover") }}"  descriptiontext="{{ __("Descripción") }}" totaltext="{{ __("Total") }}"  paytext="{{ __("Pago") }}"  feetext="{{ __("Cuota") }}"></main-contract-student>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('partials.payments.additional_payments.modal')
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script>
        const dataCreateContract = '{{ route('student.enrollmentAnnuity') }}';
        const createContract = '{{ route('create.contract') }}';
        const showContract = '{{ route('show.contract') }}';
        const updateFee = '{{ route('update.fee') }}';
        const deleteContract = '{{ route('delete.contract') }}';
        const studentsList = '{{ route('list.students') }}';
        const noneSelectedTextShow = '{{ __("Seleccione estudiante") }}';
        const noneResultsTextShow = '{{ __("No hay resultados {0}") }}';
        const textEnrollment = '{{ __("Matrícula") }}';
        const textStudent = '{{ __("Estudiante:") }}';
        let isSuperAdmin = false;
        $(document).ready(function(){
            const modalAddService = $('#add');
            $('#date').datepicker({
                autoclose: true,
                language: 'es',
                format: 'dd/m/yy'
            });
            $(document).on("click", ".service-payment", function(){
                modalAddService.modal({ backdrop: 'static', keyboard: false })
            });
            $('form#addService').submit(function(e){
                e.preventDefault();
                const serviceAdd = $('input[name^=serviceAdd]');
                contractStudent.services = $(this).find(serviceAdd).map(function(idx, elem) {
                    if (elem.checked)
                        return elem
                }).get();
                $(this).find(serviceAdd).prop('checked',false);
                contractStudent.assign_deposit = contractStudent.amount_deposit;
                const date = new Date();
                contractStudent.resetMainContract();
                contractStudent.loadContractPay();
                modalAddService.modal('hide');
            });
        });
        function totalAnnuity(fees){
            return _.reduce(fees, function(memo, fee) {
                return memo + Number(fee.price);
            }, 0)
        }
        function assignValue(costPay){
            let cost = Number(costPay);
            if(contractStudent.assign_deposit >= cost && contractStudent.assign_deposit > 0){
                const newValue = contractStudent.assign_deposit - cost;
                contractStudent.assign_deposit = newValue.toFixed(2);
                return cost.toFixed(2);
            }else if(contractStudent.assign_deposit < cost && contractStudent.assign_deposit > 0){
                const price = contractStudent.assign_deposit;
                const newValue = contractStudent.assign_deposit - price;
                contractStudent.assign_deposit = newValue.toFixed(2);
                return price;
            }
        }
    </script>
@endpush