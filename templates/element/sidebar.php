<aside class="main-sidebar sidebar-light-blue">

    <a href="index3.html" class="brand-link">

        <span class="brand-text font-weight-light">Stock Control</span>
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

                            <?php if($role == 'admin'):  ?>
                                <li class="nav-item">
                                    <?=  $this->Html->link(
                                        '<i class="fas fa-calendar-alt nav-icon text-info"></i> Campañas',
                                        ['controller' => 'Campaign', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                                </li>
                            <?php else:?>

                                <li class="nav-item">
                                    <?=  $this->Html->link(
                                        '<i class="fas fa-calendar-alt nav-icon text-info"></i> Campañas',
                                        ['controller' => 'Campaign', 'action' => 'indexUser'], ['class' => 'nav-link', 'escape' => false]) ?>
                                </li>
                            <?php endif;?>

                            <li class="nav-item">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-store nav-icon text-info"></i> Catálogo',
                                    ['controller' => 'Productos', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>

                            <?php if($role == 'admin'):  ?>
                                <li class="nav-item">
                                    <?=  $this->Html->link(
                                        '<i class="fas fa-users nav-icon text-info"></i> Clientes',
                                        ['controller' => 'Clientes', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                                </li>
                            <?php endif;?>


                            <?php if($role == 'admin'):  ?>
                                <li class="nav-item">
                                    <?=  $this->Html->link(
                                        '<i class="fas fa-building nav-icon text-info"></i> Proveedores',
                                        ['controller' => 'Proveedores', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                                </li>
                            <?php endif;?>



                            <li class="nav-item menu-close" id="sidebar_compras">

                                    <a href="#" class="nav-link" id="title-analisis_costos">
                                        <i class="fas fa-shopping-bag nav-icon text-info"></i>
                                        <p>
                                            Compras/Stock
                                            <i class="right fas fa-angle-left text-info"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">

                                        <li class="nav-item">
                                            <?php if($role == 'admin'):  ?>

                                            <?=  $this->Html->link(
                                                '<i class="fas fa-list nav-icon text-info"></i> Compras',
                                                ['controller' => 'ComprasStock', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>

                                            <?php endif;?>

                                            <?php if($role == 'empleado'):  ?>

                                                <?=  $this->Html->link(
                                                    '<i class="fas fa-list nav-icon"></i> Pendientes',
                                                    ['controller' => 'EmpleadoComprasstock', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false,
                                                    'id' => 'nav-icon-analisis_costos-Grupos_costos']) ?>

                                                <?=  $this->Html->link(
                                                    '<i class="fas fa-list-alt nav-icon"></i> Completas',
                                                    ['controller' => 'EmpleadoComprasstock', 'action' => 'index', 1], ['class' => 'nav-link', 'escape' => false,
                                                    'id' => 'nav-icon-analisis_costos-Grupos_costos']) ?>

                                            <?php endif;?>

                                        </li>

                                    </ul>
                                </li>




                            <?php if($role == 'admin'):  ?>
                                <li class="nav-item">
                                    <?=  $this->Html->link(
                                        '<i class="fas fa-clipboard-list nav-icon text-info"></i> Pedidos',
                                        ['controller' => 'Pedidos', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                                </li>
                            <?php endif;?>


                            <?php if($role == 'admin'):  ?>
                                <li class="nav-item">
                                    <?=  $this->Html->link(
                                        '<i class="fas fa-file-invoice-dollar nav-icon text-info"></i> Ventas',
                                        ['controller' => 'Ventas', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                                </li>
                            <?php endif;?>


                            <?php if($role == 'admin'):  ?>
                                <li class="nav-item">
                                    <?=  $this->Html->link(
                                        '<i class="fas fa-dollar-sign nav-icon text-info"></i> Precios',
                                        ['controller' => 'Precios', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
                                </li>
                            <?php endif;?>



                                <li class="nav-item menu-close" id="sidebar_configuracion">

                                    <a href="#" class="nav-link" id="title-analisis_costos">
                                        <i class="fas fa-truck nav-icon text-info"></i>
                                        <p>
                                            Camiones
                                            <i class="right fas fa-angle-left text-info"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">

                                        <li class="nav-item">
                                            <?php if($role == 'admin'):  ?>

                                            <?=  $this->Html->link(
                                                '<i class="fas fa-plus nav-icon"></i> Nuevo',
                                                ['controller' => 'Camiones', 'action' => 'add'], ['class' => 'nav-link', 'escape' => false,
                                                'id' => 'nav-icon-analisis_costos-Inicio']) ?>

                                            <?=  $this->Html->link(
                                                '<i class="fas fa-eye nav-icon"></i> Ver Camiones',
                                                ['controller' => 'Camiones', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false,
                                                'id' => 'nav-icon-analisis_costos-Grupos_costos']) ?>
                                            <?php endif;?>

                                            <?php if($role == 'empleado'):  ?>

                                                <?=  $this->Html->link(
                                                    '<i class="fas fa-eye nav-icon"></i> Ver Camion',
                                                    ['controller' => 'Camiones', 'action' => 'viewUser'], ['class' => 'nav-link', 'escape' => false,
                                                    'id' => 'nav-icon-analisis_costos-Grupos_costos']) ?>
                                            <?php endif;?>

                                        </li>

                                    </ul>
                                </li>





                            <?php if($role == 'admin'):  ?>
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

                            <?php endif;?>

                            <!--<li class="nav-item">
                                <a href="pages/widgets.html" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Widgets
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li>-->

                        </ul>
                    </nav>


</aside>


