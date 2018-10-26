@switch($peace_save)
    @case ("1")
    {{ __("Si") }}
    @break
    @case ("2")
    {{ __("No") }}
    @break
    @default
    {{ __("Sin contracto actual") }}
@endswitch