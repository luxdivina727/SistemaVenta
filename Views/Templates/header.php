<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Point Sale</title>
        <link href="<?php echo base_url; ?>Assets/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/bootstrap.css" rel="stylesheet" />
        <script src="<?php echo base_url; ?>Assets/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-blue">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html"><img src="Assets/Recurso/Imagenes/Logo1.3.png" style=" width: 25%;"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Perfil</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url;?>Usuarios/salir">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fa fa-home"></i></div>
                                Home
                            </a>
                            <hr class="sidebar-divider">
                            <div class="sb-sidenav-menu-heading">Administración</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-cogs"></i></div>
                                Generales
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url;?>Usuarios"><i class="fas fa-user-cog	 mr-2"></i>Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url;?>Cajas"><i class="fas fa-archive	mr-2"></i> Cajas</a>
                                    <a class="nav-link" href="<?php echo base_url;?>Categorias"><i class="fas fa-sitemap mr-2"></i> Categorías</a>
                                    <a class="nav-link" href="<?php echo base_url;?>Medidas"><i class="fas fa-pencil-ruler mr-2"></i> Medidas</a>
                                </nav>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="sb-sidenav-menu-heading">GESTIÓN P.SALE</div>
                            <a class="nav-link" href="<?php echo base_url;?>Clientes" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="<?php echo base_url;?>Proveedores" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Proveedores
                            </a>
                            <a class="nav-link" href="<?php echo base_url;?>Productos" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                                Productos
                            </a>
                        </div>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-2">
                     