<?php

$session = $this->request->getSession();
$id = $session->read('Auth.User.idusers');
$firstname = $session->read('Auth.User.firstname');
$lastname = $session->read('Auth.User.lastname');
$photo = $session->read('Auth.User.photo');
$folder = $session->read('Auth.User.folder');
$role = $session->read('Auth.User.role');
$email = $session->read('Auth.User.email');

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
</ul>

<ul class="navbar-nav ml-auto">


    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" onclick="showDropdownCart()">
            <i class="fas fa-shopping-cart icon-cart"></i>
            <span class="badge badge-danger navbar-badge" id="badge_cart">
                <?php
                    if(count($productos_cart) > 0)
                    {
                        echo count($productos_cart);
                    }
                ?>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="dropdown-cart">
            <?= $this->Html->link($this->Html->tag('span', ' Ver Carrito de Compras', ['class' => 'fas fa-search', 'aria-hidden' => 'true']),
                ['controller' => 'CartShop', 'action' => 'index'], ['class' => 'dropdown-item dropdown-footer', 'escape' => false]) ?>
            <div class="dropdown-divider"></div>

            <!--<a id="item_cart_3" href="#" class="dropdown-item">
            <div class="media">
             <div class="media">
             <img class="img-size-50 mr-3 img-circle" alt="imagen cart"
                src="/stockcontrolv3//img/assets/products/2feb6cd1baf4cdee25df4dccb5a6e8c577a00e9631eb9b0fd1850c80140bbe07_arroz.jpeg">
            <div class="media-body"><h3 class="dropdown-item-title">Arroz<span class="float-right text-sm text-danger">
            <i class="fas fa-trash"></i></span></h3><p>Luchetti</p></div></div></a>
                -->
            <?php foreach ($productos_cart as $producto): ?>
                <a id="item_cart_<?= h($producto->productos_idproductos) ?>" href="#" class="dropdown-item">
                    <div class="media">


                        <img src="data:image/png;base64, <?=h($producto->producto->image)?>" alt="Sin Imagen"
                                 class="img-size-50 mr-3 img-circle"/>

                        <div class="media-body">
                            <h3 class="dropdown-item-title"> <?= h($producto->producto->name) ?>
                                <span class="float-right text-sm text-danger" onclick="removeItemFromCart(this)" attr="<?= h($producto->productos_idproductos) ?>"
                                attr2="<?= h($producto->idcart_session) ?>">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </h3>
                            <p><?= h($producto->producto->marca) ?></p>
                        </div>

                    </div>
                </a>
                <div class="dropdown-divider"></div>
            <?php endforeach; ?>
        </div>


    </li>

</ul>
</nav>
