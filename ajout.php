<?php

require_once('includes/header.php');

if($_POST) {
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

    $file_count = fopen('./resources/filecount.txt', 'r');
    $file_count_read = fgets($file_count);
    fclose($file_count);

    $file_title = strtolower($titre);
    $file_title = str_replace(' ', '_', $file_title);
    $file_title = str_replace(':', '', $file_title);
    $file_title = str_replace(`'`, '', $file_title);
    
    $movie_id = "id".$separator.str_pad(($file_count_read + 1), 5, '0', STR_PAD_LEFT);
    $movie_date = "date".$separator.date('d/m/Y - H:i:s');
    $movie_title = "titre".$separator.$titre;
    $movie_release = "sortie".$separator. $sortie;
    $movie_categorie = "categorie".$separator.$categorie;
    $movie_url = "url".$separator.$url;
    $movie_summary = "summary".$separator.$summary;
    $movie_trailer = "trailer".$separator.$trailer;

    $write_film = fopen('./resources/movies/' . $file_title . '.txt', 'w+');
    $write_film_do = fwrite($write_film, 
        $movie_id."\r\n"
        .$movie_date."\r\n"
        .$movie_title."\r\n"
        .$movie_categorie."\r\n"
        .$movie_release."\r\n"
        .$movie_url."\r\n"
        .$movie_summary."\r\n"
        .$movie_trailer
    );
    fclose($write_film);

    $update_films_number = fopen('./resources/filecount.txt', 'w+');
    $update_films_number_do = fwrite($update_films_number, ($file_count_read + 1));
    fclose($update_films_number);

    header('Location: index.php?added=true');
   
}

?>

<div class="container page-content">
    <h3>Ajout d'un film</h3>
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control m-b-20">
            </div>
            <div class="col-md-6">
                <label>Année de sortie</label>
                <input type="text" placeholder="2000" name="sortie" class="form-control m-b-20">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Catégorie</label>
                <select class="form-control m-b-20 selectpicker show-tick" name="categorie" title="Choisissez une catégorie...">
                    <option value="Teams">Teams</option>
                    <option value="Heros">Héros unique</option>
                    <option value="Vilains">Vilains</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Image</label>
                <input type="url" placeholder="Entrez une URL" name="url" class="form-control m-b-20">
            </div>
            <div class="col-md-4">
                <label>Bande-annonce (Jeton vidéo YouTube) <i class="fas fa-question-circle m-l-5" data-container="body" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="top" data-content="<img src='./assets/images/helper_youtube.png'>"></i></label>
                <input type="text" name="trailer" value="<?= @$movies['trailer']; ?>" class="form-control m-b-20" required>
            </div>
        </div>
        <label>Résumé</label>
        <textarea class="form-control m-b-20" name="summary" rows="6"></textarea>
        <input type="submit" value="Envoyer" class="btn btn-success">
    </form>
</div>

<?php require_once('includes/footer.php'); ?>