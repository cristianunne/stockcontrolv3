
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
            <div class="row justify-content-right">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <div class="alert bg-teal" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-dollar-sign nav-icon"></i> Actualizar Precios de todos los Productos</h4>
                        <?=  $this->Html->link(
                            '<i class="fas fa-sync"> Actualizar</i>',
                            ['controller' => 'Precios', 'action' => 'addAllProductos'], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">


                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">

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
                                    <th scope="col"><?= $this->Paginator->sort('') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Producto') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Proveedor') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Categoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Subcategoria') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Precio ($)') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Descuentos ($)') ?></th>
                                    <th scope="col" class="actions"><?= __('Precio') ?></th>



                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($productos as $producto): ?>
                                    <tr>

                                        <td class="dt-center align-middle">
                                            <img src="data:image/png;base64, <?=h($producto->image)?>" alt="Sin Imagen"
                                                 class="mg-fluid img-responsive rounded product-image-table"/>

                                        </td>



                                        <td class="dt-center align-middle"><?= h($producto->name . ' ' .
                                                $producto->content . '(' . $producto->unidad . ')') ?></td>

                                        <td class="dt-center align-middle"><?= h($producto->marca) ?></td>

                                        <?php if(!empty($producto->proveedore)):  ?>
                                            <td class="dt-center align-middle"><?= h($producto->proveedore->name) ?></td>
                                        <?php else: ?>
                                            <td class="dt-center align-middle text-danger"><?= h('') ?></td>
                                        <?php endif;?>


                                        <td class="dt-center align-middle ">
                                             <span class="center badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                                <?= h($producto->category->name) ?>

                                        </td>
                                        <td class="dt-center align-middle">
                                            <?= h($producto->subcategory->name) ?>

                                        <?php if(!empty($producto->precios)):  ?>
                                            <td class="dt-center align-middle"><?= h($producto->precios[0]->precio) ?></td>
                                        <?php else: ?>
                                            <td class="dt-center align-middle text-danger"><?= h('Sin Datos') ?></td>
                                        <?php endif;?>

                                        <?php if(!empty($producto->descuentos)):  ?>
                                            <td class="dt-center align-middle"><?= h($producto->descuentos[0]->precio) ?></td>
                                        <?php else: ?>
                                            <td class="dt-center align-middle text-danger"><?= h('Sin Datos') ?></td>
                                        <?php endif;?>

                                        <td class="actions align-middle" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-sync-alt', 'aria-hidden' => 'true']),
                                                ['controller' => 'Precios', 'action' => 'add', $producto->idproductos], ['class' => 'btn bg-teal', 'escape' => false]) ?>
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


