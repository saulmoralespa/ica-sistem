@switch($status)
    @case ("1")
    {{ __("Activo") }}
    @break
    @case ("2")
    {{ __("Obligatorio") }}
    @break
    @default
    {{ __("Inactivo") }}
@endswitch