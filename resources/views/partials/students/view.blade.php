@extends('partials.template')
@section('bodycontent')
<div class="container">
    <div class="row mt-5">
        <div class="col-2 col-sm-1">
            <i class="fas fa-user-graduate fa-3x"></i>
        </div>
        <div class="col-10 col-sm-2 col-md-4">
            <p>{{ __("Estudiante: ") }} {{ $student->name }}</p>
            <p>{{ __("ID personal: ") }} {{ $student->idPersonal }}</p>
            <p>{{ __("Acudiente: ") }} {{ $student->attendant }}</p>
        </div>
        <div class="col-6 col-sm-2 col-md-4">
            <p>{{ __("Teléfono: ") }} {{ $student->phone }}</p>
            <p>{{ __("Email: ") }} {{ $student->email }}</p>
        </div>
        @if(isset($student->contracts[0]))
            @role('SuperAdministrator')
            <div class="col-2">
                <click-confirm placement="bottom" :messages="{title: '¿Seguro desea cancelar este contrato?', yes: 'Si, seguro', no: 'No'}">
                    <button @click="cancelContract" class="btn btn-danger">{{ __("Cancelar contrato") }}</button>
                </click-confirm>
            </div>
            @endrole
            <div id="contracts" class="col-12">
                <div class="float-left">
                    <p class="h5 ml-5">{{ __("Bachillerato:") }} @{{ nameContract }}</p>
                    <p class="h5 ml-5">{{ __("Número de contrato:") }} @{{ idContract }}&nbsp;&nbsp; | &nbsp;&nbsp;@{{ date_created_at }}
                        | {{ __("Creado por") }} @{{ username }}</p>
                    <p class="h5 ml-5" v-if="observations">{{ __("Observaciones: ") }} @{{ observations }}</p>
                </div>
                <div class="float-right">
                    <p class="h5 mr-5">{{ __("Año") }} <span v-for="(year, index) in years" v-if="index === 0 && yearChange == ''">@{{ year.year }}</span>@{{ yearChange }}
                        <template v-if="years.length > 1">
                            <select class="form-control" v-model="yearChange" @change="onChangeYear()" style="display:inline!important;width:auto">
                                <option value="">{{ __("Cambiar año") }}</option>
                                <option v-for="year in years" :value="year.year">@{{ year.year }}</option>
                            </select>
                        </template>
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="0" id="contractShowTable">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("Descrpción") }}</th>
                            <th scope="col">{{ __("Total") }}</th>
                            <th scope="col">{{ __("R15") }}</th>
                            <th scope="col">{{ __("R1") }}</th>
                            <th scope="col">{{ __("Pagos") }}</th>
                            <th scope="col">{{ __("Fecha") }}</th>
                            <th scope="col">{{ __("Recibo") }}</th>
                            <th scope="col">{{ __("N° operación") }}</th>
                            <th scope="col">{{ __("Saldo") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="service in services">
                            <tr>
                                <td>{{ __("Matrícula") }}</td>
                                <td>@{{ enrollmentCost }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    @{{ service.name }}
                                </td>
                                <td>
                                    @{{ service.cost }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </template>
                        <template v-for="(fee, key) in fees">
                            <tr>
                                <td>@{{ fee.name }}</td>
                                <td>
                                    <input type="text" name="fees[]"  @keyup="changeFees" class="form-control" @role('Administrator') readonly @endrole v-model.number="fee.price">
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </template>
                        <tr>
                            <td>{{ __("Total") }}</td>
                            <td>@{{ subtotal + Number(enrollmentCost) + totalfees | price }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>@{{ subtotal + Number(enrollmentCost) + totalfees | price }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div id="notContracts" class="col-12 text-center">
                <h2>{{ __("No hay contratos activos") }}</h2>
                <button id="createContract"  class="btn btn-primary">{{ __("crear contrato") }}</button>
            </div>
            <div style="display: none!important;" id="newContract" class="col-12 d-flex justify-content-center align-items-center">
                <form id="createContract" @submit="contractForm">
                    @csrf
                    <div class="form-group">
                        <label for="gradeBachelor">{{ __("Crear contracto") }}</label>
                        <select v-model="gradeBachelor" name="gradeBachelor" id="gradeBachelor" class="form-control" @change="onChange()" required>
                            <option value="">{{ __("Escoger Bachiller y grado") }}</option>
                            @foreach(\App\Enrollment::select('id', 'grade', 'bachelor')->get() as $enrollment)
                                <option value="{{ $enrollment['id'] }}">
                                    {{ $enrollment['grade'] }} {{ $enrollment['bachelor'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <table v-show="table" class="table table-bordered" cellspacing="0"
                           id="contract-table">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("Descrpción") }}</th>
                            <th scope="col">{{ __("Monto") }}</th>
                        </tr>
                        </thead>
                        <tbody v-show="table">
                        <template v-for="service in services">
                            <tr>
                                <td>
                                    @{{ service.name }}
                                    <input type="hidden" name="serviceName[]" :value="service.name">
                                </td>
                                <td>
                                    <input type="text" name="serviceCost[]" class="form-control" @role('Administrator') readonly @endrole v-model.number="service.cost">
                                </td>
                            </tr>
                        </template>
                        <tr>
                            <td>{{ __("Matricula") }}</td>
                            <td>
                                <input type="text" name="enrollmentCost" class="form-control" @role('Administrator') readonly @endrole v-model.number="enrollmentCost">
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Anualidad") }}</td>
                            <td>
                                <input type="text" name="annuityCost" class="form-control" @role('Administrator') readonly @endrole v-model.number="annuity.cost">
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Descuento") }}</td>
                            <td>
                                <input type="text" name="annuityDiscount" class="form-control" :readonly="isReadOnly"  @role('Administrator') readonly @endrole v-model.number="annuity.discount">
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Total") }}</td>
                            <td>
                                @{{subtotal + Number(enrollmentCost) + Number(annuity.cost) - Number(annuity.discount) | price}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div v-show="table" class="form-group">
                        <label for="observations">{{ __("Observaciones") }}</label>
                        <textarea name="observations" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <input type="hidden" id="year" name="year" :value="year">
                        <input type="hidden" id="nameContract" name="name">
                        <input type="hidden" name="totalAnnuity" :value="Number(annuity.cost) - Number(annuity.discount) | price">
                        <input type="hidden" name="id" id="student_id" value="{{ $student->id }}">
                        <a href="{{ route('students') }}" class="btn btn-default">{{ __("Cancelar") }}</a>
                        <button v-show="table" class="btn btn-primary" type="submit">{{ __("Crear") }}</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
@push('scripts')
    <script>
        const dataCreateContract = '{{ route('student.enrollmentAnnuity') }}';
        const createContract = '{{ route('create.contract') }}';
        const showContract = '{{ route('show.contract') }}';
        const updateFee = '{{ route('update.fee') }}';
        const deleteContract = '{{ route('delete.contract') }}';
        $(document).ready(function(){
            $('button#createContract').click(function (){
                $("#notContracts").hide();
                $("#newContract").show();
            });
            
            if ($('div#contracts').is(":visible"))
                contractStudent.loadContract({{ $student->id }});
            
        });
    </script>
@endpush