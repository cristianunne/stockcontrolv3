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

                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <?php if(isset($productos->stock_campaign_producto)):?>
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
                                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
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
                                            <td class="dt-center align-middle text-danger"><?= h('Sin Stock') ?></td>
                                        <?php endif;?>

                                        <?php if(!empty($prod->cantidad)):  ?>
                                        <td class="actions align-middle" style="text-align: center">
                                            <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-plus', 'aria-hidden' => 'true']),
                                                ['controller' => 'ProductosVentasTemp', 'action' => 'add', $ventas_temp->idventas, $prod->producto->idproductos],
                                                ['class' => 'btn bg-teal', 'escape' => false]) ?>
                                        </td>

                                        <?php else: ?>
                                            <td class="dt-center align-middle text-danger"></td>
                                        <?php endif;?>



                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <div class="alert bg-danger" role="alert">
                                <h4 class="alert-heading"><i class="fas fa-info-circle nav-icon"></i> Error</h4>
                                <p>No existen productos cargados en el Stock del Camion.</p>
                            </div>
                         <?php endif;?>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="pull-right">
                                <?= $this->Html->link("Terminar", ['controller' => 'VentasTemp', 'action' => 'view',
                                    $id_ventas_temp], ['class' => 'btn bg-redrose']) ?>
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


