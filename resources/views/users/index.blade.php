@extends('partials.template')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush
@section('bodycontent')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-header">
                    <h1>{{ __("Usuarios") }}</h1>
                </div>
            </div>
            <div class="col">
                <button class="add-modal btn btn-primary btn-lg pull-right"><i class="fas fa-plus"></i> {{ __("Agregar Usuario") }}</button>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <table class="table table-striped table-bordered nowrap"
                       cellspacing="0"
                       id="users-table">
                    <thead>
                    <tr>
                        <th scope="col">{{ __("Nombre") }}</th>
                        <th scope="col">{{ __("Usuario") }}</th>
                        <th scope="col">{{ __("Fecha de creación") }}</th>
                        <th scope="col">{{ __("Acciones") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('partials.modal')
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script>
        let dt;
        $(document).ready(function(){
            dt = $('#users-table').DataTable({
                sDom: "lfrti",
                bInfo: false,
                pageLength: 5,
                lengthMenu: [5,10, 15, 20, 25, 30, 35, 40, 45,
                    50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100],
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.admin') }}',
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columns: [
                    {data: 'name'},
                    {data: 'username'},
                    {data: 'created_at'},
                    {data: 'actions'}
                ]
            })

           $(document).on("click", ".edit-modal", function(e){
               e.preventDefault();
               const id = $(this).data('id');
               $('#edit').modal({ backdrop: 'static', keyboard: false })
           })

            $(document).on("click", ".delete-modal", function(e){
                e.preventDefault();
                const id = $(this).data('id');
                $('#delete').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                        $.ajax({
                            type: 'post',
                            url: '{{ route('delete.user') }}',
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
            })
        })
    </script>
@endpush