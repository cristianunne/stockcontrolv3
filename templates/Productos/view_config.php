
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

            <div class="row">
                <div class="col-md-5 p-5 pt-3">
                    <div>
                        <div class="row p-2 bg-white border rounded">
                            <div class="col-md-3 mt-1">
                                <img src="data:image/png;base64, <?=h($producto->image)?>" alt="Sin Imagen"
                                     class="img-fluid img-responsive rounded product-image"/>

                            </div>
                            <div class="col-md-6 mt-1">
                                <h5><?= h($producto->name) ?> - <?= h($producto->marca) ?></h5>
                                <div class="d-flex flex-row">
                                    <div class="mt-1 mb-1 spec-1"><span class="text-bold">Stock:</span><span class="dot"></span>

                                        <span>
                                             <?= h(!isset($producto->stock_producto->stock) ? 'Sin Datos' : $producto->stock_producto->stock) ?>

                                        <span class="dot"></span></div>

                                </div>


                                <div class="mt-1 mb-1 spec-1">
                                    <span class="text-bold">Categoria: </span>
                                    <span class="badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                        <?= h($producto->category->name) ?>
                                    </span>
                                </div>

                                <div class="mt-1 mb-1 spec-1">
                                    <span class="text-bold">Subcategoria: </span>
                                    <span>
                                        <?= h($producto->subcategory->name) ?>
                                    </span>
                                </div>

                                <div class="mt-1 mb-1 spec-1">
                                    <span class="text-bold">Descripción: </span>
                                    <p class="text-justify">
                                        <?= h($producto->description) ?>
                                    </p>
                                </div>

                            </div>
                            <div class="align-items-center align-content-center col-xl-3 col-md-3 col-sm-3 border-left mt-1">
                                <div class="d-flex flex-row align-items-center">
                                    <h4 class="mr-1">$<?= h(!isset($producto->precios[0]->precio) ? 'Sin Datos' : $producto->precios[0]->precio) ?></h4>
                                </div>
                                <h6 class="h6 text-success">Precio actual</h6>

                                <div class="d-flex flex-row align-items-center">
                                    <h4 class="mr-1">$<?= h(!isset($producto->descuentos[0]->precio) ? 'Sin Datos' : $producto->descuentos[0]->precio) ?></h4>
                                </div>
                                <h6 class="h6 text-danger">Descuento actual</h6>

                                <div class="d-flex flex-column mt-4">

                                    <?=  $this->Html->link(
                                        '<i class="fas fa-sync-alt"></i> Actualizar Precio',
                                        ['controller' => 'Precios', 'action' => 'add', $producto->idproductos], ['class' => 'btn bg-text-info btn-sm', 'escape' => false]) ?>

                                    <?=  $this->Html->link(
                                        '<i class="fas fa-sync-alt"></i> Actualizar Descuento',
                                        ['controller' => 'Descuentos', 'action' => 'add', $producto->idproductos], ['class' => 'btn bg-redrose btn-sm mt-2', 'escape' => false]) ?>

                                    <?=  $this->Html->link(
                                        '<i class="fas fa-sync-alt"></i> Actualizar Stock',
                                        ['controller' => 'StockProductos', 'action' => 'updateStockManual', $producto->idproductos],
                                        ['class' => 'btn btn-primary btn-sm mt-2', 'escape' => false]) ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-7 col-sm-7 p-5">
                    <row class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-teal">
                                <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                                    <p style="margin-right: 50%;">Totales Vendidas Total Histórico</p>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-olive">
                                <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                                    <p style="margin-right: 55px;">Totales Vendidas en el útimo año</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="small-box bg-gradient-yellow">
                                <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                                    <p style="margin-right: 55px;">Pedidos despachados en el útimo año</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </row>
                </div>



            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-6 p-2 pt-2">
                    <div>
                        <div class="card" style="min-height: 670px;">
                            <div class="card-header" style="position: relative;">
                                <h3 class="card-title">Historial de Precios</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tabladata" class="table table-bordered table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('Precio ($)') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Activo?') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Finalizado') ?></th>
                                        <th scope="col" class="actions"><?= __('Acciones') ?></th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($precios as $precio): ?>
                                        <tr>

                                            <td class="dt-center font-weight-bold"><?= h($precio->precio) ?></td>
                                            <td class="dt-center"><?= h($precio->created->format('d-m-Y')) ?></td>

                                            <?php if($precio->active == 1):  ?>
                                                <td class="dt-center">
                                                    <span class="badge bg-teal font-size-table-his-price">
                                                        <?= h('Si') ?>
                                                    </span>
                                                </td>
                                            <?php else: ?>
                                                <td class="dt-center">
                                                    <span class="badge bg-danger font-size-table-his-price">
                                                        <?= h('No') ?>
                                                    </span>
                                                </td>
                                            <?php endif;?>


                                            <td class="dt-center"><?= h($precio->finished != null ? $precio->finished->format('d-m-Y') : '') ?></td>



                                            <td class="actions" style="text-align: center">
                                                <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                    ['controller' => 'Precios' ,'action' => 'edit', $precio->idprecios, $precio->productos_idproductos], ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                    ['action' => 'deletePriceById', $precio->idprecios],
                                                    ['confirm' => __('Eliminar {0}?', $precio->precio), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>

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
                <div class="col-md-6 p-2 pt-2">
                    <div>
                        <div class="card" style="min-height: 670px;">
                            <div class="card-header" style="position: relative;">
                                <h3 class="card-title">Historial de Descuentos</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tabladata_2" class="table table-bordered table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('Descuento ($)') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Activo?') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Finalizado') ?></th>
                                        <th scope="col" class="actions"><?= __('Acciones') ?></th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($descuentos as $descuento): ?>
                                        <tr>

                                            <td class="dt-center font-weight-bold"><?= h($descuento->precio) ?></td>
                                            <td class="dt-center"><?= h($descuento->created->format('d-m-Y')) ?></td>

                                            <?php if($descuento->active == 1):  ?>
                                                <td class="dt-center">
                                                    <span class="badge bg-teal font-size-table-his-price">
                                                        <?= h('Si') ?>
                                                    </span>
                                                </td>
                                            <?php else: ?>
                                                <td class="dt-center">
                                                    <span class="badge bg-danger font-size-table-his-price">
                                                        <?= h('No') ?>
                                                    </span>
                                                </td>
                                            <?php endif;?>
                                            <td class="dt-center"><?= h($descuento->finished != null ? $descuento->finished->format('d-m-Y') : '') ?></td>


                                            <td class="actions" style="text-align: center">

                                                <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-ban', 'aria-hidden' => 'true'])),
                                                    ['controller' => 'Descuentos', 'action' => 'setDescuentoToFalse', $descuento->iddescuentos],
                                                    ['confirm' => __('Desactivar {0}?', $descuento->precio), 'class' => 'btn bg-main-color','escape' => false,
                                                        'data-toggle' => "tooltip", 'data-placement' => "top",  'title' => "Desactivar Descuento"]) ?>

                                                <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                                    ['controller' => 'Descuentos', 'action' => 'edit', $descuento->iddescuentos, $descuento->productos_idproductos], ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                                <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                                    ['action' => 'deleteDescuentoById', $descuento->iddescuentos],
                                                    ['confirm' => __('Eliminar {0}?', $descuento->precio), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>

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
                <div class="col-md-6 p-2 pt-2">
                    <div>
                        <div class="card" style="min-height: 670px;">
                            <div class="card-header" style="position: relative;">
                                <h3 class="card-title">Actualizaciones de Stock</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tabladata_3" class="table table-bordered table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Tipo') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Cantidad') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Observaciones') ?></th>
                                        <th scope="col" class="actions"><?= __('Acciones') ?></th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if (isset($prod->stock_producto->stock_events)): ?>
                                        <?php foreach ($prod->stock_producto->stock_events as $stock_events): ?>
                                            <tr>

                                                <td class="dt-center "><?= h($stock_events->idstock_events) ?></td>
                                                <td class="dt-center "><?= h($stock_events->categoria) ?></td>
                                                <td class="dt-center"><?= h($stock_events->created->format('d-m-Y')) ?></td>
                                                <td class="dt-center"><?= h($stock_events->cantidad) ?></td>
                                                <td class="dt-center "><?= h($stock_events->observaciones) ?></td>

                                                <td class="actions" style="text-align: center">

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif;?>


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
        $('#tabladata_2').DataTable({
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

        $('#tabladata_3').DataTable({
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
