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
                        <div class="col-sm-6">
                            {{--<select ref="addPay" name="student_id" disabled class="selectStudent form-control" v-model="student_id" @change="changeSelectStudent" data-live-search="true" data-size="2" required>
                                @forelse(\App\Student::pluck('name', 'id') as $id => $name)
                                    <option value="{{ $id }}">
                                        {{ $name }}
                                    </option>
                                @empty
                                    <option value="">{{ __("No hay estudiantes registrados") }}</option>
                                @endforelse
                            </select>--}}
                            <select-student v-model="student_id" @change="changeSelectStudent">
                            </select-student>
                        </div>
                    </div>
                    <main-contract-student servicetext="{{ __("Servicios") }}" refundtext="{{ __("Reembolso") }}" descriptiontext="{{ __("Descripción") }}" totaltext="{{ __("Total") }}"  paytext="{{ __("Pago") }}"  feetext="{{ __("Cuota") }}"></main-contract-student>
                    <!-- load table -->
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
        const studentShow = '{{ route('students.admin') }}';
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




{{--
<div class="col-12 border-top mt-2">
    <div class="col-4">
        <div class="float-left mt-3">
            <p class="h6"></p>
        </div>
    </div>
    <div class="float-right mt-3">
        <div class="col-4">
            <button class="btn btn-primary"><li class="fas fa-plus"></li> {{ __("Reembolso") }}</button>
        </div>
    </div>
    <div class="float-right mt-3">
        <div class="col-4">
            <button class="btn btn-primary"><li class="fas fa-plus"></li> {{ __("Servicios") }}</button>
        </div>
    </div>
</div>
<div id="tableDebt" style="display: none;" class="col-12 mt-2">
    <div class="table-responsive">
        <table class="table table-bordered" cellspacing="0">
            <thead>
            <tr>
                <th scope="col">{{ __("Descrpción") }}</th>
                <th scope="col">{{ __("Total") }}</th>
                <th scope="col">{{ __("Pago") }}</th>
                <th scope="col">{{ __("Cuota 1") }}</th>
                <th scope="col">{{ __("Cuota 2") }}</th>
                <th scope="col">{{ __("Cuota 3") }}</th>
                <th scope="col">{{ __("Cuota 4") }}</th>
                <th scope="col">{{ __("Cuota 5") }}</th>
                <th scope="col">{{ __("Cuota 6") }}</th>
                <th scope="col">{{ __("Cuota 7") }}</th>
                <th scope="col">{{ __("Cuota 8") }}</th>
                <th scope="col">{{ __("Cuota 9") }}</th>
                <th scope="col">{{ __("Cuota 10") }}</th>
                <th scope="col">{{ __("Cuota 11") }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="services">
            </tr>
            <tr class="enrollment">
            </tr>
            <tr class="contract">
            </tr>
            </tbody>
        </table>
    </div>
</div>--}}
