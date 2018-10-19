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
                        <label>{{ __("Año") }}</label>
                        <input type="text" name="year" id="year" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Costo") }}</label>
                        <input type="text" name="cost" id="cost" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Descuento") }}</label>
                        <input type="text" name="discount" id="discount" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Fecha Máxima") }}</label>
                        <input type="text" name="maximum_data " id="maximum_data" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Mes de 2da Couta") }}</label>
                        <input type="text" name="second_month" id="second_month" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="annuity_id" value="" />
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
                <p>{{ __("¿Estas seguro que quieres eliminar la anualidad?") }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">{{ __("Eliminar") }}</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{{ __("Cancelar") }}</button>
            </div>
        </div>
    </div>
</div>