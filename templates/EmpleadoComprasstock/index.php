
<!-- DataTables -->
<?= $this->Html->css('../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>

<?php

echo $this->element('header');
echo $this->element('sidebar');

?>

<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container-fluid mt-lg-5">

            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
                    <div class="alert bg-text-info" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-store nav-icon"></i> Compras/Stock</h4>
                        <p>En esta sección puedes visualizar todos las Solicitudes de Compras de Marcaderías.</p>
                    </div>

                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Compras Pendientes</h3>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Fecha de Pedido') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Fecha de Modificación') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descripcion') ?></th>
                                    <th scope="col" class="actions"><?= __('Ver') ?></th>
                                    <th scope="col" class="actions"><?= __('Acciones') ?></th>


                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($compras_stock as $compras): ?>
                                    <tr>
                                        <td class="dt-center align-middle"><?= h($compras->idcompras_stock) ?></td>

                                        <td class="dt-center align-middle"><?= h($compras->created) ?></td>
                                        <td class="dt-center align-middle"><?= h($compras->modified) ?></td>

                                        <td class="dt-center align-middle"><?= h($compras->descripcion) ?></td>


                                        <td class="actions align-middle" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                ['action' => 'view', $compras->idcompras_stock], ['class' => 'btn bg-teal', 'escape' => false]) ?>
                                        </td>

                                        <td class="actions align-middle" style="text-align: center">
                                            <div class="d-flex justify-content-around gap-2">
                                                <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                    ['controller' => 'Productos' ,'action' => 'edit', $compras->idcompras_stock],
                                                    ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                    ['controller' => 'Productos', 'action' => 'delete', $compras->idcompras_stock],
                                                    ['confirm' => __('Eliminar {0}?', $compras->idcompras_stock),
                                                        'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>
                                            </div>
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
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });
    })
</script>


