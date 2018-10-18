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