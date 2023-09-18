
<?= $this->Html->css('../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') ?>
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header" style="position: relative;">
                            <h3 class="card-title">Registro de Proveedores</h3>
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
                                    <?= $this->Form->create($proveedores, ['enctype' => 'multipart/form-data']) ?>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?=  $this->Form->label('Nombre: ') ?>
                                                <?= $this->Form->text('name', ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) ?>
                                            </div>

                                            <div class="form-group">
                                                <?=  $this->Form->label('CUIT: ') ?>
                                                <?= $this->Form->text('cuit', ['class' => 'form-control', 'placeholder' => '00-00000000-0']) ?>
                                            </div>

                                            <div class="form-group">
                                                <?=  $this->Form->label('Dirección: ') ?>
                                                <?= $this->Form->text('direccion', ['class' => 'form-control', 'placeholder' => 'Dirección', 'required']) ?>
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
                                            <div class="form-group">
                                                <?=  $this->Form->label('Teléfono: ') ?>
                                                <?= $this->Form->text('telefono', ['class' => 'form-control', 'placeholder' => 'Teléfono', 'required']) ?>
                                            </div>
                                            <div class="form-group">
                                                <?=  $this->Form->label('Email: ') ?>
                                                <?= $this->Form->text('email', ['class' => 'form-control', 'placeholder' => 'Email']) ?>
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
                </div>


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
