

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light sidebar">
    <!-- TRaigo los datos de la sesion-->

    <?php
        $session = $this->request->getSession();
        $empresa = $session->read('Auth.User.Empresa');
        $user_role = $session->read('Auth.User.role');

    ?>


    <!-- Sidebar -->
    <div class="sidebar" style="position: fixed;">
        <!-- Sidebar user panel (optional) -->

        <nav class="mt-2">


            <label type="text" style="display: none !important;" id="subseccion" attr= <?= "" ?> ></label>
            <ul class="nav nav-pills nav-sidebar flex-column" id="prueba_padre">
                <li class="nav-item">
                    <?=  $this->Html->link(
                        '<i class="nav-icon fas fa-tachometer-alt"></i> Inicio',
                        ['controller' => 'Pages', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false, 'id' => 'nav-icon-inicio']) ?>
                </li>
            </ul>

            <!-- INICIO DE EMPRESA-->
            <?php if($user_role == 'admin') :  ?>

                <?php if(!empty($empresa)) :  ?>
                    <ul class="nav nav-pills nav-sidebar flex-column" id="prueba_padre">
                        <li class="nav-item">
                            <?=  $this->Html->link(
                                '<i class="nav-icon fas fa-building"></i> Inicio Empresa',
                                ['controller' => 'Pages', 'action' => 'indexUser', $empresa->idempresas],
                                ['class' => 'nav-link', 'escape' => false, 'id' => 'nav-icon-inicio_emp']) ?>
                        </li>
                    </ul>
                <?php endif;?>
            <?php endif;?>




            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../../index.html" class="nav-link">
                                <p>Dashboard v1</p>
                            </a>
                        </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

