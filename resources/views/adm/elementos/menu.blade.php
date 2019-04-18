<ul id="nav-mobile" class="sidenav s12 m3 xl3 sidenav-fixed d-flex flex-column" style="padding: 0; height: 100%; overflow-y: hidden; background-color:#ededed;" role="navigation">
    <li style="background-color: #f0f0f0"><img class="sidenav-img" src="{{ asset('/') }}{{ $empresaimagen["data"]->logo }}?t=<?php echo time(); ?>"></li>
    <li class="no-padding scroll" style="height: calc(100% - 140.78px); overflow-x: auto">
        <ul class="collapsible z-depth-0 no-margin">
            <li class="active">
                <div class="collapsible-header"><i class="material-icons">home</i>Home</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('contenido.edit', ['seccion' => 'home'])}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Editar contenido</a></li>
                        <li><a href="{{ route('slider.index', ['seccion' => 'home'])}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Slider</a></li>
                    </ul> 
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">view_day</i>Nosotros</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('contenido.edit', ['seccion' => 'nosotros'])}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Editar contenido</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">grid_on</i>Calidad</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('contenido.edit', ['seccion' => 'calidad'])}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Editar contenido</a></li>
                        <li><a href="{{ route('archivo.index', ['seccion' => 'calidad'])}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Archivos</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">help</i>Servicios</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('servicio.index')}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Todos los servicios</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">local_library</i>Prensa</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('contenido.edit', ['seccion' => 'prensa'])}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Editar contenido</a></li>
                        <li><a href="{{ route('archivo.index', ['seccion' => 'prensa'])}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Archivos</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">filter</i>Portfolio</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('trabajos.index')}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Todos los trabajos</a></li>
                        <li><a href="{{ route('trabajos.familia')}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Familia de trabajos</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">account_box</i>RR. HH.</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('rrhh.index')}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Todas los opciones</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">contacts</i>Clientes</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('cliente.index')}}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Todos los clientes</a></li>
                    </ul>
                </div>
            </li>
            <li><hr/></li>
            <li class="dato">
                <div class="collapsible-header"><i class="material-icons">work</i>Datos de la empresa</div>
                <div class="collapsible-body">
                    <ul>{{-- --}}
                        <li><a href="{{ route('empresa') }}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Editar datos</a></li>
                        <li><a href="{{ route('empresa.imagenes') }}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Imágenes</a></li>
                    </ul>
                </div>
            </li>
            <li class="dato">
                <div class="collapsible-header"><i class="material-icons">description</i>Metadatos</div>
                <div class="collapsible-body">
                    <ul>{{-- --}}
                        <li><a href="{{ route('empresa.metadatos') }}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Editar metadatos</a></li>
                    </ul>
                </div>
            </li>
            <li class="dato">
                <div class="collapsible-header position-relative"><i class="material-icons">perm_contact_calendar</i>Usuarios<span class="position-absolute" style="right: 10px;border-radius: 50%;background-color: red;width: 10px;height: 10px;top: calc(50% - 5px);display: none;"></span></div>
                <div class="collapsible-body">
                    <ul>
                        @if(Auth::user()["is_admin"])
                            <li><a href="{{ route('usuario.index', ['tipo' => 'adm']) }}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Usuarios</a></li>
                        @endif
                        <li><a href="{{ route('usuario.datos') }}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Mis datos</a></li>
                    </ul>
                </div>
            </li>
            <li class="dato">
                <div class="collapsible-header position-relative" id="userContenedor"><i class="material-icons">assignment</i>Clientes<span class="position-absolute" style="right: 10px;border-radius: 50%;background-color: red;width: 10px;height: 10px;top: calc(50% - 5px);display: none;"></span></div>
                <div class="collapsible-body">
                    <ul>
                        <li id="userCliente" class="position-relative"><a href="{{ route('usuario.index', ['tipo' => 'clientes']) }}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Todos</a><span class="position-absolute" style="right: 10px;border-radius: 50%;background-color: red;width: 10px;height: 10px;top: calc(50% - 5px);display: none;"></span></li>
                        <li class="position-relative"><a href="{{ route('usuario.newsletters') }}" class="collapsible-header"><i class="material-icons">arrow_forward</i> Newsletters</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        
    </li>
    {{--  --}}
    <a class="nav-logout text-center" href="{{route('adm.logout')}}">
        Cerrar Sesión
    </a>
</ul>