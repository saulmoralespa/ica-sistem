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
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">{{ __("Eliminar") }}</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{{ __("Cancelar") }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __("Editar usuario") }}</h4>
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
                        <label>{{ __("Rol") }}</label>
                        <select name="role_id" class="form-control">
                            <option value="1">{{ __("Super Administrador") }}</option>
                            <option value="2">{{ __("Adminstrador") }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __("Contraseña") }}</label>
                        <input type="password" name="password" id="password" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="user_id" value="" />
                    <input type="submit" name="submit" id="action" value="{{ __("Actualizar") }}" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cerrar") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __("Agregar usuario") }}</h4>
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
                        <label>{{ __("Usuario") }}</label>
                        <input type="text" name="username" id="username" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Email") }}</label>
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>{{ __("Rol") }}</label>
                        <select name="role_id" class="form-control" required>
                            <option value="">{{ __("Seleccione opción") }}</option>
                            <option value="1">{{ __("Super Administrador") }}</option>
                            <option value="2">{{ __("Adminstrador") }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label">{{ __("Permisos") }}</label>

                        <table class="table table-striped table-bordered" id="user-add-table">
                            <thead>
                            <tr>
                                <th>Módulo</th>
                                <th>Consultar</th>
                                <th>Crear/editar</th>
                                <th>Cancelar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ __("Tablero") }}</td>
                                @foreach($permission as $value)
                                    @if(strpos($value->name, 'board') !== false)
                                    <div class="form-check form-check-inline">
                                       <td>
                                        {{ Form::checkbox('permission[]', $value->id, false, array()) }}
                                       </td>
                                    </div>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ __("Estudiantes") }}</td>
                                @foreach($permission as $value)
                                    @if(strpos($value->name, 'students') !== false)
                                        <div class="form-check form-check-inline">
                                            <td>
                                                {{ Form::checkbox('permission[]', $value->id, false, array()) }}
                                            </td>
                                        </div>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ __("Pagos") }}</td>
                                @foreach($permission as $value)
                                    @if(strpos($value->name, 'payments') !== false)
                                        <div class="form-check form-check-inline">
                                            <td>
                                                {{ Form::checkbox('permission[]', $value->id, false, array()) }}
                                            </td>
                                        </div>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ __("Reportes") }}</td>
                                @foreach($permission as $value)
                                    @if(strpos($value->name, 'reports') !== false)
                                        <div class="form-check form-check-inline">
                                            <td>
                                                {{ Form::checkbox('permission[]', $value->id, false, array()) }}
                                            </td>
                                        </div>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ __("Gestión de Costos") }}</td>
                                @foreach($permission as $value)
                                    @if(strpos($value->name, 'costs') !== false)
                                        <div class="form-check form-check-inline">
                                            <td>
                                                {{ Form::checkbox('permission[]', $value->id, false, array()) }}
                                            </td>
                                        </div>
                                    @endif
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label>{{ __("Contraseña") }}</label>
                        <input type="password" name="password" id="password" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="user_id" value="" />
                    <input type="submit" name="submit" id="action" value="{{ __("Agregar") }}" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cerrar") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>