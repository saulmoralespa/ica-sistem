@extends('partials.template')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush
@section('bodycontent')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h2>{{ __("Servicios") }}</h2>
                </div>
            </div>
            <div class="col col-sm-4">
                <button class="add-modal btn btn-primary btn-lg pull-right"><i class="fas fa-plus"></i> {{ __("Agegar servicio") }}</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap"
                           cellspacing="0"
                           id="services-table">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("Nombre") }}</th>
                            <th scope="col">{{ __("Costo") }}</th>
                            <th scope="col">{{ __("Estado") }}</th>
                            <th scope="col">{{ __("Acciones") }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partials.costs.services.modal')
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script>
        let dt;
        let formData = $("form#user_form");
        let form_msj = $('span#form_output');
        let modalDefault = $('#postGet');
        let formAdd =  true;
        $(document).ready(function(){
            dt = $('#services-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('services.fetch') }}',
                pagingType: "numbers",
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columns: [
                    {data: 'name'},
                    {data: 'cost'},
                    {data: 'status_formatted'},
                    {data: 'actions'}
                ]
            });

            $(document).on("click", ".add-modal", function(e){
                e.preventDefault();
                formData.trigger('reset');
                form_msj.empty();
                $(modalDefault).find('.modal-title').text('{{ __("Agregar servicio") }}');
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
                    url: '{{ route('get.service') }}',
                    dataType: 'json',
                    data: {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        'id': id
                    },
                    success: (res) => {
                        console.log(res);
                        $('#name').val(res.name);
                        $('#cost').val(res.cost);
                        $('#status').val(res.status);
                        $('#service_id').val(id);

                        $(modalDefault).find('.modal-title').text('{{ __("Editar Servicio") }}');
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
                            url: '{{ route('delete.service') }}',
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
                let cost = costInput.val();


                let name = $('input[name=name]');
                let nameVal = name.val();
                nameVal = nameVal.charAt(0).toUpperCase() + nameVal.slice(1);
                name.val(nameVal);

                if (isNaN(cost)){
                    $(form_msj).html('<div class="alert alert-danger">{{ __("No esta ingresado un costo válido, puede usar una cantidad con decimales ejemplo 345.00") }}</div>');
                    return;
                }

                const form_data = $(this).serialize();


                $.ajax({
                    type: 'post',
                    url: formAdd ? '{{ route('add.service') }}' : '{{ route('update.service') }}',
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

        });
    </script>
@endpush