@switch($status)
    @case ("1")
    {{ __("Activo") }}
    @break
    @case ("2")
    {{ __("Inactivo") }}
    @break
    @default
    {{ __("Suspendido") }}
@endswitch