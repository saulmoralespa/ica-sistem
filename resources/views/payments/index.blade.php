@extends('partials.template')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush
@section('bodycontent')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h1>{{ __("Pagos") }}</h1>
                </div>
            </div>
            <div class="col">
                <button class="add-modal btn btn-primary btn-lg pull-right"><i class="fas fa-plus"></i> {{ __("Agregar Pago") }}</button>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <table class="table table-striped table-bordered nowrap"
                       cellspacing="0"
                       id="payments-table">
                    <thead>
                    <tr>
                        <th scope="col">{{ __("Fecha") }}</th>
                        <th scope="col">{{ __("Fecha de depósito") }}</th>
                        <th scope="col">{{ __("Recibo") }}</th>
                        <th scope="col">{{ __("Estudiante") }}</th>
                        <th scope="col">{{ __("Acudiente") }}</th>
                        <th scope="col">{{ __("N° operación") }}</th>
                        <th scope="col">{{ __("Monto") }}</th>
                        <th scope="col">{{ __("Acciones") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('partials.payments.modal')
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script>
        /*
        * orden desc
        * search for date initial and date end
        *
        * */
        let dt;
        let form_msj = $('span#form_output');
        $(document).ready(function() {
            dt = $('#payments-table').DataTable({
                pagingType: "numbers",
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }
            });
        });
    </script>
@endpush