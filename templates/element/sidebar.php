<aside class="main-sidebar sidebar-light-blue">

    <a href="index3.html" class="brand-link">

        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"
    style="margin-top: 50px;">

  <div class="os-padding">
        <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: auto;">
            <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">

                    <nav class="mt-2" style="margin-top: 20px;">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                            <li class="nav-item">

                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-home text-info"></i>
                                    <p>Inicio</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-store nav-icon text-info"></i> Catálogo',
                                    ['controller' => 'Productos', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>

                            <li class="nav-item">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-users nav-icon text-info"></i> Clientes',
                                    ['controller' => 'Clientes', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>

                            <li class="nav-item menu-close" id="sidebar_configuracion">

                                <a href="#" class="nav-link" id="title-analisis_costos">
                                    <i class="fas fa-cog nav-icon text-info"></i>
                                    <p>
                                        Configuración
                                        <i class="right fas fa-angle-left text-info"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">

                                    <li class="nav-item">

                                        <?=  $this->Html->link(
                                            '<i class="fas fa-list nav-icon"></i> Categorias',
                                            ['controller' => 'Categories', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false,
                                            'id' => 'nav-icon-analisis_costos-Inicio']) ?>

                                        <?=  $this->Html->link(
                                            '<i class="fas fa-list-alt nav-icon"></i> Sub Categorias',
                                            ['controller' => 'Subcategories', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false,
                                            'id' => 'nav-icon-analisis_costos-Grupos_costos']) ?>

                                    </li>

                                </ul>
                            </li>


                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Inicio
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                    <li class="nav-item">
                                        <a href="./index.html" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v1</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./index2.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v2</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./index3.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v3</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="pages/widgets.html" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Widgets
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p>Informational</p>
                                </a>
                            </li>
                        </ul>
                    </nav>


</aside>


