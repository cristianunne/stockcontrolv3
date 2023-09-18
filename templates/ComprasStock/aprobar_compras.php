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

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">


                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Productos de la Compra</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tabladata" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Producto') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Contenido') ?></th>

                                    <th scope="col"><?= $this->Paginator->sort('Cantidad') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Precio ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Total ($)') ?></th>

                                    <th scope="col"><?= $this->Paginator->sort('Observaciones') ?></th>
                                    <th scope="col" class="actions"><?= __('Ver') ?></th>


                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($compras_stock->productos as $producto): ?>
                                    <tr>
                                        <td class="dt-center align-middle font-weight-bold" style="background-color: #71ceff"><?= h('Pedido') ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->name) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->marca) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->content) ?></td>

                                        <td class="dt-center align-middle"><?= h($producto->_joinData->cantidad) ?></td>


                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad) ?></td>

                                        <td class="dt-center align-middle"><?= h($producto->_joinData->descuento_unidad) ?></td>


                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad * $producto->_joinData->cantidad -
                                                ($producto->_joinData->descuento_unidad * $producto->_joinData->cantidad)) ?></td>

                                        <td class="dt-center align-middle"><?= h($producto->_joinData->observaciones) ?></td>

                                        <td class="actions" style="text-align: center">


                                        </td>

                                    </tr>
                                    <tr>
                                        <?php foreach ($empl_compras as $producto_empl): ?>

                                            <?php if($producto_empl->productos_idproductos == $producto->idproductos):  ?>
                                                <td class="dt-center align-middle font-weight-bold" style="background-color: #f5f122"><?= h('Comprado') ?></td>
                                                <td class="dt-center align-middle"><?= h($producto->name) ?></td>
                                                <td class="dt-center align-middle"><?= h($producto->marca) ?></td>
                                                <td class="dt-center align-middle"><?= h($producto->content) ?></td>

                                                <td class="dt-center align-middle" id="<?= h('cantidad_'. $producto->idproductos) ?>">
                                                    <?= h($producto_empl->cantidad) ?></td>

                                                <?php if($producto->_joinData->status == 0):  ?>

                                                    <td class="dt-center align-middle">
                                                        <?= $this->Form->number($producto->idproductos.'precio_unidad', ['class' => 'form-control', 'placeholder' => '',
                                                            'required',
                                                            'attr' => $producto->idproductos,
                                                            'attr2' => 'precio',
                                                            'id' => ('precio_unidad_' . $producto->idproductos),
                                                            'onchange' => 'setTotalByProductoCompras(this)'
                                                        ]) ?>

                                                    </td>
                                                    <td class="dt-center align-middle">

                                                        <?= $this->Form->number($producto->idproductos.'descuento_unidad', ['class' => 'form-control', 'placeholder' => '',
                                                            'required',
                                                            'attr' => $producto->idproductos,
                                                            'attr2' => 'descuento',
                                                            'id' => ('descuento_unidad_' . $producto->idproductos),
                                                            'onchange' => 'setTotalByProductoCompras(this)'
                                                        ]) ?>

                                                    </td>
                                                    <td class="dt-center align-middle">
                                                        <?= $this->Form->number($producto->idproductos.'total', ['class' => 'form-control', 'placeholder' => '',
                                                            'required',
                                                            'readonly',
                                                            'attr' => $producto->idproductos,
                                                            'attr2' => 'total',
                                                            'id' => ('total_' . $producto->idproductos)
                                                        ]) ?>

                                                    </td>
                                                <?php else: ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <?php endif; ?>

                                                <td class="dt-center align-middle"><?= h($producto_empl->observaciones) ?></td>


                                                <?php if($producto->_joinData->status == 0):  ?>
                                                    <td class="actions" style="text-align: center">
                                                        <button class="btn btn-success"
                                                                attr="<?= h($producto_empl->idempleado_comprastock) ?>"
                                                                idcomprastock = "<?= h($compras_stock->idcompras_stock) ?>"
                                                                idproducto = "<?= h($producto->idproductos) ?>"
                                                                idproductos_comprasstock = "<?= h($producto->_joinData->idproductos_comprasstock) ?>"
                                                                onclick="aprobarProductoCompra(this)">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </td>


                                                <?php else: ?>
                                                    <td class="dt-center align-middle font-weight-bold" style="background-color: #2effc1"><?= h('Aceptado') ?></td>

                                                <?php endif; ?>


                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            <div class="pull-left">
                                <?= $this->Html->link("Volver", ['action' => 'view', $id_compra_stock], ['class' => 'btn bg-redrose']) ?>
                            </div>
                        </div>

                    </div>

                </div>


            </div>

        </div>
    </div>

    <?= $this->Html->script('shopping_cart') ?>

</div>
