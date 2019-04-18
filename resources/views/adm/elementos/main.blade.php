<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('headTitle', 'IMC :: Administración')</title>
        <!-- <Fonts> -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,600,700,800" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <!-- </Fonts> -->
        <!-- <Styles> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="{{ asset('css/materialize.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/messagebox.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/lobibox.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/materialize-select2.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/btn.css') }}" rel="stylesheet" type="text/css" >
        {{-- <link href="{{ asset('css/style.login.css') }}" rel="stylesheet" type="text/css" > --}}
        <link href="{{ asset('css/style.nav.css') }}" rel="stylesheet" type="text/css" >
        @yield('componentcss')
        <!-- </Styles> -->
    </head>
    <body>
        @include('adm.elementos.menu')
        <div class="espacio-nav">
            @yield('body')
        </div>
        @include('adm.elementos.javascript')
        <script>
            var url = "{{ route('usuario.index', ['tipo' => 'clientes']) }}";
            /**
             * Eventos del SERVIDOR
             */
            window.evtSource = new EventSource("{{ action('ServidorController@serve') }}");
            window.evtSource.onopen = function(e) {
                console.log("CONEXIÓN establecida");
            };
            window.evtSource.addEventListener('claveCliente', clienteEVENT);
            
            function clienteEVENT(e) {
                if($("#userContenedor > span").is(":hidden")) {
                    console.log(url)
                    if(window.location.href == url && $("#buttonNotificacion").length)
                        $("#buttonNotificacion").removeClass("disabled");
                    else
                        sessionStorage.setItem("notificacion",1);
                    $("#userContenedor > span").show();
                    $("#userCliente > span").show();
                }
            }
        </script>
    </body>
</html>