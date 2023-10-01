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
            <div class="row justify-content-center">
                <div class="col-xl-11 col-md-11 col-sm-11 pt-3">

                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Ventas sin Concretar</h3>
                            <!-- /.card-tools -->

                            <?php if ($role != 'admin'): ?>

                            <div class="card-tools">
                                <?=  $this->Html->link(
                                    '<i class="fas fa-plus"></i> Nueva Venta',
                                    ['controller' => 'VentasTemp', 'action' => 'selectCliente', $id_campaign],
                                    ['class' => 'btn btn-success mr-3', 'escape' => false]) ?>
                            </div>

                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cliente') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Fecha de Inicio') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Fecha de Modificacion') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Subtotal') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos Gral') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Total') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cerrado') ?></th>
                                    <th scope="col" class="actions"><?= __('Productos') ?></th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($ventas_temp_not_finish as $venta): ?>
                                    <tr>

                                        <td class="dt-center font-weight-bold align-middle"><?= h($venta->idventas) ?></td>
                                        <td class="dt-center align-middle"><?= h($venta->cliente->apellido . ' ' . $venta->cliente->nombre) ?></td>
                                        <td class="dt-center align-middle"><?= h($venta->created->format('d-m-Y')) ?></td>
                                        <td class="dt-center align-middle"><?= h($venta->modified->format('d-m-Y')) ?></td>
                                        <td class="dt-center align-middle"><?= h($venta->subtotal) ?></td>
                                        <td class="dt-center align-middle"><?= h($venta->descuentos) ?></td>
                                        <td class="dt-center align-middle"><?= h($venta->descuento_general) ?></td>
                                        <td class="dt-center align-middle"><?= h($venta->total) ?></td>
                                        <td class="dt-center align-middle">
                                                    <span class="badge bg-danger font-size-table-his-price">
                                                        <?= h('No') ?>
                                                    </span>
                                        </td>


                                        <td class="actions" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                ['controller' => 'VentasTemp' ,'action' => 'view', $venta->idventas],
                                                ['class' => 'btn btn-success', 'escape' => false]) ?>

                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                ['controller' => 'Precios' ,'action' => 'edit', $venta->idventas],
                                                ['class' => 'btn btn-warning', 'escape' => false]) ?>


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


