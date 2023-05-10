<?php get_header() ?>
<!-- content -->
<div class="banner-page">
    <h1 class="banner-page-title">
    <?php while (have_posts()):
            the_post(); ?>
          
                <?php the_title(); ?>
        
        <?php endwhile; ?>
    </h1>
</div>
<div class="row w-70 mx-auto my-2">
    <div class="col-3">
        <!-- get sidebar -->
        <?php get_sidebar(); ?>
    </div>
    <div class="col-9">
        <?php while (have_posts()): the_post(); ?>
                <div class="content-page">
                <?php the_content(); ?>
                </div>
                
        <?php endwhile; ?>

    </div>
</div>
<!-- content -->
<?php get_footer() ?>