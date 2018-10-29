@extends('partials.template')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
@endpush
@section('bodycontent')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form id="addPayment" ref="formAddPay">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p class="h5">{{ __("Agregar pago") }}</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right">
                                <button class="btn btn-primary"><li class="fas fa-save"></li> {{ __("Guardar") }}</button>
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
                            <input type="text" name="assign_deposit" id="assign_deposit" :value="Number(amount_deposit) | price" class="form-control" readonly />
                        </div>
                        <div class="col-sm-6">
                            <select disabled class="selectStudent form-control" v-model="student_id" @change="changeSelectStudent" data-live-search="true" data-size="2">
                                @forelse(\App\Student::pluck('name', 'id') as $id => $name)
                                    <option value="{{ $id }}">
                                        {{ $name }}
                                    </option>
                                @empty
                                    <option value="">{{ __("No hay estudiantes registrados") }}</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-12 border-top mt-2">
                            <div class="col-4">
                                <div class="float-left mt-3">
                                    <p ref="nameStudent" class="h6">{{ __("Estudiante: ") }} <em></em></p>
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
        $(document).ready(function(){
            $('#date').datepicker({
                autoclose: true,
                language: 'es',
                format: 'dd/m/yy'
            });

            $('.selectStudent').selectpicker({
                noneSelectedText : '{{ __("Seleccione estudiante") }}',
                noneResultsText: '{{ __("No hay resultados {0}") }}',
            });
        });
    </script>
@endpush