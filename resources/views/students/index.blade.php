@extends('partials.template')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush
@section('bodycontent')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h1>{{ __("Estudiantes") }}</h1>
                </div>
            </div>
            <div class="col">
                <button class="add-modal btn btn-primary btn-lg pull-right"><i class="fas fa-plus"></i> {{ __("Agregar Estudiante") }}</button>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <table class="table table-striped table-bordered nowrap"
                       cellspacing="0"
                       id="students-table">
                    <thead>
                    <tr>
                        <th scope="col">{{ __("Estudiante") }}</th>
                        <th scope="col">{{ __("ID Personal") }}</th>
                        <th scope="col">{{ __("Acudiente") }}</th>
                        {{--<th scope="col">{{ __("Paz y salvo") }}</th>--}}
                        <th scope="col">
                            <select name="status" id="status">
                                <option value="">{{ __("Filtrar por estado") }}</option>
                                <option value="1">{{ __("Activo") }}</option>
                                <option value="2">{{ __("Inactivo") }}</option>
                                <option value="3">{{ __("Suspendido") }}</option>
                            </select>
                        </th>
                        <th scope="col">{{ __("Acciones") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('partials.students.modal')
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script>
        let dt;
        let form_msj = $('span#form_output');
        $(document).ready(function(){
            dt = $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('students.admin') }}',
                pagingType: "numbers",
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columns: [
                    {data: 'name'},
                    {data: 'idPersonal'},
                    {data: 'attendant'},
                    {data: "status_formatted"},
                    {data: 'actions'},
                ]
            });

            $("#status").on('change', function () {
                let filter_value = $(this).val();
                let new_url = '{{ route('students.admin') }}/' + filter_value;
                dt.ajax.url(new_url).load();
            });

            $(document).on("click", ".edit-modal", function(e){
                e.preventDefault();
                const id = $(this).data('id');
                const edit = $('#edit');
                $(form_msj).empty();
                $(edit).modal({ backdrop: 'static', keyboard: false });
                $.ajax({
                    type: 'post',
                    url: '{{ route('get.student') }}',
                    dataType: 'json',
                    data: {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        'id': id
                    },
                    success: (res) => {
                        $(edit).find('#name').val(res.name);
                        $(edit).find('#email').val(res.email);
                        $(edit).find('#idPersonal').val(res.idPersonal);
                        $(edit).find('#phone').val(res.phone);
                        $(edit).find('#attendant').val(res.attendant);
                        $(edit).find('#student_id').val(id);

                        $(edit).modal('show');
                    }
                });
            });

            $(document).on("click", ".view-modal", function(e){
                e.preventDefault();
                const id = $(this).data('id');
                const view = $('#view');
                $(view).modal('show');
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
                    url: $('div#add').is(':visible') ? '{{ route('add.student') }}' : '{{ route('update.student') }}',
                    data: form_data,
                    data_type: 'json',
                    success: (res) => {
                        console.log(res)
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
