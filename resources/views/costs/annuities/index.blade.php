@extends('partials.template')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
@endpush
@section('bodycontent')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h2>{{ __("Costos de Anualidades") }}</h2>
                </div>
            </div>
            <div class="col">
                <button class="add-modal btn btn-primary btn-lg pull-right"><i class="fas fa-plus"></i> {{ __("Agegar anualidad") }}</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap"
                           cellspacing="0"
                           id="annuities-table">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("Año") }}</th>
                            <th scope="col">{{ __("Costo") }}</th>
                            <th scope="col">{{ __("Descuento") }}</th>
                            <th scope="col">{{ __("Fecha Máxima") }}</th>
                            <th scope="col">{{ __("Mes de 2da Cuota") }}</th>
                            <th scope="col">{{ __("Acciones") }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partials.costs.annuities.modal')
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
    <script>
        let dt;
        let formData = $("form#user_form");
        let form_msj = $('span#form_output');
        let modalDefault = $('#postGet');
        let formAdd = true;
        $(document).ready(function(){
            dt = $('#annuities-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('annuities.fetch') }}',
                pagingType: "numbers",
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columns: [
                    {data: 'year'},
                    {data: 'cost'},
                    {data: 'discount'},
                    {data: 'maximum_data'},
                    {data: 'second_month'},
                    {data: 'actions'}
                ]
            });

            $(document).on("click", ".add-modal", function(e){
                e.preventDefault();
                formData.trigger('reset');
                form_msj.empty();
                $(modalDefault).find('.modal-title').text('{{ __("Agregar anualidad") }}');
                $(modalDefault).find('#action').val('{{ __("Agregar") }}');
                $(modalDefault).modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                    });
            });


            $(document).on("click", ".edit-modal", function(e){
                e.preventDefault();
                formData.trigger('reset');
                $(form_msj).empty();
                formAdd = false;
                const id = $(this).data('id');
                $.ajax({
                    type: 'post',
                    url: '{{ route('get.enrollment') }}',
                    dataType: 'json',
                    data: {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        'id': id
                    },
                    success: (res) => {
                        $('#grade').val(res.grade);
                        $('#bachelor').val(res.bachelor);
                        $('#cost').val(res.cost);
                        $('#enrollment_id').val(id);

                        $(modalDefault).find('.modal-title').text('{{ __("Editar anualidad") }}');
                        $(modalDefault).find('#action').val('{{ __("Actualizar") }}');

                        $(modalDefault).modal('show');
                    }
                });
            });

            $(document).on("click", ".delete-modal", function(e){
                e.preventDefault();
                const id = $(this).data('id');
                $('#delete').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                        $.ajax({
                            type: 'post',
                            url: '{{ route('delete.enrollment') }}',
                            data: {
                                '_token': $('meta[name=csrf-token]').attr('content'),
                                'id': id
                            },
                            success: (res) =>{
                                $('#delete').modal('hide');
                                dt.ajax.reload();
                            }
                        });
                    });
            });

            $(formData).submit(function(e){
                e.preventDefault();
                form_msj.empty();
                let costInput = $('input[name=cost]');
                let discountInput = $('input[name=discount]');
                let cost = costInput.val();
                let discount = discountInput.val();

                if (isNaN(cost) || isNaN(discount)){
                    $(form_msj).html('<div class="alert alert-danger">{{ __("No esta ingresado un precio válido, puede usar una cantidad con decimales ejemplo 345.00") }}</div>');
                    return;
                }

                const form_data = $(this).serialize();

                $.ajax({
                    type: 'post',
                    url: formAdd ? '{{ route('add.annuity') }}' : '{{ route('update.annuity') }}',
                    data: form_data,
                    data_type: 'json',
                    success: (res) => {
                        let msg_html = '';
                        if(res.error.length > 0)
                        {
                            for(var count = 0; count < res.error.length; count++)
                            {
                                msg_html += '<div class="alert alert-danger">'+res.error[count]+'</div>';
                            }
                        }else{
                            msg_html += '<div class="alert alert-success">'+res.success+'</div>';
                            dt.ajax.reload();
                        }
                        $(form_msj).html(msg_html);
                    }
                });
            });

            let date = new Date();
            date.setDate(date.getDate());

            $('#year').datepicker({
                startDate: date,
                minViewMode: "years",
                maxViewMode: 'years',
                startView: 'years',
                autoclose: true,
                language: 'es',
                format: 'yyyy'
            });


            $('#maximum_data').datepicker({
                startDate: date,
                autoclose: true,
                language: 'es',
                format: 'dd/m/yy'
            });

            $('#second_month').datepicker({
                startDate: date,
                minViewMode: "months",
                maxViewMode: 'months',
                startView: 'months',
                autoclose: true,
                language: 'es',
                format: 'mm'
            }).datepicker("setDate", new Date());
        });
    </script>
@endpush