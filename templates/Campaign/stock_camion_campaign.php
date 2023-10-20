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
        <div class="container-fluid mt-lg-5 mt-md-5 mt-sm-5 mt-5">

            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">

                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Productos del Camion</h3>

                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <?=  $this->Html->link(
                                    '<i class="fas fa-plus "></i> Nuevo',
                                    ['controller' => 'StockCampaignProducto', 'action' => 'addProductoToCamionCampaign', $idstock_camion_campaign, $id_camion, $idcampaign], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Producto') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Proveedor') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Categoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Subcategoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Stock') ?></th>

                                    <th scope="col" class="actions"><?= __('Ver') ?></th>
                                    <th scope="col" class="actions"><?= __('Acciones') ?></th>

                                    <?php if($role == 'admin'):  ?>
                                        <th scope="col" class="actions"><?= __('Aprobar') ?></th>
                                    <?php endif;?>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($productos->stock_campaign_producto as $prod): ?>
                                    <tr>


                                        <td class="dt-center align-middle">
                                            <img src="data:image/png;base64, <?=h($prod->producto->image)?>" alt="Sin Imagen"
                                                 class="mg-fluid img-responsive rounded product-image-table"/>

                                        </td>


                                        <td class="dt-center align-middle"><?= h($prod->producto->name . ' ' .
                                                $prod->producto->content . '(' . $prod->producto->unidad . ')') ?></td>

                                        <td class="dt-center align-middle"><?= h($prod->producto->marca) ?></td>

                                        <?php if(!empty($prod->producto->proveedore)):  ?>
                                            <td class="dt-center align-middle"><?= h($prod->producto->proveedore->name) ?></td>
                                        <?php else: ?>
                                            <td class="dt-center align-middle text-danger"><?= h('') ?></td>
                                        <?php endif;?>


                                        <td class="dt-center align-middle ">
                                             <span class="center badge" style="<?= h('background-color:'.$prod->producto->category->color) ?> !important">
                                                <?= h($prod->producto->category->name) ?>

                                        </td>
                                        <td class="dt-center align-middle">
                                            <?= h($prod->producto->subcategory->name) ?>

                                        </td>


                                        <?php if(!empty($prod->cantidad)):  ?>
                                            <td class="dt-center align-middle"><?= h($prod->cantidad) ?></td>
                                        <?php else: ?>
                                            <td class="dt-center align-middle text-danger"><?= h('Sin Datos') ?></td>
                                        <?php endif;?>


                                        <td class="actions align-middle" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                ['controller' => 'Productos', 'action' => 'viewConfig', $prod->producto->idproductos], ['class' => 'btn bg-teal', 'escape' => false]) ?>
                                        </td>


                                        <td class="actions align-middle" style="text-align: center">

                                             <?php if(!$prod->status):  ?>

                                                <?php if($role == 'empleado'):  ?>

                                                    <div class="d-flex justify-content-around gap-2">
                                                        <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                            ['controller' => 'StockCampaignProducto', 'action' => 'edit', $prod->idstock_campaign_producto, $prod->producto->idproductos, $idstock_camion_campaign,
                                                                $idcampaign, $prod->producto->stock_producto->stock, $id_camion],
                                                            ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                        <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                            ['controller' => 'StockCampaignProducto', 'action' => 'delete', $prod->idstock_campaign_producto],
                                                            ['confirm' => __('Eliminar {0}?', $prod->producto->name),
                                                                'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>
                                                    </div>
                                                 <?php endif;?>

                                             <?php endif;?>


                                            <?php if($role == 'admin'):  ?>

                                                <div class="d-flex justify-content-around gap-2">
                                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                        ['controller' => 'StockCampaignProducto', 'action' => 'edit', $prod->idstock_campaign_producto, $prod->producto->idproductos, $idstock_camion_campaign,
                                                            $idcampaign, $prod->producto->stock_producto->stock, $id_camion],
                                                        ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                    <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                        ['controller' => 'StockCampaignProducto', 'action' => 'delete', $prod->idstock_campaign_producto],
                                                        ['confirm' => __('Eliminar {0}?', $prod->producto->name),
                                                            'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>
                                                </div>

                                            <?php endif;?>


                                        </td>
                                        <?php if($role == 'admin'):  ?>
                                            <?php if($prod->status == 0):  ?>

                                                <td>

                                                    <div class="d-flex justify-content-around gap-2">

                                                            <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-check', 'aria-hidden' => 'true'])),
                                                                ['controller' => 'StockCampaignProducto', 'action' => 'setStateProducto', $prod->idstock_campaign_producto, 1],
                                                                ['confirm' => __('Aprobar {0}?', $prod->producto->name),
                                                                    'class' => 'btn btn-primary','escape' => false]) ?>

                                                    </div>
                                                </td>
                                            <?php else: ?>

                                                <td>

                                                    <div class="d-flex justify-content-around gap-2">

                                                        <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-times', 'aria-hidden' => 'true'])),
                                                            ['controller' => 'StockCampaignProducto', 'action' => 'setStateProducto', $prod->idstock_campaign_producto, 0],
                                                            ['confirm' => __('Quitar Aprobacion {0}?', $prod->producto->name),
                                                                'class' => 'btn btn-warning','escape' => false]) ?>

                                                    </div>
                                                </td>
                                            <?php endif;?>
                                        <?php endif;?>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="pull-left">
                                <?php if($role == 'admin'):  ?>
                                    <?= $this->Html->link("Volver", ['controller' => 'Campaign', 'action' => 'config',
                                      $idcampaign], ['class' => 'btn bg-redrose']) ?>
                                <?php else: ?>
                                    <?= $this->Html->link("Volver", ['controller' => 'Campaign', 'action' => 'viewUser',
                                        $idcampaign], ['class' => 'btn bg-redrose']) ?>
                                <?php endif;?>
                            </div>

                        </div>

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


