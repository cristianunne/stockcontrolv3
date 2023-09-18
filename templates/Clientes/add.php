
<?= $this->Html->css('../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Registro de Clientes</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 card box-simm-shadow" style="margin: 0 auto; padding: 1.25rem">
                            <?= $this->Form->create($clientes, ['enctype' => 'multipart/form-data']) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?=  $this->Form->label('Nombre: ') ?>
                                        <?= $this->Form->text('nombre', ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('Apellido: ') ?>
                                        <?= $this->Form->text('apellido', ['class' => 'form-control', 'placeholder' => 'Apellido', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('DNI: ') ?>
                                        <?= $this->Form->text('dni', ['class' => 'form-control', 'placeholder' => 'DNI', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('País: ') ?>
                                        <?= $this->Form->text('pais', ['class' => 'form-control', 'placeholder' => 'País', 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <?=  $this->Form->label('Provincia: ') ?>
                                        <?= $this->Form->text('provincia', ['class' => 'form-control', 'placeholder' => 'Provincia', 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <?=  $this->Form->label('Departamento: ') ?>
                                        <?= $this->Form->text('departamento', ['class' => 'form-control', 'placeholder' => 'Departamento', 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <?=  $this->Form->label('Localidad: ') ?>
                                        <?= $this->Form->text('localidad', ['class' => 'form-control', 'placeholder' => 'Localidad', 'required']) ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?=  $this->Form->label('Dirección: ') ?>
                                        <?= $this->Form->text('direccion', ['class' => 'form-control', 'placeholder' => 'Dirección', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('Altura: ') ?>
                                        <?= $this->Form->text('altura', ['class' => 'form-control', 'placeholder' => 'Altura', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('Nombre del Comercio: ') ?>
                                        <?= $this->Form->text('shop_name', ['class' => 'form-control', 'placeholder' => 'Nombre del Comercio', 'required']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?=  $this->Form->label('Observaciones: ') ?>
                                        <?= $this->Form->textarea('observaciones', ['class' => 'form-control', 'placeholder' => 'Observaciones']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Clientes', 'action' => 'index'], ['class' => 'btn bg-redrose']) ?>
                                </div>

                            </div>

                            <?= $this->Form->end() ?>
                        </div>

                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <?= $this->Html->script('../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>
    <?= $this->Html->script('shopping_cart.js') ?>
    <script>
        $(function () {
            // Basic instantiation:
            $('#color').colorpicker();

            // Example using an event, to change the color of the #demo div background:
            $('#color').on('colorpickerChange', function(event) {
                $('#color').css('background-color', event.color.toHexString());
            });
        });
    </script>
</div>
