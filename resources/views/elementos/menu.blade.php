<div class="sidebar-header">
    <h3 class="m-0">Menu</h3>
</div>
<div class="position-relative" style="height: calc(100% - 73px - 38px); overflow-y:auto;">
    <div class="w-100 position-absolute">
        <ul class="list-unstyled components m-0 p-0">
            <li class="">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-home"></i>Home OK</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a  href="{{ route('contenido.edit', ['seccion' => 'home'])}}">Contenido</a>
                    </li>
                    <li>
                        <a href="{{ route('slider.index', ['seccion' => 'home'])}}">Slider</a>
                    </li>
                </ul>
            </li>
            <li>
            <a href="#nosotrosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-building"></i>Nosotros OK</a>
                <ul class="collapse list-unstyled" id="nosotrosSubmenu">
                    <li>
                        <a href="{{ route('contenido.edit', ['seccion' => 'nosotros'])}}">Contenido</a>
                    </li>
                </ul>
            </li>
            <li>
            <a href="#calidadSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-feather-alt"></i>calidad OK</a>
                <ul class="collapse list-unstyled" id="calidadSubmenu">
                    <li>
                        <a href="{{ route('contenido.edit', ['seccion' => 'calidad'])}}">Contenido</a>
                    </li>
                    <li>
                        <a href="{{ route('archivo.index', ['seccion' => 'calidad'])}}">Archivos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#serviciosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-project-diagram"></i>Servicios</a>
                <ul class="collapse list-unstyled" id="serviciosSubmenu">
                    <li>
                        <a href="{{ route('familia.index')}}">Todos los Servicios</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#prensaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-newspaper"></i>Prensa OK</a>
                <ul class="collapse list-unstyled" id="prensaSubmenu">
                    <li>
                        <a href="{{ route('contenido.edit', ['seccion' => 'prensa'])}}">Contenido</a>
                    </li>
                    <li>
                        <a href="{{ route('archivo.index', ['seccion' => 'prensa'])}}">Archivos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#trabajosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-camera-retro"></i>Portfolio OK</a>
                <ul class="collapse list-unstyled" id="trabajosSubmenu">
                    <li>
                        <a href="{{ route('familia.index')}}">Familia de Trabajos</a>
                    </li>
                    <li>
                        <a href="{{ route('familia.trabajo.index')}}">Todos los Trabajos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#rrhhSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-id-card"></i>RR.HH. OK</a>
                <ul class="collapse list-unstyled" id="rrhhSubmenu">
                    <li>
                        <a href="{{ route('rrhh.index')}}">Listado de trabajos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#clientesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users"></i>Clientes OK</a>
                <ul class="collapse list-unstyled" id="clientesSubmenu">
                    <li>
                        <a href="{{ route('cliente.index')}}">Todos los clientes</a>
                    </li>
                </ul>
            </li>
            <li><hr/></li>
            <li>
                <a href="#clientesUsuariosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-user-shield"></i>Clientes</a>
                <ul class="collapse list-unstyled" id="clientesUsuariosSubmenu">
                    <li>
                        <a href="{{ route('cliente.clientes')}}">Listado de clientes</a>
                    </li>
                </ul>
            </li>
            <li><hr/></li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">IMC</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="{{ route('empresa.index')}}">Datos</a>
                    </li>
                    <li>
                        <a href="{{ route('empresa.metadatos')}}">Metadatos</a>
                    </li>
                    @if(Auth::user()["is_admin"])
                    <li>
                        <a href="{{ route('empresa.usuarios')}}">Usuarios</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('empresa.mis_datos')}}">Usuarios</a>
                    </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="row m-0 position-absolute w-100" style="bottom: 0; left: 0;">
    <div class="col-12 col-md-6 px-0">
        <a href="https://osole.freshdesk.com/support/home" target="_blank" class="btn-gds py-2 btn-block text-uppercase text-center"><i class="fas fa-ticket-alt mr-2"></i>soporte</a>
    </div>
    <div class="col-12 col-md-6 px-0">
        <a href="{{route('adm.logout')}}" class="btn-danger btn-block py-2 text-uppercase text-center"><i class="fas fa-power-off mr-2"></i>Salir</a>
    </div>
</div>