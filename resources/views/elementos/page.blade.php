<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('headTitle', 'GSD :: ' . strtoupper($seccion))</title>
        <!-- <Fonts> -->
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,400i,600,700,900" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <!-- </Fonts> -->
        <!-- <Styles> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ asset('css/css.css') }}" rel="stylesheet">
        <link href="{{ asset('css/page.css') }}" rel="stylesheet">
        @stack('styles')
        <!-- </Styles> -->
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            @include('page.menu')

            <!-- Page Content -->
            <div id="content">
                @yield('body')
            </div>

            @include('page.footer')
        </div>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        @stack('scripts')
        <script>
            $(document).ready(function() {
                window.url = "{{ url()->current() }}";
                if(window.url.indexOf("proyectos") > 0) {
                    aux = window.url.split("/proyectos");
                    window.url = `${aux[0]}/proyectos`;
                }
                if(window.url.indexOf("productos") > 0) {
                    aux = window.url.split("/productos");
                    window.url = `${aux[0]}/productos`;
                }

                $(`nav .nav-link[href="${window.url}"]`).addClass("active");
            });
        </script>
        
    </body>
</html>