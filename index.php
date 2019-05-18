<?php require_once('includes/header.php'); ?>

<div class="container" id="listings">
    <?php if(isset($_GET['delete']) && $_GET['delete'] == true) { ?>
        <div class="alert alert-success alert-dismissible m-b-20 animated fadeIn" role="alert">
            <strong>Succès !</strong> Le fichier à bien été supprimé.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
        </div>
    <?php } if(isset($_GET['edit']) && $_GET['edit'] == true) { ?>
        <div class="alert alert-success alert-dismissible m-b-20 animated fadeIn" role="alert">
            <strong>Succès !</strong> Le fichier à bien été modifié.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
        </div>
    <?php } if(isset($_GET['added']) && $_GET['added'] == true) { ?>
        <div class="alert alert-success alert-dismissible m-b-20 animated fadeIn" role="alert">
            <strong>Succès !</strong> Le fichier à bien été ajouté.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
        </div>
    <?php } ?>

    <div class="listing-header m-b-20 d-flex">
        <h3>Listes des films ajoutés</h3>
        <div class="listing-display d-flex align-items-center justify-content-end">
            <span class="active" data-display="table"><i class="fas fa-th-list"></i></span>
            <span data-display="items" class="p-r-0"><i class="fas fa-th-large"></i></span>
        </div>
    </div>
    <div id="listing-content"></div>
</div>

<?php require_once('includes/footer.php'); ?>