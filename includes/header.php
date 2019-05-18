<?php
    // require_once('autoload.php');
    require_once('themoviedb.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <title>Catalogue films Marvel</title>
</head>
<body>
    <header>
        <img src="./assets/images/logo.png" class="logo">
    </header>
    <div class="container no-padding">
        <nav class="menu">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li>
                    <a>Catalogue</a>
                    <ul class="animated flipInY">
                        <li><a href="./ajout.php">Ajout d'un film</a></li>
                        <li><a href="./suppression.php">Suppression</a></li>
                        <li><a href="./modification.php">Modification</a></li>
                    </ul>
                </li>
            </ul>
        </nav>