<div class="modal" tabindex="-1" role="dialog" id="postGet">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
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
                        <label>{{ __("costo") }}</label>
                        <input type="text" name="cost" id="cost" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Estado") }}</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">{{ __("Seleccione estado") }}</option>
                            <option value="1">{{ __("Activo") }}</option>
                            <option value="2">{{ __("Obligatorio") }}</option>
                            <option value="3">{{ __("Inactivo") }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="service_id" value="" />
                    <input type="submit" name="submit" id="action" value="" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cerrar") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __("Confirmación de eliminación") }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __("¿Estas seguro que quieres eliminar el servicio?") }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">{{ __("Eliminar") }}</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{{ __("Cancelar") }}</button>
            </div>
        </div>
    </div>
</div>