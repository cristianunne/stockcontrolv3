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

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">

                    <div class="card">
                        <div class="card-header bg-teal">
                            <h3 class="card-title text-darkgreen">Información de la Compra:</h3>

                        </div>
                        <div class="card-body" >

                            <table class="table mt-2 table-borderless">
                                <tbody>
                                <tr>
                                    <th class="align-middle w-25" scope="row">Administrador:</th>
                                    <td class="align-middle" id="td_comercio"><?= h($compras_stock->Users->firstname . ' '.
                                            $compras_stock->Users->lastname) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Fecha</th>
                                    <td class="dt-center"><?= h($compras_stock->created->format('d-m-Y')) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Empleado Asignado:</th>

                                    <?php if(isset($compras_stock->UsersComprador)):  ?>
                                        <td class="dt-center align-middle"><?= h($compras_stock->UsersComprador->firstname . ' ' . $compras_stock->UsersComprador->lastname) ?></td>
                                    <?php else:?>
                                        <td></td>
                                    <?php endif; ?>



                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Estado:</th>
                                    <?php if($compras_stock->assign):  ?>
                                        <td class="dt-center align-middle">

                                              <span class="badge status-completed font-size-small">
                                                    <?= h('Asignado') ?>
                                              </span>

                                        </td>
                                    <?php else:?>
                                        <td class="dt-center align-middle">
                                             <span class="badge status-canceled font-size-small">
                                                    <?= h('No Asignado') ?>
                                              </span>
                                        </td>
                                    <?php endif; ?>


                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if($compras_stock->is_closed == 0):  ?>
                        <div class="card">
                            <div class="card-header bg-red">
                                <h3 class="card-title">¿Cerrar Compra?:</h3>
                            </div>

                            <div class="card-body">

                                      <div class="pull-right">
                                        <?= $this->Form->postLink(__($this->Html->tag('span', ' Aceptar', ['class' => 'fas fa-check', 'aria-hidden' => 'true'])),
                                            ['controller' => 'ComprasStock', 'action' => 'cerrarCompra', $compras_stock->idcompras_stock],
                                            ['confirm' => __('¿Desea Cerrar la Compra?',),
                                                'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>
                                    </div>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if($number_compras_update <= 0):  ?>
                        <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title text-darkgreen">Administrar Empleado Comprador</h3>
                        </div>
                        <div class="card-body" >

                            <?= $this->Html->link($this->Html->tag('span', ' Editar', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                ['controller' => 'ComprasStock' ,'action' => 'setEmpleadoComprador', $compras_stock->idcompras_stock],
                                ['class' => 'btn btn-secondary pull-right', 'escape' => false]) ?>

                        </div>
                    </div>

                        <div class="card card-warning ">
                        <div class="card-header">
                            <h3 class="card-title text-darkgreen">Asignar Compra</h3>
                        </div>
                        <div class="card-body" >
                            <?php if(!empty($compras_stock->users_comprador)):  ?>

                                <?php if(!empty($compras_stock->productos)):  ?>


                                        <?php if($compras_stock->assign == 0):  ?>

                                            <?= $this->Form->postLink(__($this->Html->tag('span', ' Asignar', ['class' => 'fas fa-check', 'aria-hidden' => 'true'])),
                                                ['controller' => 'ComprasStock', 'action' => 'setAssign',$compras_stock->idcompras_stock, 1],
                                                ['confirm' => __('Asignar Pedido al Empleado?'),
                                                    'class' => 'btn btn-warning pull-right','escape' => false]) ?>

                                           <?php else: ?>

                                            <?= $this->Form->postLink(__($this->Html->tag('span', ' Quitar Asignación', ['class' => 'fas fa-check', 'aria-hidden' => 'true'])),
                                                ['controller' => 'ComprasStock', 'action' => 'setAssign',$compras_stock->idcompras_stock, 0],
                                                ['confirm' => __('Quitar Asignacion de Compra al Empleado?'),
                                                    'class' => 'btn bg-redrose pull-right','escape' => false]) ?>

                                        <?php endif; ?>

                                <?php else: ?>
                                    <span class="badge status-canceled font-size-small">
                                                    <?= h('No existen Productos') ?>
                                              </span>

                                <?php endif; ?>
                            <?php else: ?>
                                <span class="badge status-canceled font-size-small">
                                                    <?= h('Asigne un Empleado') ?>
                                              </span>
                            <?php endif; ?>



                        </div>
                    </div>
                    <?php endif; ?>

                </div>

                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">

                    <?php if($has_compras_update):  ?>
                        <div class="alert bg-redrose" role="alert" style="display: flow-root;">
                            <h4 class="alert-heading"><i class="fas fa-info-circle nav-icon"></i> Tienes Productos Pendientes</h4>
                            <p>Se han realizados compras de los productos que has asignado, revisa y aprueba para que puedan integrarse al stock.</p>
                            <?= $this->Html->link($this->Html->tag('span', ' Ver Compra', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                ['action' => 'aprobarCompras', $compras_stock->idcompras_stock], ['class' => 'btn btn-warning pull-right', 'escape' => false]) ?>
                        </div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Productos</h3>
                            <!-- /.card-tools -->
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->

                                    <?php if($compras_stock->assign == 0):  ?>

                                        <?=  $this->Html->link(
                                            '<i class="fas fa-plus "></i> Agregar Producto',
                                            ['controller' => 'ComprasStock', 'action' => 'addProductoIndex', $compras_stock->idcompras_stock],
                                            ['class' => 'btn bg-teal', 'escape' => false]) ?>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Producto') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Contenido') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Categoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cantidad Pedido') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cantidad Comprado') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Precio ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Total ($)') ?></th>
                                    <th scope="col" class="actions"><?= __('Ver') ?></th>
                                    <th scope="col" class="actions"><?= __('Compra') ?></th>
                                    <?php if($compras_stock->status):  ?>
                                    <th scope="col" class="actions"><?= __('Stock?') ?></th>
                                    <?php endif; ?>




                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($compras_stock->productos as $producto): ?>
                                    <tr>
                                         <?php if($producto->_joinData->status == 0):  ?>
                                            <td></td>
                                         <?php else: ?>
                                             <td class="dt-center align-middle font-weight-bold" style="background-color: #2effc1"><?= h('Aceptado') ?></td>

                                         <?php endif; ?>
                                        <td class="dt-center align-middle"><?= h($producto->name) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->marca) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->content) ?></td>
                                        <td class="dt-center align-middle">
                                             <span class="center badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                                <?= h($producto->category->name) ?>

                                        </td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->cantidad_pedido) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->cantidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->descuento_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad * $producto->_joinData->cantidad -
                                                ($producto->_joinData->descuento_unidad * $producto->_joinData->cantidad)) ?></td>

                                        <td class="actions" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                ['controller' => 'Productos', 'action' => 'viewConfig', $producto->idproductos], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                        </td>
                                        <td class="dt-center align-middle font-weight-bold">
                                             <?php if($compras_stock->is_closed == 0):  ?>
                                              <?php if($producto->_joinData->status == 1):  ?>
                                                  <?php if($producto->_joinData->is_stock == 0):  ?>

                                                    <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-minus-circle', 'aria-hidden' => 'true'])),
                                                        ['action' => 'desaprobarCompra', $compras_stock->idcompras_stock, $producto->_joinData->idproductos_comprasstock, $producto->idproductos],
                                                        ['confirm' => __('Desaprobar {0}?', $producto->_joinData->idproductos_comprasstock),
                                                            'class' => 'btn btn-danger bg-redrose data-toggle="tooltip" data-placement="top" title="Desaprobar la compra y cambar caracteristicas"','escape' => false]) ?>
                                                  <?php endif; ?>
                                              <?php endif; ?>
                                             <?php endif; ?>
                                        </td>

                                        <?php if($compras_stock->is_closed == 0):  ?>
                                            <?php if($compras_stock->status):  ?>

                                                <?php if($producto->_joinData->status == 1):  ?>

                                                    <?php if($producto->_joinData->is_stock == 0):  ?>

                                                            <td class="actions" style="text-align: center">
                                                            <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-check', 'aria-hidden' => 'true'])),
                                                                ['action' => 'setIsStock', $producto->_joinData->idproductos_comprasstock, $compras_stock->idcompras_stock],
                                                                ['confirm' => __('Asignar a Stock {0}?', $producto->_joinData->idproductos_comprasstock),
                                                                    'class' => 'btn btn-primary data-toggle="tooltip" data-placement="top" title="Asignar el Producto al Stock General"','escape' => false]) ?>
                                                            </td>
                                                    <?php else: ?>

                                                        <td class="actions" style="text-align: center">
                                                            <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-minus-circle', 'aria-hidden' => 'true'])),
                                                                ['action' => 'unSetStock', $producto->_joinData->idproductos_comprasstock, $compras_stock->idcompras_stock],
                                                                ['confirm' => __('Quitar de Stock {0}?', $producto->_joinData->idproductos_comprasstock),
                                                                    'class' => 'btn btn-warning data-toggle="tooltip" data-placement="top" title="Quitar el Producto al Stock General"','escape' => false]) ?>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <td class="dt-center align-middle font-weight-bold"><?= h('') ?></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
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

