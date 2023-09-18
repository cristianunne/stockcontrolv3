
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

                                    </div>
                                    <div class="align-items-center align-content-center col-xl-3 col-md-3 col-sm-3 border-left mt-1">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="pull-right">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-search"></i> Ver',
                                    ['controller' => 'Precios', 'action' => 'add', null],
                                    ['class' => 'btn btn-warning', 'escape' => false]) ?>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="col-xl-12 col-md-12 col-sm-12 p-2 pt-2">
                    <div>
                        <div class="card" style="min-height: 670px;">
                            <div class="card-header" style="position: relative;">
                                <h3 class="card-title">Historial de Campañas</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tabladata" class="table table-bordered table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Número') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Fecha de Inicio') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Fecha de Fin') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Descripción') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Activo') ?></th>
                                        <th scope="col" class="actions"><?= __('Ver') ?></th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($campaign_finish as $camp): ?>
                                        <tr>

                                            <td class="dt-center font-weight-bold align-middle"><?= h($camp->idcampaign) ?></td>
                                            <td class="dt-center font-weight-bold align-middle"><?= h($camp->number) ?></td>
                                            <td class="dt-center align-middle"><?= h($camp->fecha_inicio->format('d-m-Y')) ?></td>
                                            <td class="dt-center align-middle"><?= h($camp->fecha_fin->format('d-m-Y')) ?></td>
                                            <td class="dt-center font-weight-bold align-middle"><?= h($camp->descripcion) ?></td>
                                            <td class="dt-center align-middle">
                                                    <span class="badge bg-danger font-size-table-his-price">
                                                        <?= h('No') ?>
                                                    </span>
                                            </td>


                                            <td class="actions" style="text-align: center">
                                                <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                    ['controller' => 'Precios' ,'action' => 'edit', $camp->idcampaign],
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
