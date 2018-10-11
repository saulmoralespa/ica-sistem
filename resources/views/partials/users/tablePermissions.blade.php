<div class="form-group" id="user-permissions-table">
    <label class="col-sm-2 col-form-label">{{ __("Permisos") }}</label>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>{{ __("Módulo") }}</th>
            <th>{{ __("Consultar") }}</th>
            <th>{{ __("Crear/editar") }}</th>
            <th>{{ __("Cancelar") }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="board">{{ __("Tablero") }}</td>
            @foreach($permission as $value)
                @if(strpos($value->name, 'board') !== false)
                    <div class="form-check form-check-inline">
                        <td>
                            {{ Form::checkbox('permission[]', $value->id, false, array('data-permission' => $value->id)) }}
                        </td>
                    </div>
                @endif
            @endforeach
        </tr>
        <tr>
            <td class="students">{{ __("Estudiantes") }}</td>
            @foreach($permission as $value)
                @if(strpos($value->name, 'students') !== false)
                    <div class="form-check form-check-inline">
                        <td>
                            {{ Form::checkbox('permission[]', $value->id, false, array('data-permission' => $value->id)) }}
                        </td>
                    </div>
                @endif
            @endforeach
        </tr>
        <tr>
            <td class="payments">{{ __("Pagos") }}</td>
            @foreach($permission as $value)
                @if(strpos($value->name, 'payments') !== false)
                    <div class="form-check form-check-inline">
                        <td>
                            {{ Form::checkbox('permission[]', $value->id, false, array('data-permission' => $value->id)) }}
                        </td>
                    </div>
                @endif
            @endforeach
        </tr>
        <tr>
            <td class="reports">{{ __("Reportes") }}</td>
            @foreach($permission as $value)
                @if(strpos($value->name, 'reports') !== false)
                    <div class="form-check form-check-inline">
                        <td>
                            {{ Form::checkbox('permission[]', $value->id, false, array('data-permission' => $value->id)) }}
                        </td>
                    </div>
                @endif
            @endforeach
        </tr>
        <tr>
            <td class="costs">{{ __("Gestión de Costos") }}</td>
            @foreach($permission as $value)
                @if(strpos($value->name, 'costs') !== false)
                    <div class="form-check form-check-inline">
                        <td>
                            {{ Form::checkbox('permission[]', $value->id, false, array('data-permission' => $value->id)) }}
                        </td>
                    </div>
                @endif
            @endforeach
        </tr>
        </tbody>
    </table>
</div>