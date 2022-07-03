<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://vemto.app/favicon.png" alt="Vemto Logo" class="brand-image bg-white img-circle">
        <span class="brand-text font-weight-light">futura</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-apps"></i>
                        <p>
                            Apps
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            @can('view-any', App\Models\Country::class)
                            <li class="nav-item">
                                <a href="{{ route('countries.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Países</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\City::class)
                            <li class="nav-item">
                                <a href="{{ route('cities.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Ciudades</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Department::class)
                            <li class="nav-item">
                                <a href="{{ route('departments.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Departamentos</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\AcademicLevel::class)
                            <li class="nav-item">
                                <a href="{{ route('academic-levels.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Niveles Académicos</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\AcademicProgram::class)
                            <li class="nav-item">
                                <a href="{{ route('academic-programs.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Programas Académicos</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Academy::class)
                            <li class="nav-item">
                                <a href="{{ route('academies.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Academia</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Agreement::class)
                            <li class="nav-item">
                                <a href="{{ route('agreements.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Convenios</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\BasicCore::class)
                            <li class="nav-item">
                                <a href="{{ route('basic-cores.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Núcleos Básicos de Conocimiento</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Benefit::class)
                            <li class="nav-item">
                                <a href="{{ route('benefits.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Beneficios</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Comment::class)
                            <li class="nav-item">
                                <a href="{{ route('comments.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Comentarios</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Internalization::class)
                            <li class="nav-item">
                                <a href="{{ route('internalizations.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Internacionalización</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\EducationLevel::class)
                            <li class="nav-item">
                                <a href="{{ route('education-levels.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Niveles de Formación</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\KnowledgeArea::class)
                            <li class="nav-item">
                                <a href="{{ route('knowledge-areas.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Áreas de Conocimiento</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\LifeStyle::class)
                            <li class="nav-item">
                                <a href="{{ route('life-styles.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Estilos de Vida</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\MediaType::class)
                            <li class="nav-item">
                                <a href="{{ route('media-types.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Tipos De Multimedia</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Modality::class)
                            <li class="nav-item">
                                <a href="{{ route('modalities.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Modalidades</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Prestige::class)
                            <li class="nav-item">
                                <a href="{{ route('prestiges.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Prestigio</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Campus::class)
                            <li class="nav-item">
                                <a href="{{ route('campuses.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Campus Universitario</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Economy::class)
                            <li class="nav-item">
                                <a href="{{ route('economies.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Presupuesto</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Rectoria::class)
                            <li class="nav-item">
                                <a href="{{ route('rectorias.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Rectorías</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Requeriment::class)
                            <li class="nav-item">
                                <a href="{{ route('requeriments.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Requisitos</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Student::class)
                            <li class="nav-item">
                                <a href="{{ route('students.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Estudiantes</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\User::class)
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Wellness::class)
                            <li class="nav-item">
                                <a href="{{ route('wellnesses.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Bienestar</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Zone::class)
                            <li class="nav-item">
                                <a href="{{ route('zones.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Dimensión Zonas</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Media::class)
                            <li class="nav-item">
                                <a href="{{ route('all-media.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Multimedias</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Beca::class)
                            <li class="nav-item">
                                <a href="{{ route('becas.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Becas</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Bond::class)
                            <li class="nav-item">
                                <a href="{{ route('bonds.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Bonos</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Convenio::class)
                            <li class="nav-item">
                                <a href="{{ route('convenios.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Convenios Universidades</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\University::class)
                            <li class="nav-item">
                                <a href="{{ route('universities.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Universidades</p>
                                </a>
                            </li>
                            @endcan
                    </ul>
                </li>

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-key"></i>
                        <p>
                            Access Management
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endauth

                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1//index.html" target="_blank" class="nav-link">
                        <i class="nav-icon icon ion-md-help-circle-outline"></i>
                        <p>Docs</p>
                    </a>
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>