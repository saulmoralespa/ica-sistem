@extends('layouts.app')
@section('title')
{{ config('app.name', 'Laravel') }} | {{ __("Mi perfil") }}
@endsection
@section('content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
    @include('partials.header')
    @include('partials.leftaside')

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">

                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title ">{{ __("Su perfil") }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    @include('partials.profile.editcontent')
                </div>
            </div>
        </div>
        <!-- end:: Body -->
        @include('partials.footer')
    </div>

    <!-- end:: Page -->

    {{--@include('partials.quicksidebar')--}}

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->
@endsection
@push('scripts')
<script>
    $("form").submit(function (e) {
        e.preventDefault();
        let form_data = $(this).serialize();
        let self = $(this)
        $(self).find('div.alert-user').empty();
        let form_password = $('form#password-user');
        if($(form_password).is(':visible')){
            let password = $(this).find('input[name=password]').val();
            let repeatpassword = $(this).find('input[name=repeatpassword]').val();

            if (password !== repeatpassword){
                $(self).find('div.alert-user').removeClass('m--hide').html('<div class="alert alert-danger">{{ __('Las contraseñas ingresadas no coinciden') }}</div>');
                return;
            }

        }

       $.ajax({
            type: 'post',
            url: $(form_password).is(':visible')  ? '{{ route('password.admin') }}' : '{{ route('update.user') }}',
            dataType: 'json',
            data: form_data,
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
                    if ($(form_password).is(':visible'))
                        window.location.reload();
                }

                $(self).find('div.alert-user').removeClass('m--hide').html(msg_html);
            }
        })
    });
</script>
@endpush

