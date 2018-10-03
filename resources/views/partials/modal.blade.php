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
                <p>{{ __("¿Estas seguro que quieres eliminar el usuario?") }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Eliminar</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __("Editar usuario") }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __("¿Estas seguro que quieres eliminar el usuario?") }}</p>
            </div>
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Eliminar</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
            </div>--}}
        </div>
    </div>
</div>