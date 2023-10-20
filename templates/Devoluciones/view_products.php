<!-- DataTables -->
<?= $this->Html->css('../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>
<?= $this->Html->css('../plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>

<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Devolucion</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
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
                                            <th scope="col" class="actions"><?= __('Devolucion') ?></th>


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
                                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-plus', 'aria-hidden' => 'true']),
                                                        ['action' => 'add', $producto->_joinData->idproductos_ventas], ['class' => 'btn bg-teal', 'escape' => false]) ?>

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
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>


    <?= $this->Html->script('shopping_cart.js') ?>

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

