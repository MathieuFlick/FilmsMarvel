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
    <table class="table table-bordered table-marvel">
        <thead>
            <tr>
                <th class="align-middle">ID</th>
                <th class="align-middle">Date d'ajout</th>
                <th class="align-middle">Titre</th>
                <th class="align-middle">Catégorie</th>
                <th class="align-middle">Année de sortie</th>
                <th class="align-middle">Image</th>
            </tr>
        </thead>
        <tbody>
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

                <tr class="clickable-row" data-href="description.php?film=<?= $entry; ?>">
                    <td>
                        <?= $movie['id']; ?>
                        <div class="action-table d-flex justify-content-around align-items-center m-t-20">
                            <a href="modification.php?film=<?= $entry; ?>" class="movie-edit"><i class="fas fa-pencil-alt fa-lg"></i></a>
                            <a href="suppression.php?direct=true&film=<?= $entry; ?>" class="movie-delete"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </div>
                    </td>
                    <td><?= $movie['date']; ?></td>
                    <td><?= $movie['titre']; ?></td>
                    <td><?= $movie['categorie']; ?></td>
                    <td><?= $movie['sortie']; ?></td>
                    <td class="img"><img src="<?= $movie['url']; ?>" alt="Affiche de <?= $movie['titre']; ?>"></td>
                </tr>
                <?php }
            }
        ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="alert alert-danger text-center">
        Le dossier <code><?= $_SERVER['DOCUMENT_ROOT']."/resources/movies"; ?></code> est vide.
    </div>
<?php } ?>
<script>
$(document).ready( function () {
    $('.table-marvel').DataTable({
        paging: true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
});
</script>