<!-- DataTables -->
<?= $this->Html->css('../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>

<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container-fluid mt-lg-5">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pl-5 pt-3">
                        <div class="card card-warning">
                            <div class="card-header" style="position: relative;">
                                <h3 class="card-title">Campaña Activa</h3>
                                <div class="card-tools">
                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                    <!-- Here is a label for example -->
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="row p-2 bg-white border rounded">
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1">
                                            <?php echo $this->Html->image('campaign.png', ["alt" => 'Image' , "class" => 'img-fluid img-responsive rounded product-image']) ?>

                                        </div>
                                        <div class="col-md-9 mt-1">
                                            <div class="d-flex flex-row">
                                                <div class="mt-1 mb-1 spec-1"><span class="text-bold">Número de Campaña:</span><span class="dot"></span>

                                                    <span>
                                                 <?= h($campaign['number']) ?>

                                            <span class="dot"></span></div>

                                            </div>

                                            <div class="mt-1 mb-1 spec-1">
                                                <span class="text-bold">Fecha de Inicio: </span>
                                                <span>
                                           <?= h($campaign->fecha_inicio->format('d-m-Y')) ?>
                                        </span>
                                            </div>

                                            <div class="mt-1 mb-1 spec-1">
                                                <span class="text-bold">Fecha de Finalización: </span>
                                                <span>
                                            <?= h($campaign->fecha_fin->format('d-m-Y')) ?>
                                        </span>
                                            </div>

                                        </div>
                                        <div class="align-items-center align-content-center col-xl-3 col-md-3 col-sm-3 border-left mt-1">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="pull-left">
                                    <?=  $this->Html->link(
                                        'Volver',
                                        ['controller' => 'Campaign', 'action' => 'config', $campaign->idcampaign],
                                        ['class' => 'btn btn-danger mr-3', 'escape' => false]) ?>
                                </div>

                            </div>

                        </div>

                </div>

                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-3">
                    <row class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-secondary">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['subtotal'],2,",",".")) ?></h4>
                                    <p style="margin-right: 50%;">Subtotal (Efectivo)</p>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-yellow">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['descuentos'],2,",",".")) ?></h4>

                                    <p style="margin-right: 55px;">Descuentos (Efectivo)</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['descuentos_general'],2,",",".")) ?></h4>

                                    <p style="margin-right: 55px;">Descuentos Generales (Efectivo)</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-cyan">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['cuenta_corriente'],2,",",".")) ?></h4>
                                    <p style="margin-right: 55px;">Total (Cuenta Corriente)</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-yellow">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['descuentos_cuenta_corriente'],2,",",".")) ?></h4>
                                    <p style="margin-right: 55px;">Descuentos (Cuenta Corriente)</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['descuento_genera_cuenta_corriente'],2,",",".")) ?></h4>

                                    <p style="margin-right: 55px;">Descuentos Generales (Cuenta Corriente)</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-teal">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['total_efectivo'],2,",",".")) ?></h4>
                                    <p style="margin-right: 55px;">Total Efectivo</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-teal">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['subtotal_general'],2,",",".")) ?></h4>
                                    <p style="margin-right: 55px;">Subtotal General</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h4><sup style="font-size: 20px">$ </sup><?= h(number_format($resultados['total'],2,",",".")) ?></h4>
                                    <p style="margin-right: 55px;">Total General</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </row>
                </div>

            </div>

            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pl-5 pt-3">
                    <div class="card card-default">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Camiones</h3>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($campaign->stock_camion_campaign as $camion): ?>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center d-flex justify-content-center">
                                                    <div class="col-md-3 mt-1 ju">
                                                        <?php echo $this->Html->image('camion.png', ["alt" => 'Image' , "class" => 'img-fluid img-responsive rounded product-image']) ?>
                                                    </div>

                                                </div>
                                                <h3 class="profile-username text-center"><?= h($camion->camione->nombre) ?> </h3>
                                                <p class="text-muted text-center"><?= h($camion->camione->marca) ?></p>
                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>Chofer: </b> <a class=""><?= h($camion->user->firstname . ' ' . $camion->user->lastname) ?></a>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <b>Matricula: </b> <a class=""><?= h($camion->camione->matricula) ?></a>
                                                    </li>

                                                </ul>
                                                <div class="center">
                                                    <?=  $this->Html->link(
                                                        '<i class="fas fa-list"></i> Stock',
                                                        ['controller' => 'Campaign', 'action' => 'stockCamionCampaign', $camion->idstock_camion_campaign,
                                                            $camion->camione->idcamiones, $campaign->idcampaign],
                                                        ['class' => 'btn btn-block btn-primary', 'escape' => false]) ?>
                                                </div>
                                                <br>
                                                <div class="center">
                                                    <?=  $this->Html->link(
                                                        '<i class="fas fa-eye"></i> Ver Ventas',
                                                        ['controller' => 'Campaign', 'action' => 'viewVentasByCamion', $campaign->idcampaign,
                                                            $camion->camione->idcamiones],
                                                        ['class' => 'btn btn-block btn-success', 'escape' => false]) ?>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>

                    <div class="card card-danger">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Ventas sin Concretar</h3>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div class="pull-right">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-search"></i> Ventas',
                                    ['controller' => 'VentasTemp', 'action' => 'viewVentasNotFinish', $campaign->idcampaign],
                                    ['class' => 'btn btn-danger mr-3', 'escape' => false]) ?>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-9 col-md-9 col-sm-9 pt-3">
                    <div class="card" style="min-height: 670px;">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Ventas</h3>
                            <!-- /.card-tools -->

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('N°') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Vendedor') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cliente') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Subtotal') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Total') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuento Gral') ?></th>
                                    <th scope="col" class="actions"><?= __('Ver') ?></th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($campaign->ventas as $ventas): ?>
                                    <tr>

                                        <td class="dt-center font-weight-bold align-middle"><?= h($ventas->idventas) ?></td>
                                        <td class="dt-center align-middle"><?= h($ventas->user->firstname . ' ' . $ventas->user->lastname) ?></td>
                                        <td class="dt-center align-middle"><?= h($ventas->cliente->apellido . ' ' . $ventas->cliente->nombre) ?></td>
                                        <td class="dt-center align-middle"><?= h($ventas->created->format('d-m-Y')) ?></td>
                                        <td class="dt-center align-middle"><?= h($ventas->subtotal) ?></td>
                                        <td class="dt-center align-middle"><?= h($ventas->descuentos) ?></td>
                                        <td class="dt-center align-middle"><?= h($ventas->total) ?></td>
                                        <td class="dt-center align-middle"><?= h($ventas->descuento_general) ?></td>

                                        <td class="actions" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                ['controller' => 'Ventas' ,'action' => 'view', $ventas->idventas],
                                                ['class' => 'btn btn-success', 'escape' => false]) ?>


                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?= $this->Html->script('shopping_cart.js') ?>


<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>
<?= $this->Html->script('../plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>
<?= $this->Html->script('../plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.html5.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.print.min.js') ?>
<?= $this->Html->script('../plugins/datatables-buttons/js/buttons.colVis.min.js') ?>
<?= $this->Html->script('shopping_cart.js') ?>


<script>
    $(function () {
        $('#tabladata').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "pageLength": 10,
            order: [[2, 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });

    })
</script>

