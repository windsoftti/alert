@extends('adminlte::login')

@section('css')
<style>
    .img-logo {
        width: 100%;
        height: auto;
        max-width: 150px;
    }

    .login-page{
        -ms-flex-align: center;
        align-items: center;
        background: #ffffff;
    }

</style>
@stop


@section('js')
    <script>

        var baseUrl = "{{url("/")}}";


        $(".mb-0").hide();

        $(".icheck-primary").hide();

        var loginLogo ='<div class="login-logo"> <a href="'+baseUrl+'/home"><img src="'+baseUrl+'/assets/img/mkt-connect.png" class="img-logo"> </a> </div>';

        $( "div.login-logo" ).replaceWith( loginLogo );


    </script>


@stop