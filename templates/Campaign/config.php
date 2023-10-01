
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
                <div class="col-md-5 p-5 pt-3">
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
                                    <div class="col-md-3 mt-1">
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
                                        <br>

                                        <?php if ($campaign->status): ?>

                                            <div class="d-flex justify-content-end col-xl-12 col-md-12 col-sm-12 border-left mt-1">

                                                    <?=  $this->Html->link(
                                                        '<i class="fas fa-times"></i> Cerrar Campaña',
                                                        ['controller' => 'Campaign', 'action' => 'setStateCampaign', $campaign->idcampaign, 0],
                                                        ['class' => 'btn btn-danger', 'escape' => false]) ?>

                                            </div>

                                        <?php else: ?>

                                            <div class="d-flex justify-content-end col-xl-12 col-md-12 col-sm-12 border-left mt-1">

                                                <?=  $this->Html->link(
                                                    '<i class="fas fa-check"></i> Activar Campaña',
                                                    ['controller' => 'Campaign', 'action' => 'setStateCampaign', $campaign->idcampaign, 1],
                                                    ['class' => 'btn btn-success', 'escape' => false]) ?>

                                            </div>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="pull-left">
                                <?= $this->Html->link("Volver", ['controller' => 'Campaign', 'action' => 'index'], ['class' => 'btn bg-redrose']) ?>
                            </div>

                            <div class="pull-right">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-search"></i> Ver',
                                    ['controller' => 'Campaign', 'action' => 'viewAdmin', $campaign->idcampaign],
                                    ['class' => 'btn btn-warning', 'escape' => false]) ?>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="col-md-7 p-5 pt-3">

                    <div class="card card-default">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Camiones</h3>
                            <?php if ($campaign->status): ?>
                            <div class="card-tools">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-plus"></i> Agregar',
                                    ['controller' => 'campaign', 'action' => 'addCamionToCampaign', $campaign->idcampaign],
                                    ['class' => 'btn btn-success mr-3', 'escape' => false]) ?>
                            </div>
                            <?php endif; ?>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <?php foreach ($campaign->stock_camion_campaign as $camion): ?>
                                <div class="col-md-4">
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
                                            <?php if ($campaign->status): ?>
                                            <div class="center">
                                                <?=  $this->Html->link(
                                                    '<i class="fas fa-list"></i> Stock',
                                                    ['controller' => 'Campaign', 'action' => 'stockCamionCampaign', $camion->idstock_camion_campaign,
                                                        $camion->camione->idcamiones, $campaign->idcampaign],
                                                    ['class' => 'btn btn-block btn-primary', 'escape' => false]) ?>
                                            </div>
                                            <?php endif; ?>

                                    </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                    </div>

                </div>

            </div>


        </div>
    </div>

    <?= $this->Html->script('shopping_cart.js') ?>

</div>

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

