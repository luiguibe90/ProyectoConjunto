<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="index.php" class="nav-link active">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>
        <li class="nav-header">Gestionar</li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-users red-bg"></i>
                <p>
                    Personas
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="./managTeacher.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Docentes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./managStudent.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Alumnos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./managAspirant.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aspirantes</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-users red-bg"></i>
                <p>
                    Periodo
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="./assignPeriod.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Gestión de Periodo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./assignTeacher.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Asignación Docente</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./assignRegistration.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Matrícula</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./assignLevel.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Niveles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./assignSubject.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Asignaturas</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa fa-users red-bg"></i>
                <p>
                    Infraestructura
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="managCampus.php" class="nav-link">
                        <!--crud sedes-->
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sedes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="managEdifice.php" class="nav-link">
                        <!--crud edificios-->
                        <i class="far fa-circle nav-icon"></i>
                        <p>Edificios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="managClassrooms.php" class="nav-link">
                        <!--crud aulas-->
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aulas</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>