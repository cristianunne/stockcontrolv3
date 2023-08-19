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
    <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
    </li>
</ul>

<ul class="navbar-nav ml-auto">


    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" onclick="showDropdownCart()">
            <i class="fas fa-shopping-cart icon-cart"></i>
            <span class="badge badge-danger navbar-badge" id="badge_cart"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="dropdown-cart">

            <a href="#" class="dropdown-item dropdown-footer">Ver Carrito de Compras</a>
        </div>
    </li>

</ul>
</nav>
