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

        <div class="p-xxl-4 p-lg-4 p-md-4 p-sm-4 container-fluid mt-lg-4 mt-md-4 mt-sm-4 mt-4">

            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-3">


                    <div class="card">
                        <div class="card-header bg-teal">
                            <h3 class="card-title text-darkgreen">Información de la Venta:</h3>

                        </div>
                        <div class="card-body" >


                            <table class="table mt-2 table-borderless">
                                <tbody>
                                <tr>
                                    <th class="align-middle w-25" scope="row">Vendedor:</th>
                                    <td class="align-middle" id="td_comercio"><?= h($ventas_temp->user->firstname . ' '.
                                            $ventas_temp->user->lastname) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Fecha</th>
                                    <td class="dt-center"><?= h($ventas_temp->created->format('d-m-Y')) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Empleado Asignado:</th>

                                    <?php if(isset($ventas_temp->clientes_idclientes)):  ?>
                                        <td class="dt-center align-middle"><?= h($ventas_temp->clientes_idclientes . ' ' . $ventas_temp->clientes_idclientes) ?></td>
                                    <?php else:?>
                                        <td></td>
                                    <?php endif; ?>



                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Estado:</th>
                                    <?php if($ventas_temp->status):  ?>
                                        <td class="dt-center align-middle">

                                              <span class="badge status-completed font-size-small">
                                                    <?= h('Concretada') ?>
                                              </span>

                                        </td>
                                    <?php else:?>
                                        <td class="dt-center align-middle">
                                             <span class="badge status-canceled font-size-small">
                                                    <?= h('No Concretada') ?>
                                              </span>
                                        </td>
                                    <?php endif; ?>


                                </tr>

                                <tr>
                                    <th class="align-middle w-25" scope="row">Subtotal:</th>
                                    <td id="td_nombre"><?= $ventas_temp->subtotal != null ?
                                            h('$' . number_format($ventas_temp->subtotal, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row">Descuentos:</th>
                                    <td id="td_cantproductos"><?= $ventas_temp->subtotal != null ?
                                            h('$' . number_format($ventas_temp->descuentos, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row">Descuentos General:</th>
                                    <td id="td_cantproductos"><?= $ventas_temp->descuento_general != null ?
                                            h('$' . number_format($ventas_temp->descuento_general, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row">Total:</th>
                                    <td id="td_cantproductos"><?= $ventas_temp->subtotal != null ?
                                            h('$' . number_format($ventas_temp->total, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>

                                <?php if($ventas_temp->status):  ?>



                                <?php endif;?>

                                </tbody>
                            </table>
                        </div>
                        <?php if($ventas_temp->status):  ?>
                            <div class="card-footer">
                                <?= $this->Html->link("Volver", ['controller' => 'Campaign', 'action' => 'viewUser', $id_campaign], ['class' => 'btn bg-redrose']) ?>
                            </div>
                        <?php endif;?>
                    </div>

                    <?php if(!$ventas_temp->status):  ?>
                        <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title text-darkgreen">Descuento General</h3>
                        </div>
                        <div class="card-body" >

                            <?= $this->Html->link($this->Html->tag('span', ' Descuento', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                ['controller' => 'VentasTemp' ,'action' => 'setDescuentoGeneral', $id_venta_temp],
                                ['class' => 'btn btn-danger pull-right', 'escape' => false]) ?>


                        </div>
                    </div>


                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title text-darkgreen">Realizar Venta</h3>
                            </div>
                            <div class="card-body" >

                                    <?php if($cant_productos > 0):  ?>
                                        <?= $this->Form->postLink(__($this->Html->tag('span', ' Vender', ['class' => 'fas fa-check', 'aria-hidden' => 'true'])),
                                            ['controller' => 'Ventas', 'action' => 'addByVentaTemp', $id_venta_temp],
                                            ['confirm' => __('Concretar Venta?'), 'class' => 'btn btn-warning pull-right','escape' => false]) ?>
                                    <?php else: ?>
                                        <td class="dt-center align-middle text-danger"><?= h('Agregue Productos al Pedido') ?></td>
                                    <?php endif;?>

                            </div>
                        </div>

                    <?php endif;?>

                </div>

                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">


                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Productos</h3>
                            <!-- /.card-tools -->
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <?php if(!$ventas_temp->status):  ?>

                                    <?=  $this->Html->link(
                                        '<i class="fas fa-plus "></i> Agregar Producto',
                                        ['controller' => 'VentasTemp', 'action' => 'selectProductos', $ventas_temp->idventas],
                                        ['class' => 'btn bg-teal', 'escape' => false]) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('Producto') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Contenido') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Categoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cantidad') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Precio ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Total ($)') ?></th>
                                    <?php if(!$ventas_temp->status):  ?>

                                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                                    <?php endif; ?>



                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($ventas_temp->productos as $producto): ?>
                                    <tr>
                                        <td class="dt-center align-middle"><?= h($producto->name) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->marca) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->content) ?></td>
                                        <td class="dt-center align-middle">
                                             <span class="center badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                                <?= h($producto->category->name) ?>

                                        </td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->cantidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->descuento_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad * $producto->_joinData->cantidad -
                                                ($producto->_joinData->descuento_unidad * $producto->_joinData->cantidad)) ?></td>

                                        <?php if(!$ventas_temp->status):  ?>
                                        <td class="actions" style="text-align: center">
                                            <div class="d-flex justify-content-around gap-1">
                                                <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                    ['controller' => 'ProductosVentasTemp' ,'action' => 'edit', $producto->_joinData->idproductos_ventas_temp],
                                                    ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                    ['controller' => 'ProductosVentasTemp', 'action' => 'delete', $producto->_joinData->idproductos_ventas_temp, $ventas_temp->idventas],
                                                    ['confirm' => __('Eliminar {0}?', $producto->name), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>
                                            </div>
                                        </td>
                                        <?php endif; ?>


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

