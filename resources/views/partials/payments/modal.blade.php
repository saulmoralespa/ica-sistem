<div id="add" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog large" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close no-padding" data-dismiss="modal" aria-hidden="true">x</button>
                <div class="row">
                    <div class="col">
                        <p class="h5 ml-5">{{ __("Agregar pago") }}</p>
                    </div>
                    <div class="w-100"></div>
                    <div class="mx-auto">
                        <form>
                            <div class="float-left">
                                <div class="form-group">
                                    <label>{{ __("Fecha de depósito") }}</label>
                                    <input type="text" name="date_deposit" id="date_deposit" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>{{ __("Pendiente por asignar") }}</label>
                                    <input type="text" name="assign_deposit" id="assign_deposit"  :value="Number(amount_deposit) | price" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="form-group">
                                    <label>{{ __("Monto a depositar") }}</label>
                                    <input type="text" name="amount_deposit" id="amount_deposit" v-model.number="amount_deposit" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <select class="selectStudent" v-model="student_id" @change="changeSelectStudent" data-live-search="true" data-size="2">
                                        @forelse(\App\Student::pluck('name', 'id') as $id => $name)
                                            <option value="{{ $id }}">
                                                {{ $name }}
                                            </option>
                                        @empty
                                            <option value="">{{ __("No hay estudiantes registrados") }}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>