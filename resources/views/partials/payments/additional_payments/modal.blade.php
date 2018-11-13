<div class="modal" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="addService">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __("Selecciona un servicio") }}</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" cellspacing="0"
                               id="service-add-table">
                            <thead>
                            <tr>
                                <th scope="col">{{ __("Descrpción") }}</th>
                                <th scope="col">{{ __("Total") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td><input type="checkbox" data-name="{{ $service->name }}" data-price="{{ $service->cost }}" class="m-checkbox-inline" name="serviceAdd[]" value="{{ $service->id }}">{{ $service->name }}</td>
                                    <td>{{ $service->cost }}</td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit" id="action" value="{{ __("Agregar") }}" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancelar") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>