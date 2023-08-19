
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
        <div class="container-fluid p-5">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title" style="position: absolute; top: 50%;;">Lista de Clientes</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <?=  $this->Html->link(
                            '<i class="fas fa-plus "></i> Nuevo',
                            ['controller' => 'Clientes', 'action' => 'add'], ['class' => 'btn bg-teal', 'escape' => false]) ?>

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="tabladata" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('Comercio') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Apellido') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('DNI') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('País') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Provincia') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Departamento') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Localidad') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Direccion') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Altura') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Observaciones') ?></th>
                            <th scope="col" class="actions"><?= __('Acciones') ?></th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($clientes as $clie): ?>
                            <tr>
                                <td class="dt-center font-weight-bold"><?= h($clie->shop_name) ?></td>
                                <td class="dt-center"><?= h($clie->nombre) ?></td>
                                <td class="dt-center"><?= h($clie->apellido) ?></td>
                                <td class="dt-center"><?= h($clie->dni) ?></td>
                                <td class="dt-center"><?= h($clie->pais) ?></td>
                                <td class="dt-center"><?= h($clie->provincia) ?></td>
                                <td class="dt-center"><?= h($clie->departamento) ?></td>
                                <td class="dt-center"><?= h($clie->localidad) ?></td>
                                <td class="dt-center"><?= h($clie->direccion) ?></td>
                                <td class="dt-center"><?= h($clie->altura) ?></td>
                                <td class="dt-center"><?= h($clie->observaciones) ?></td>


                                <td class="actions" style="text-align: center">
                                    <?= $this->Html->link($this->Html->tag('span', '', ['class' => 'fas fa-edit', 'aria-hidden' => 'true']),
                                        ['action' => 'edit', $clie->idclientes], ['class' => 'btn bg-lightpurple', 'escape' => false]) ?>

                                    <?= $this->Form->postLink(__($this->Html->tag('span', '', ['class' => 'fas fa-trash-alt', 'aria-hidden' => 'true'])),
                                        ['action' => 'delete', $clie->idclientes],
                                        ['confirm' => __('Eliminar {0}?', $clie->nombre), 'class' => 'btn btn-danger bg-redrose','escape' => false]) ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
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

