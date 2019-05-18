<?php
function is_dir_empty($dir) {
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            closedir($handle);
            return FALSE;
        }
    }
    closedir($handle);
    return TRUE;
}

if (!is_dir_empty('../movies')) { ?>
<div class="row">
    <?php 
        $opendir = opendir('../movies');
        $movieData = [];
        while ($entry = readdir($opendir)) {
            if ($entry !== '.' && $entry !== '..') {
                $fileContent = file_get_contents('../movies/' . $entry);
                $separator = '<#-#>';
                $array = explode("\r\n", $fileContent);
                $subTab = [];                
                foreach ($array as $lineContent) {
                    $line = explode($separator, $lineContent);
                    $subTab[$line[0]] = $line[1];
                }
                $movieData[$entry] = $subTab;
                ksort($movieData);

                $excluded = [
                    "categorie"
                ];

                $movie = $movieData[$entry];
                ?>
                <div class="col-md-3 m-b-20">
                    <div class="movie-item" style="background: url(<?= $movie['url']; ?>);background-size: cover;">
                        <span class="backdrop animated fadeIn faster"></span>
                        <div class="item-content faster">
                            <h3 class="movie-title"><?= $movie['titre'] ?></h3>
                            <p class="movie-summary">
                                <?php echo $movie['summary']."..."; ?>
                            </p>
                            <span class="movie-date">Date de sortie: <?= $movie['sortie']; ?></span>
                            <div class="m-t-20 d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="description.php?film=<?= $entry; ?>" class="movie-link btn btn-xs btn-outline-light">
                                        Voir la fiche
                                    </a>
                                </div>
                                <div class="m-b-5">
                                    <a href="modification.php?film=<?= $entry; ?>" class="movie-edit m-r-5">
                                        <i class="fas fa-pencil-alt fa-lg"></i>
                                    </a>
                                    <a href="suppression.php?direct=true&film=<?= $entry; ?>" class="movie-delete">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        }
    ?>
</div>
<?php } else { ?>
    <div class="alert alert-danger text-center">
        Le dossier <code><?= $_SERVER['DOCUMENT_ROOT']."/resources/movies"; ?></code> est vide.
    </div>
<?php } ?>