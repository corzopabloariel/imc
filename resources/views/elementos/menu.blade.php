<div class="sidebar-header">
    <i class="fas fa-bars"></i>
    <h3 class="m-0">Menu</h3>
</div>
<div class="position-relative" style="height: calc(100% - 73px); overflow-y:auto; overflow-x: hidden;">
    <div class="w-100 position-absolute">
        <ul class="list-unstyled components m-0 p-0">
            <li class="">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-label">Home</span>
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a data-link="u" href="{{ route('contenido.edit', ['seccion' => 'home'])}}">
                            <i class="fas fa-file-contract"></i>
                            <span class="nav-label">Contenido</span>
                        </a>
                    </li>
                    <li>
                        <a data-link="u" href="{{ route('slider.index', ['seccion' => 'home'])}}">
                            <i class="fas fa-spider"></i>
                            <span class="nav-label">Slider</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a data-link="a" href="{{ route('contenido.edit', ['seccion' => 'nosotros'])}}">
                    <i class="fas fa-building"></i>
                    <span class="nav-label">Nosotros</span>
                </a>
            </li>
            <li>
                <a href="#calidadSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-feather-alt"></i>
                    <span class="nav-label">calidad</span>
                </a>
                <ul class="collapse list-unstyled" id="calidadSubmenu">
                    <li>
                        <a data-link="u" href="{{ route('contenido.edit', ['seccion' => 'calidad'])}}">
                            <i class="fas fa-file-contract"></i>
                            <span class="nav-label">Contenido</span>
                        </a>
                    </li>
                    <li>
                        <a data-link="u" href="{{ route('archivo.index', ['seccion' => 'calidad'])}}">
                            <i class="fas fa-file-invoice"></i>
                            <span class="nav-label">Archivos</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a data-link="a" href="{{ route('servicios.index')}}">
                    <i class="fas fa-project-diagram"></i>
                    <span class="nav-label">Servicios</span>
                </a>
            </li>
            <li>
                <a href="#prensaSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-newspaper"></i>
                    <span class="nav-label">Prensa</span>
                </a>
                <ul class="collapse list-unstyled" id="prensaSubmenu">
                    <li>
                        <a data-link="u" href="{{ route('contenido.edit', ['seccion' => 'prensa'])}}">
                            <i class="fas fa-file-contract"></i>
                            <span class="nav-label">Contenido</span>
                        </a>
                    </li>
                    <li>
                        <a data-link="u" href="{{ route('archivo.index', ['seccion' => 'prensa'])}}">
                            <i class="fas fa-file-invoice"></i>
                            <span class="nav-label">Archivos</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#trabajosSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-camera-retro"></i>
                    <span class="nav-label">Portfolio</span>
                </a>
                <ul class="collapse list-unstyled" id="trabajosSubmenu">
                    <li>
                        <a data-link="u" href="{{ route('familia.index')}}">
                            <i class="fas fa-briefcase"></i>
                            <span class="nav-label">Familia de Trabajos</span>
                        </a>
                    </li>
                    <li>
                        <a data-link="u" href="{{ route('familia.trabajo.index')}}">
                            <i class="fas fa-network-wired"></i>
                            <span class="nav-label">Todos los Trabajos</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a data-link="a" href="{{ route('recursos.index')}}">
                    <i class="fas fa-id-card"></i>
                    <span class="nav-label">RR.HH.</span>
                </a>
            </li>
            <li>
                <a data-link="a" href="{{ route('cliente.index')}}">
                    <i class="fas fa-users"></i>
                    <span class="nav-label">Clientes</span>
                </a>
            </li>
            <li>
                <a data-link="a" href="{{ route('cliente.newsletters')}}">
                    <i class="fas fa-rss-square"></i>
                    <span class="nav-label">Newsletter</span>
                </a>
            </li>
            <li><hr/></li>
            <li>
                <a data-link="a" href="{{ route('cliente.clientes')}}">
                    <i class="fas fa-user-shield"></i>
                    <span class="nav-label">Clientes</span>
                </a>
            </li>
            <li><hr/></li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-compass"></i>
                    <span class="nav-label">IMC</span>
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a data-link="u" href="{{ route('empresa.index')}}">
                            <span>Datos</span>
                        </a>
                    </li>
                    <li>
                        <a data-link="u" href="{{ route('empresa.metadatos')}}">
                            <i class="fas fa-bullhorn"></i>
                            <span class="nav-label">Metadatos</span>
                        </a>
                    </li>
                    @if(Auth::user()["is_admin"])
                    <li>
                        <a data-link="u" href="{{ route('empresa.usuarios')}}">
                            <i class="fas fa-users-cog"></i>
                            <span class="nav-label">Usuarios</span>
                        </a>
                    </li>
                    @else
                    <li>
                        <a data-link="u" href="{{ route('empresa.mis_datos')}}">
                            <i class="fas fa-user-cog"></i>
                            <span class="nav-label">Mis datos</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li><hr/></li>
            <li>
                <a href="https://osole.freshdesk.com/support/home" target="_blank">
                <i class="fas fa-ticket-alt"></i>
                    <span class="nav-label">Soporte</span>
                </a>
            </li>
            <li>
                <a class="bg-danger text-white" href="{{route('adm.logout')}}">
                    <i class="fas fa-power-off text-white"></i>
                    <span class="nav-label">Salir</span>
                </a>
            </li>
        </ul>
    </div>
</div>