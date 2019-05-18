<?php

require_once('includes/header.php');

if(isset($_GET) && isset($_GET['film'])) {
    $separator = '<#-#>';
    $file = fopen('./resources/movies/'.$_GET['film'], "r");
    $movies = [];

    while(!feof($file)) {
        $file_line = fgets($file);
        $file_line_content = explode($separator, $file_line);
        $movies[$file_line_content[0]] = $file_line_content[1];
    }
    fclose($file);

    $movies['id'] = str_replace("\r\n", "", $movies['id']);
}
if(isset($_POST) && isset($_POST['redirectToMovie'])) {
    header('Location: modification.php?film='.$_POST['entry']);
}
if(isset($_POST) && isset($_POST['modify']) && $_GET['film']) {
    $separator = '<#-#>';

    $titre = $_POST['titre'];
    $titre = str_replace("\r\n", "", $titre);
    $sortie = $_POST['sortie'];
    $sortie = str_replace("\r\n", "", $sortie);
    $categorie = $_POST['categorie'];
    $categorie = str_replace("\r\n", "", $categorie);
    $url = $_POST['url'];
    $url = str_replace("\r\n", "", $url);
    $summary = $_POST['summary'];
    $summary = str_replace("\r\n", "", $summary);
    $trailer = $_POST['trailer'];
    $trailer = str_replace("\r\n", "", $trailer);

    $standard_titre = strtolower($titre);
    $standard_titre = str_replace(' ', '-', $standard_titre);
    $standard_titre = str_replace(':', '', $standard_titre);
    
    $movie_id = "id".$separator.str_pad($movies['id'], 5, '0', STR_PAD_LEFT);
    $movie_date = "date".$separator.date('d/m/Y - H:i:s');
    $movie_title = "titre".$separator.$titre;
    $movie_release = "sortie".$separator. $sortie;
    $movie_categorie = "categorie".$separator.$categorie;
    $movie_url = "url".$separator.$url;
    $movie_summary = "summary".$separator.$summary;
    $movie_trailer = "trailer".$separator.$trailer;

    $write_film = fopen('./resources/movies/' . $_GET['film'], 'w+');
    $write_film_do = fwrite($write_film, 
        $movie_id."\r\n"
        .$movie_date."\r\n"
        .$movie_title."\r\n"
        .$movie_release."\r\n"
        .$movie_url."\r\n"
        .$movie_summary."\r\n"
        .$movie_categorie."\r\n"
        .$movie_trailer
    );
    fclose($write_film);

    header('Location: index.php?edit=true');
}

?>

<?php if(isset($_GET['film'])) { ?>
<div class="container page-content">
    <h3>Modification d'un film</h3>
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <label>Titre</label>
                <input type="text" name="titre" value="<?= @$movies['titre']; ?>" class="form-control m-b-20" required>
            </div>
            <div class="col-md-6">
                <label>Année de sortie</label>
                <input type="text" name="sortie" value="<?= @$movies['sortie']; ?>" class="form-control m-b-20" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Catégorie</label>
                <select class="form-control m-b-20 selectpicker show-tick" name="categorie" title="<?= $movies['categorie']; ?>" required>
                    <option value="Teams" <?php echo $movies['categorie'] == 'Teams' ? 'selected' : null ?>>Teams</option>
                    <option value="Heros" <?php echo $movies['categorie'] == 'Heros' ? 'selected' : null ?>>Héros unique</option>
                    <option value="Vilains" <?php echo $movies['categorie'] == 'Vilains' ? 'selected' : null ?>>Vilains</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Image</label>
                <input type="url" name="url" value="<?= @$movies['url']; ?>" class="form-control m-b-20" required>
            </div>
            <div class="col-md-4">
                <label>Bande-annonce (Jeton vidéo YouTube) <i class="fas fa-question-circle m-l-5" data-container="body" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="top" data-content="<img src='./assets/images/helper_youtube.png'>"></i></label>
                <input type="text" name="trailer" value="<?= @$movies['trailer']; ?>" class="form-control m-b-20" required>
            </div>
        </div>
        <label>Résumé</label>
        <textarea class="form-control m-b-20" name="summary" rows="6" required><?= @$movies['summary']; ?></textarea>
        <input type="submit" name="modify" value="Envoyer" class="btn btn-success">
    </form>
</div>
<?php } else { ?>
<div class="container page-content">
    <h3> Modification d'un fichier</h3>
    <form method="POST">
        <label>Titre</label>
        <select name="entry" class="form-control show-tick selectpicker m-b-20" required data-live-search="true" data-size="8" title="Choisissez un film...">
            <?php
            $opendir = opendir('./resources/movies');
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
        <input type="submit" name="redirectToMovie" value="Envoyer" class="btn btn-success">
    </form> 
</div>
<?php } ?>

<?php require_once('includes/footer.php'); ?>