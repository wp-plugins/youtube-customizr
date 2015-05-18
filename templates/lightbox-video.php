<article class="video">

    <div id="popup-<?php ytc_count(); ?>" class="mfp-hide">
        <div class="player-container player-container-<?php ytc_count(); ?>">
            <div id="player-<?php ytc_count(); ?>"></div>
        </div>
    </div>
    <?php  ?>

    <div class="video-thumb">
            <a href="#popup-<?php ytc_count(); ?>" class="open-popup-<?php ytc_count(); ?>">
                <?php echo the_post_thumbnail('youtube-video') ?>
                <?php the_title('<h3 class="video-title"><span>','</span></h3>'); ?>
            </a>
    </div>

	<?php ytc_pop_up(); ?>

</article>