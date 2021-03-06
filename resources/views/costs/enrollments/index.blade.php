@extends('partials.template')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush
@section('bodycontent')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h1>{{ __("Costos de Matrículas") }}</h1>
                </div>
            </div>
            <div class="col">
                <button class="add-modal btn btn-primary btn-lg pull-right"><i class="fas fa-plus"></i> {{ __("Agregar matrícula") }}</button>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <table class="table table-striped table-bordered nowrap"
                       cellspacing="0"
                       id="enrollments-table">
                    <thead>
                    <tr>
                        <th scope="col">{{ __("Grado") }}</th>
                        <th scope="col">{{ __("Bachiller") }}</th>
                        <th scope="col">{{ __("Costo de Matrícula") }}</th>
                        <th scope="col">{{ __("Acciones") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('partials.costs.enrollments.modal')
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script>
        let dt;
        let formData = $("form#user_form");
        let form_msj = $('span#form_output');
        let modalDefault = $('#postGet');
        let formAdd = true;
        $(document).ready(function(){
            dt = $('#enrollments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('enrollments.fetch') }}',
                pagingType: "numbers",
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columns: [
                    {data: 'grade'},
                    {data: 'bachelor'},
                    {data: 'cost'},
                    {data: 'actions'}
                ]
            });

            $(document).on("click", ".add-modal", function(e){
                e.preventDefault();
                formData.trigger('reset');
                form_msj.empty();
                $(modalDefault).find('.modal-title').text('{{ __("Agregar matrícula") }}');
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

                        $(modalDefault).find('.modal-title').text('{{ __("Editar matrícula") }}');
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
                let cost = costInput.val();

                let grade = $('input[name=grade]');
                let gradeVal = grade.val();

                if(!isNaN(gradeVal)){
                    gradeVal += '°';
                    grade.val(gradeVal);
                }

                let bachelor = $('input[name=bachelor]');
                let bacherlorVal = bachelor.val();
                bacherlorVal = bacherlorVal.charAt(0).toUpperCase() + bacherlorVal.slice(1);
                bachelor.val(bacherlorVal);

                if (isNaN(cost)){
                    $(form_msj).html('<div class="alert alert-danger">{{ __("No esta ingresado un costo válido, puede usar una cantidad con decimales ejemplo 345.00") }}</div>');
                    return;
                }

                const form_data = $(this).serialize()

                $.ajax({
                    type: 'post',
                    url: formAdd ? '{{ route('add.enrollment') }}' : '{{ route('update.enrollment') }}',
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