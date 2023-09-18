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
        <div class="p-xxl-5 p-lg-5 p-md-5 p-sm-5 container-fluid mt-lg-4 mt-md-4 mt-sm-4 mt-4">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title" style="position: absolute; top: 50%;;">Ventas</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <?=  $this->Html->link(
                            '<i class="fas fa-plus "></i> Nuevo',
                            ['controller' => 'Productos', 'action' => 'index'], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="tabladata" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('Numero') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Cliente') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Subtotal') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Descuentos') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Descuentos General') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Total') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('N° Productos') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Vendedor') ?></th>
                            <th scope="col" class="actions"><?= __('Ver') ?></th>
                            <th scope="col" class="actions"><?= __('Acciones') ?></th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($ventas as $venta): ?>
                            <tr>

                                <td class="dt-center align-middle"><?= h($venta->number) ?></td>

                                <td class="dt-center align-middle"><?= h($venta->created) ?></td>
                                <td class="dt-center align-middle"><?= h($venta->cliente->shop_name) ?></td>

                                <td class="dt-center align-middle"><?= h($venta->subtotal) ?></td>
                                <td class="dt-center align-middle"><?= h($venta->descuentos) ?></td>
                                <td class="dt-center align-middle"><?= h($venta->descuento_general) ?></td>
                                <td class="dt-center align-middle"><?= h($venta->total) ?></td>

                                <td class="dt-center align-middle">
                                    <?php if(!empty($venta->productos)):  ?>
                                        <?= h(count($venta->productos)) ?>
                                    <?php else: ?>
                                        <?= h('') ?>
                                    <?php endif;?>

                                </td>

                                <td class="dt-center align-middle"><?= h($venta->user->firstname . ' ' . $venta->user->lastname) ?></td>

                                <td class="actions" style="text-align: center">
                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                        ['action' => 'view', $venta->idventas], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </td>

                                <td class="actions" style="text-align: center">
                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                        ['action' => 'edit', $venta->idventas], ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                    <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                        ['action' => 'delete', $venta->idventas],
                                        ['confirm' => __('Eliminar {0}?', $venta->idventas), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
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


