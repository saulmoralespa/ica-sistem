@extends('partials.template')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush
@section('bodycontent')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h1>{{ __("Costos de Matrículas") }}</h1>
                </div>
            </div>
            <div class="col">
                <button class="add-modal btn btn-primary btn-lg pull-right"><i class="fas fa-plus"></i> {{ __("Agegar grado") }}</button>
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
        let form_msj = $('span#form_output');
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
                form_msj.empty();
                $('#add').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                    });
            });

            $("form#user_form").submit(function(e){
                e.preventDefault();
                form_msj.empty();
                const form_data = $(this).serialize()
                $.ajax({
                    type: 'post',
                    url: '{{ route('add.student') }}',
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