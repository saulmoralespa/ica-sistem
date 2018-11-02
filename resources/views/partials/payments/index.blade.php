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
                            <div class="float-right">
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
                            <input type="text" name="amount_deposit" id="amount_deposit" v-model.number="amount_deposit" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row">
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
                        <main-contract-student servicetext="{{ __("Servicios") }}" refundtext="{{ __("Reembolso") }}" descriptiontext="{{ __("Descripción") }}" totaltext="{{ __("Total") }}"  paytext="{{ __("Pago") }}"  feetext="{{ __("Cuota") }}"></main-contract-student>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        $(document).ready(function(){
            $('#date').datepicker({
                autoclose: true,
                language: 'es',
                format: 'dd/m/yy'
            });
        });
        function totalAnnuity(fees){
            return _.reduce(fees, function(memo, fee) {
                return memo + Number(fee.price);
            }, 0)
        }
        function assignValueEnrollment(enrollmentCost){
            let cost = Number(enrollmentCost);
            cost = cost.toFixed(2);
            if(contractStudent.assign_deposit > cost){
                const newValue = contractStudent.assign_deposit - cost;
                contractStudent.assign_deposit = newValue.toFixed(2);
                return cost;
            }
        }
        function assignValueService(serviceCost){
            let cost = Number(serviceCost);
            cost = cost.toFixed(2);
            if(contractStudent.assign_deposit > cost){
                const newValue = contractStudent.assign_deposit - cost;
                contractStudent.assign_deposit = newValue.toFixed(2);
                return cost;
            }
        }
    </script>
@endpush