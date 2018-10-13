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
                <p>{{ __("¿Estas seguro que quieres eliminar la matrícula?") }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">{{ __("Eliminar") }}</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{{ __("Cancelar") }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __("Agregar matrícula") }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>{{ __("Grado") }}</label>
                        <input type="text" name="grade" id="grade" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Bachiller") }}</label>
                        <input type="text" name="bachelor" id="bachelor" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Costo de Matrícula") }}</label>
                        <input type="text" name="cost" id="cost" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" value="" />
                    <input type="submit" name="submit" id="action" value="{{ __("Agregar") }}" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cerrar") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>