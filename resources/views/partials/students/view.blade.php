@extends('partials.template')
@section('bodycontent')
<div class="container">
    <div class="row mt-5">
        <div class="col-2 col-sm-1">
            <i class="fas fa-user-graduate fa-3x"></i>
        </div>
        <div class="col-10 col-sm-2 col-md-4">
            <p>{{ __("Estudiante: ") }} {{ $student->name }}</p>
            <p>{{ __("ID personal: ") }} {{ $student->idPersonal }}</p>
            <p>{{ __("Acudiente: ") }} {{ $student->attendant }}</p>
        </div>
        <div class="col-6 col-sm-2 col-md-4">
            <p>{{ __("Teléfono: ") }} {{ $student->phone }}</p>
            <p>{{ __("Email: ") }} {{ $student->email }}</p>
        </div>
        @if(isset($student->contracts[0]))
            <div class="col-2">
                <click-confirm :messages="{title: '¿Seguro desea cancelar este contrato?', yes: 'Si, seguro', no: 'No'}">
                    <button @click="cancelContract" class="btn btn-danger">{{ __("Cancelar contrato") }}</button>
                </click-confirm>
            </div>
        @else
            <div id="notContracts" class="col-12 text-center">
                <h2>{{ __("No hay contratos activos") }}</h2>
                <button id="createContract"  class="btn btn-primary">{{ __("crear contrato") }}</button>
            </div>
        @endif
    </div>
</div>
@endsection
@push('scripts')
@endpush