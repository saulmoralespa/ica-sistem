<div class="modal" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __("Agregar Estudiante") }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>{{ __("Nombre") }}</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Email") }}</label>
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("ID Personal") }}</label>
                        <input type="number" name="idPersonal" id="idPersonal" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Teléfono") }}</label>
                        <input type="number" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ __("Acudiente") }}</label>
                        <input type="text" name="attendant" id="attendant" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit" id="action" value="{{ __("Agregar") }}" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cerrar") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __("Editar estudiante") }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>{{ __("Nombre y apellidos") }}</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Email") }}</label>
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("ID Personal") }}</label>
                        <input type="number" name="idPersonal" id="idPersonal" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Teléfono") }}</label>
                        <input type="number" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ __("Acudiente") }}</label>
                        <input type="text" name="attendant" id="attendant" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="student_id" value="" />
                    <input type="submit" name="submit" id="action" value="{{ __("Actualizar") }}" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cerrar") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="view" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog large" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close no-padding" data-dismiss="modal" @click="cancel" aria-hidden="true">x</button>
                <div class="row no-margin">
                    <div class="col-2 col-sm-1">
                        <i class="fas fa-user-graduate fa-3x"></i>
                    </div>
                    <div class="col-10 col-sm-2 col-md-4">
                        <p class="h5">{{ __("Estudiante:") }} <small class="name"></small></p>
                        <p class="h5">{{ __("ID personal:") }} <small class="idpersonal"></small></p>
                        <p class="h5">{{ __("Acudiente:") }} <small class="attendant"></small></p>
                    </div>
                    <div class="col-6 col-sm-2 col-md-4">
                        <p class="h5">{{ __("Teléfono:") }} <small class="phone"></small></p>
                        <p class="h5">{{ __("Email:") }} <small class="email"></small></p>
                    </div>
                </div>
                <div class="row">
                    <div id="notContracts" class="col text-center">
                        <h2>{{ __("No hay contratos activos") }}</h2>
                        <button id="createContract"  class="btn btn-primary">{{ __("crear contrato") }}</button>
                    </div>
                    <div id="contracts" class="mx-auto">
                        <div class="float-left">
                            <p class="h5">{{ __("Bachillerato:") }} @{{ nameContract }}</p>
                            <p class="h5">{{ __("Número de contrato:") }} @{{ idContract }}&nbsp;&nbsp; | &nbsp;&nbsp;@{{ date_created_at }}
                            | {{ __("Creado por") }} @{{ username }}</p>
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
                                            <input type="text" name="fees[]" class="form-control" @role('Administrator') readonly @endrole v-model="fee.price">
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
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="display: none;" id="newContract" class="mx-auto">
                        <div class="float-left"><p class="h5">{{ __("Crear contracto") }}</p></div>
                        <div class="float-right"></div>
                        <form id="createContract" @submit="contractForm">
                            @csrf
                            <div class="form-group">
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
                                                <input type="text" name="serviceCost[]" class="form-control" @role('Administrator') readonly @endrole v-model="service.cost">
                                            </td>
                                        </tr>
                                    </template>
                                    <tr>
                                        <td>{{ __("Matricula") }}</td>
                                        <td>
                                            <input type="text" name="enrollmentCost" class="form-control" @role('Administrator') readonly @endrole v-model="enrollmentCost">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("Anualidad") }}</td>
                                        <td>
                                            <input type="text" name="annuityCost" class="form-control" @role('Administrator') readonly @endrole v-model="annuity.cost">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("Descuento") }}</td>
                                        <td>
                                            <input type="text" name="annuityDiscount" class="form-control" :readonly="isReadOnly"  @role('Administrator') readonly @endrole v-model="annuity.discount">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("Total") }}</td>
                                        <td>
                                            @{{subtotal + enrollmentCost + Number(annuity.cost) - Number(annuity.discount) | price}}
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
                                <input type="hidden" name="id" id="student_id" value="">
                                <button @click="cancel" class="btn btn-default" type="button" data-dismiss="modal">{{ __("Cancelar") }}</button>
                                <button v-show="table" class="btn btn-primary" type="submit">{{ __("Crear") }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>