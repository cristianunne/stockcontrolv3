
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
                    <h3 class="card-title" style="position: absolute; top: 50%;;">Lista de Pedidos</h3>
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

                            <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Numero') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Cliente') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Subtotal') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Descuentos') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Descuentos General') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Total') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('N° Productos') ?></th>
                            <th scope="col" class="actions"><?= __('Ver') ?></th>
                            <th scope="col" class="actions"><?= __('Acciones') ?></th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($pedidos as $ped): ?>
                            <tr>

                                <?php if($ped->status == \App\Utility\PedidosStatusEnum::ORDER):  ?>
                                    <td class="dt-center align-middle font-weight-bold" style="background-color: #71ceff"><?= h($ped->status) ?></td>
                                <?php elseif ($ped->status == \App\Utility\PedidosStatusEnum::PROCESSING): ?>
                                    <td class="dt-center align-middle font-weight-bold" style="background-color: #f5f122"><?= h($ped->status) ?></td>
                                <?php elseif ($ped->status == \App\Utility\PedidosStatusEnum::COMPLETED): ?>
                                    <td class="dt-center align-middle font-weight-bold" style="background-color: #2effc1"><?= h($ped->status) ?></td>
                                <?php elseif ($ped->status == \App\Utility\PedidosStatusEnum::CANCEL): ?>
                                    <td class="dt-center align-middle font-weight-bold" style="background-color: #ff5858"><?= h($ped->status) ?></td>
                                <?php else: ?>
                                    <td class="dt-center align-middle font-weight-bold"><?= h('Sin Estado') ?></td>
                                <?php endif;?>


                                <td class="dt-center align-middle"><?= h($ped->number) ?></td>

                                <td class="dt-center align-middle"><?= h($ped->created) ?></td>
                                <td class="dt-center align-middle"><?= h($ped->cliente->shop_name) ?></td>

                                <td class="dt-center align-middle"><?= h($ped->subtotal) ?></td>
                                <td class="dt-center align-middle"><?= h($ped->descuentos) ?></td>
                                <td class="dt-center align-middle"><?= h($ped->descuento_general) ?></td>
                                <td class="dt-center align-middle"><?= h($ped->total) ?></td>

                                <td class="dt-center align-middle">
                                     <?php if(!empty($ped->productos)):  ?>
                                        <?= h(count($ped->productos)) ?>
                                     <?php else: ?>
                                         <?= h('') ?>
                                     <?php endif;?>

                                </td>

                                <td class="actions" style="text-align: center">
                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                        ['action' => 'view', $ped->idpedidos], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </td>

                                <td class="actions" style="text-align: center">
                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                        ['action' => 'edit', $ped->idpedidos], ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                    <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                        ['action' => 'delete', $ped->idpedidos],
                                        ['confirm' => __('Eliminar {0}?', $ped->idpedidos), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>

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
            dom: 'Bfrtip',
            buttons: [
                'print'
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });
    })
</script>

