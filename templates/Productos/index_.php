
<?php

echo $this->element('header');
echo $this->element('sidebar');

?>
<div class="content-wrapper">
    <div class="content">
        <?= $this->Flash->render() ?>
        <div class="container-fluid mt-lg-5">
            <div class="row">
                <div class="col-md-3">

                    <div class="alert bg-teal" role="alert">
                        <h4 class="alert-heading"><i class="fab fa-shopify nav-icon"></i> Nuevo</h4>

                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <p>Nuevo producto en la tienda.</p>
                            </div>
                            <div>
                                <?= $this->Html->link($this->Html->tag('span', ' Nuevo', ['class' => 'fas fa-plus', 'aria-hidden' => 'true']),
                                    ['controller' => 'Productos', 'action' => 'add'], ['class' => 'btn bg-green', 'escape' => false]) ?>
                            </div>

                        </div>

                    </div>
                    <div>
                        <div class="img-box">
                            <?= $this->Html->image('3ac774188018882918a3174eece6967141c240a0614a330a21a6c582f849e39c_yerba_amanda.jpg',
                                ['alt' => 'CakePHP', 'pathPrefix' => '/img/assets/products/']); ?>

                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="alert bg-text-info" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-store nav-icon"></i> Productos</h4>
                        <p>En esta sección puedes visualizar todos los Productos disponibles en tu Tienda.</p>
                    </div>
                    <div class="row gy-3" id="row-card-shop">

                        <?php foreach ($productos as $producto): ?>
                            <div class="col-sm-3">
                                <div class="thumb-wrapper">
                                    <p class="mb-4">
                                          <span class="float-right badge" style="<?= h('background-color:'.$producto->category->color) ?> !important">
                                        <?= h($producto->category->name) ?>
                                    </span>
                                    </p>

                                    <div class="img-box">


                                        <?= $this->Html->image($producto->photo,
                                            ['alt' => 'CakePHP', 'pathPrefix' => '/img/assets/products/']); ?>

                                    </div>
                                    <div class="thumb-content">
                                        <h4 class="h4-shop"><?= h($producto->name) ?></h4>
                                        <h6 class="h6-shop"><?= h($producto->marca) ?></h6>

                                        <?php if(empty($producto->descuentos)):  ?>
                                            <?php if(isset($producto->precios[0]->precio)):  ?>
                                                <p class="item-price"> <b><?= h('$' . $producto->precios[0]->precio) ?></b></p>
                                            <?php else: ?>
                                                <p class="item-price"><strike></strike> <b>Sin datos</b></p>
                                            <?php endif;?>
                                        <?php else: ?>

                                            <p class="item-price"><strike><?= h('$'. (number_format($producto->precios[0]->precio, 2, ',', ' '))) ?></strike>
                                                <b><?= h('$' . (number_format($producto->precios[0]->precio - $producto->descuentos[0]->precio, 2, ',', ' '))) ?></b></p>
                                        <?php endif;?>


                                        <?= $this->Html->link($this->Html->tag('span', ' Ver Producto', ['class' => 'fas fa-search', 'aria-hidden' => 'true']),
                                            ['controller' => 'Productos', 'action' => 'viewConfig', $producto->idproductos], ['class' => 'btn primary btn-ver-product', 'escape' => false]) ?>


                                        <?php if(!empty($producto->precios)):  ?>
                                            <button class="btn btn-ver-product"  attr="<?= h($producto->idproductos) ?>" onclick="addToCart(this)"
                                                    id="<?= h('button'. $producto->idproductos) ?>"
                                                <?= h(empty($producto->cart_session) ? '' : 'disabled') ?>>
                                                <i class="fas fa-shopping-cart"></i></button>
                                        <?php endif;?>


                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <nav class="Page navigation" style="margin-top: 20px;">
                        <ul class="pagination justify-content-center">
                            <?= $this->Paginator->first('Primero') ?>
                            <?= $this->Paginator->prev('Anterior') ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next('Siguiente') ?>
                            <?= $this->Paginator->last('Último') ?>
                        </ul>
                    </nav>

                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->Html->script('shopping_cart.js') ?>
