
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
                        <div class="card-header bg-text-info text-darkbluestock">
                            <h3 class="card-title">Información de la Venta:</h3>
                        </div>
                        <div class="card-body" >


                            <table class="table mt-1 table-borderless">
                                <tbody>
                                <tr>
                                    <th class="align-middle w-25" scope="row" >Número de Venta:</th>
                                    <td id="td_comercio" class="align-middle"><?= h($ventas->number) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" >Vendedor:</th>
                                    <td  id="td_apellido">


                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" >Fecha:</th>
                                    <td id="td_nombre"><?= h($ventas->created->format('d-m-Y')) ?></td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: middle;" scope="row">Código:</th>
                                    <td id="td_direccion" style="max-width: 3rem;"><?= h($ventas->hash) ?></td>
                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row" >Cantidad de Productos:</th>
                                    <td class="align-middle" id="td_cantproductos">

                                         <span class="badge bg-light text-black" style="font-size: 16px; color: black;">
                                                    <?= h($cant_productos) ?>
                                              </span></td>
                                </tr>

                                </tbody>
                            </table>
                            <hr class="border border-2 opacity-50">


                            <table class="table mt-1 table-borderless">
                                <tbody>

                                <tr>
                                    <th class="align-middle w-25" scope="row">Subtotal:</th>
                                    <td id="td_nombre"><?= $totales->subtotal != null ?
                                            h('$' . number_format($totales->subtotal, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row">Descuentos:</th>
                                    <td id="td_cantproductos"><?= $totales->subtotal != null ?
                                            h('$' . number_format($totales->total_descuento, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>


                                <tr>
                                    <th class="align-middle" scope="row">Descuentos General:</th>
                                    <td id="td_cantproductos"><?= $ventas->descuento_general != null ?
                                            h('$' . number_format($ventas->descuento_general, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>

                                <tr>
                                    <th class="align-middle" scope="row">Total:</th>
                                    <td id="td_cantproductos"><?= $totales->subtotal != null ?
                                            h('$' . number_format($ventas->total, 2, ',', '.')
                                            ) : h('$' . '0') ?></td>
                                </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-teal">
                            <h3 class="card-title text-darkgreen">Información del Cliente:</h3>
                        </div>
                        <div class="card-body" >

                            <table class="table mt-2 table-borderless">
                                <tbody>
                                <tr>
                                    <th class="align-middle w-25" scope="row">Comercio:</th>
                                    <td class="align-middle" id="td_comercio"><?= h($ventas->cliente->shop_name) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Apellido</th>
                                    <td class="align-middle" id="td_apellido"><?= h($ventas->cliente->apellido) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Nombre:</th>
                                    <td class="align-middle" id="td_nombre"><?= h($ventas->cliente->nombre) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Dirección:</th>
                                    <td class="align-middle" id="td_direccion"><?= h($ventas->cliente->direccion . ' ' . h($ventas->cliente->altura)) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Teléfono/Celular:</th>
                                    <td class="align-middle" id="td_telefono"><?= h($ventas->cliente->telefono) ?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" class="w-25">Localidad:</th>
                                    <td class="align-middle" id="td_localidad"><?= h($ventas->cliente->localidad . ' (' . h($ventas->cliente->provincia) . ')') ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Productos</h3>
                            <!-- /.card-tools -->
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
                                    <th scope="col"><?= $this->Paginator->sort('Subcategoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cantidad') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Precio ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Total ($)') ?></th>
                                    <th scope="col" class="actions"><?= __('Ver') ?></th>
                                    <th scope="col" class="actions"><?= __('Acciones') ?></th>


                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($ventas->productos as $producto): ?>
                                    <tr>
                                        <td class="dt-center align-middle"><?= h($producto->name) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->marca) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->content) ?></td>
                                        <td class="dt-center align-middle">
                                             <span class="center badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                                <?= h($producto->category->name) ?>

                                        </td>
                                        <td class="dt-center align-middle">
                                            <?= h($producto->subcategory->name) ?>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->cantidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->descuento_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad * $producto->_joinData->cantidad -
                                                ($producto->_joinData->descuento_unidad * $producto->_joinData->cantidad)) ?></td>

                                        <td class="actions" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                ['action' => 'view', $producto->idproductos], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                        </td>


                                        <td class="actions" style="text-align: center">

                                            <?php if($role == 'admin'): ?>


                                                <div class="d-flex justify-content-around gap-2">
                                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                        ['controller' => 'ProductosPedidos' ,'action' => 'edit', $producto->_joinData->pedidos_idpedidos,
                                                            $producto->_joinData->idproductos_pedidos,
                                                            $producto->name  . ' - ' .  $producto->marca . ' (' . $producto->content. ')'],
                                                        ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                    <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                        ['controller' => 'ProductosPedidos', 'action' => 'delete', $producto->_joinData->pedidos_idpedidos, $producto->_joinData->idproductos_pedidos],
                                                        ['confirm' => __('Eliminar {0}?', $producto->_joinData->idproductos_pedidos), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>
                                                </div>
                                             <?php endif; ?>
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

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-warning">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Devoluciones</h3>
                            <!-- /.card-tools -->
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
                                    <th scope="col"><?= $this->Paginator->sort('Subcategoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Cantidad') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Devolución ($)') ?></th>
                                    <th scope="col" class="actions"><?= __('Acciones') ?></th>


                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($ventas->productos as $producto): ?>
                                    <tr>
                                        <td class="dt-center align-middle"><?= h($producto->name) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->marca) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->content) ?></td>
                                        <td class="dt-center align-middle">
                                             <span class="center badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                                <?= h($producto->category->name) ?>

                                        </td>
                                        <td class="dt-center align-middle"><?= h($producto->subcategory->name) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->cantidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->descuento_unidad) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->_joinData->precio_unidad * $producto->_joinData->cantidad -
                                                ($producto->_joinData->descuento_unidad * $producto->_joinData->cantidad)) ?></td>


                                        <td class="actions" style="text-align: center">
                                            <div class="d-flex justify-content-around gap-2">
                                                <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                    ['controller' => 'ProductosPedidos' ,'action' => 'edit', $producto->_joinData->pedidos_idpedidos,
                                                        $producto->_joinData->idproductos_pedidos,
                                                        $producto->name  . ' - ' .  $producto->marca . ' (' . $producto->content. ')'],
                                                    ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                    ['controller' => 'ProductosPedidos', 'action' => 'delete', $producto->_joinData->pedidos_idpedidos, $producto->_joinData->idproductos_pedidos],
                                                    ['confirm' => __('Eliminar {0}?', $producto->_joinData->idproductos_pedidos), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>


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

