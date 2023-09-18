
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

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Lista de Productos</h3>

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
                                    <th scope="col"><?= $this->Paginator->sort('Categoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Subcategoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Stock') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Precio ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos ($)') ?></th>

                                    <th scope="col" class="actions"><?= __('Ver') ?></th>
                                    <th scope="col" class="actions"><?= __('Acciones') ?></th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td class="dt-center align-middle"> <?= $this->Html->image($producto->photo,
                                                ['alt' => 'Sin Imagen', 'pathPrefix' => '/img/assets/products/',
                                                    'class' => 'img-fluid img-responsive rounded product-image-table']); ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->name) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->marca) ?></td>
                                        <td class="dt-center align-middle"><?= h($producto->content) ?></td>
                                        <td class="dt-center align-middle">
                                             <span class="center badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                                <?= h($producto->category->name) ?>

                                        </td>
                                        <td class="dt-center align-middle">
                                            <?= h($producto->subcategory->name) ?>
                                        <td class="dt-center align-middle"><?= h('5000') ?></td>
                                        <td class="dt-center align-middle"><?= h(!isset($producto->precios[0]->precio) ? 'Sin Datos' : $producto->precios[0]->precio) ?></td>
                                        <td class="dt-center align-middle"><?= h(!isset($producto->descuentos[0]->precio) ? 'Sin Datos' : $producto->descuentos[0]->precio) ?></td>


                                        <td class="actions" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-eye', 'aria-hidden' => 'true']),
                                                ['controller' => 'Productos', 'action' => 'viewConfig', $producto->idproductos,
                                                ], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                        </td>

                                        <td class="actions" style="text-align: center">

                                            <?php if (isset($producto->precios[0]->precio)): ?>
                                                <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-plus', 'aria-hidden' => 'true']),
                                                    ['controller' => 'ProductosPedidos' ,'action' => 'add',  $id_pedido, $producto->idproductos,
                                                        h(!isset($producto->precios[0]->precio) ? 0 : $producto->precios[0]->precio),
                                                        h(!isset($producto->descuentos[0]->precio) ? 0 : $producto->descuentos[0]->precio)],
                                                    ['class' => 'btn btn-success', 'escape' => false]) ?>

                                            <?php endif; ?>


                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">

                            <div class="pull-left">
                                <?= $this->Html->link("Volver", ['action' => 'view', $id_pedido], ['class' => 'btn btn-danger btn-flat']) ?>
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
            "responsive": true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });
    })
</script>
