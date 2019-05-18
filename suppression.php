<?php
$opendir = opendir('./resources/movies');
require_once('includes/header.php');

if($_POST) {
    $fileToDelete = $_POST['entry'];

    $majFilecount = file_get_contents('./resources/filecount.txt');
    $majFilecount = intval($majFilecount);
    $majFilecount -= $majFilecount;

    $fopen = fopen('./resources/filecount.txt', 'w+');
    $write = fwrite($fopen, $majFilecount);
    fclose($fopen);
    unlink('./resources/movies/'.$fileToDelete);

    header('Location: ?delete=true');
}

if(isset($_GET['direct']) && $_GET['direct'] == true && isset($_GET['film'])) {
    $fileToDelete = $_GET['film'];

    $majFilecount = file_get_contents('./resources/filecount.txt');
    $majFilecount = intval($majFilecount);
    $majFilecount -= $majFilecount;

    $fopen = fopen('./resources/filecount.txt', 'w+');
    $write = fwrite($fopen, $majFilecount);
    fclose($fopen);
    unlink('./resources/movies/'.$fileToDelete);

    header('Location: index.php?delete=true');
}

?>

<?php if(isset($_GET['delete']) && $_GET['delete'] == true) { ?>
<div class="alert alert-success alert-dismissible m-b-20 animated fadeIn" role="alert">
    <strong>Succès !</strong> Le fichier à bien été supprimé.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="fas fa-times"></i></span>
    </button>
</div>
<?php } ?>

<div class="container page-content">
    <h3> Suppression d'un fichier</h3>
    <form method="POST">
        <label>Titre</label>
        <select name="entry" class="custom-select m-b-20">
            <option selected disabled>Choisissez votre film</option>
            <?php
                while ($entry = readdir($opendir)) {
                    if ($entry !== '.' && $entry !== '..') {
                        $beautifyEntry = str_replace('-', ' ', $entry);
                        $beautifyEntry = str_replace('.txt', '', $beautifyEntry);
                        $beautifyEntry = ucwords($beautifyEntry);
                        echo '<option value="'. $entry .'">'. $beautifyEntry .'</option>';
                    }
                }
            ?>
        </select>
        <input type="submit" value="Envoyer" class="btn btn-success">
    </form> 
</div>

<?php require_once('includes/footer.php'); ?>