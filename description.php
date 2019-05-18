<?php

require_once('includes/header.php');

$separator = '<#-#>';
$file = fopen('./resources/movies/'.$_GET['film'], "r");
$movies = [];

while(!feof($file)) {
    $file_line = fgets($file);
    $file_line_content = explode($separator, $file_line);
    $movies[$file_line_content[0]] = $file_line_content[1];
}
fclose($file);

$movieInfoFromDB = getMovieData($movies['titre'], $movies['sortie']);
?>
<div class="page-content">
    <div class="d-flex justify-content-between">
        <div class="description-picture">
            <img src="<?php echo $movies['url']; ?>"/>
        </div>
        <div class="description-text d-flex flex-column justify-content-between">
            <div class="movie-infos">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><?php echo $movies['titre']; ?></h2>
                    <?php $vote = $movieInfoFromDB['infos']['vote_average'] * 10; ?>
                    <div class="star-progress" data-toggle="tooltip" data-placement="top" title="Vote: <?= $vote; ?>%">
                        <span class="star-value" style="width: <?= $vote; ?>px"></span>
                    </div>
                </div>
                <h4>Date de sortie : <?php echo $movies['sortie']; ?></h4>
                <h5 class="m-b-10">Budget: <?= number_format($movieInfoFromDB['infos']['budget'], 2, '.', ' ')."€"; ?></h5>
                <p><?php echo $movies['summary']; ?></p>
            </div>
            <h3 class="m-t-20">Acteurs</h3>
            <div class="movie-casting d-flex">
                <div class="owl-carousel">
                    <?php foreach ($movieInfoFromDB['casting'] as $key => $value) { ?>
                        <div class="text-center">
                            <img src="http://image.tmdb.org/t/p/w154<?= $value['profile_path']; ?>" class="actor-picture m-b-10">
                            <span>
                                <small><?= $value['character']; ?></small><br/>
                                <?= $value['name']; ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="movie-link">
                <button id="trailer-video-trigger" class="btn btn-youtube btn-lg" data-toggle="modal" data-target=".trailer-modal"><strong><i class="fab fa-youtube"></i> Voir la Bande-Annonce</strong></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade trailer-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:70%;height:90%;">
        <div class="modal-content" id="trailer-video" style="height: 100%"></div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>

<script>
    $(function() {
        $('.owl-carousel').owlCarousel({
            items: 4,
            loop: true,
            margin: 25,
            autoplay: true,
            autoplayTimeout: 2500,
        });
    })
    $('#trailer-video-trigger').click(function() {
        $('#trailer-video').html('<iframe src="https://www.youtube.com/embed/<?php echo $movies['trailer']; ?>?autoplay=1&iv_load_policy=3&showinfo=0&modestbranding=1&controls=0" frameborder="0" allowfullscreen style="height: 100%"></iframe>')
    });
</script>