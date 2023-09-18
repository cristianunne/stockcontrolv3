

<?= $this->Html->css('jquery-filestyle.css') ?>
<?= $this->element('header')?>
<?= $this->element('sidebar')?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h3 class="card-title">Crear un nuevo Producto</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->

                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 card box-simm-shadow" style="margin: 0 auto; padding: 1.25rem">

                            <?= $this->Form->create($producto, ['enctype' => 'multipart/form-data']) ?>

                            <div class="brand">
                                <img src="data:image/png;base64, <?=h($producto->image)?>" alt="Sin Imagen"
                                     class="mg-fluid img-responsive rounded product-image-table-2"/>
                            </div>



                            <div class="form-group">
                                <?=  $this->Form->label('Nombre: ') ?>
                                <?= $this->Form->text('name', ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Marca: ') ?>
                                <?= $this->Form->text('marca', ['class' => 'form-control', 'placeholder' => 'Marca', 'required']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Unidad: ') ?>
                                <?= $this->Form->text('unidad', ['class' => 'form-control', 'placeholder' => 'Unidad']) ?>
                            </div>

                            <div class="form-group">
                                <?=  $this->Form->label('Tamaño: ') ?>
                                <?= $this->Form->number('content', ['class' => 'form-control', 'placeholder' => 'Tamaño']) ?>
                            </div>

                            <div class="form-group">
                                <?= $this->Form->control('categories_idcategories', ['options' => $categories,
                                    'empty' => '(Elija una Categoria)', 'type' => 'select',
                                    'attr' => 'edit',
                                    'class' => 'form-control', 'placeholder' => '', 'required', 'onchange' => 'onChangedCategories(this)',
                                    'label' => 'Categoria:', 'id' => 'categories_idcategories']) ?>
                            </div>

                            <div class="form-group">
                                <?= $this->Form->control('subcategories_idsubcategories', ['options' => $sucategorias,
                                    'empty' => '(Elija una Subcategoria)', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '',
                                    'label' => 'Subcategoria:', 'id' => 'subcategories_idsubcategories']) ?>
                            </div>

                            <div class="form-group">
                                <?= $this->Form->control('proveedores_idproveedores', ['options' => $proveedores,
                                    'empty' => '(Elija un Proveedor)', 'type' => 'select',
                                    'class' => 'form-control', 'placeholder' => '',
                                    'label' => 'Proveedor:', 'id' => 'proveedores_idproveedores']) ?>
                            </div>


                            <div class="form-group">
                                <?=  $this->Form->label('Descripcion: ') ?>
                                <?= $this->Form->textarea('description', ['class' => 'form-control', 'placeholder' => 'Descripcion']) ?>
                            </div>

                            <label for="title" class="cols-sm-2 control-label fw-bold">Seleccione una imágen: </label>
                            <div class="">

                                <input type="file" name="file" class="jfilestyle" data-inputSize="403px !important" accept="image/*">
                            </div>


                            <div class="form-group" style="margin-top: 40px;">
                                <div class="pull-right">
                                    <?= $this->Form->button("Aceptar", ['class' => 'btn bg-teal', 'escape' => false]) ?>

                                </div>
                                <div class="pull-left">
                                    <?= $this->Html->link("Volver", ['controller' => 'Productos', 'action' => 'index'], ['class' => 'btn bg-redrose']) ?>
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
    <?= $this->Html->script('jquery-filestyle.js') ?>
    <?= $this->Html->script('shopping_cart.js') ?>

</div>

<script src="
https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js
"></script>
