<?php get_header(); ?>
<!-- content -->
<div class="banner-page">
    <h1 class="banner-page-title">
        <?php while (have_posts()) : the_post(); ?>
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
        <div class="content-page">
            <div id="primary">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            <div class="entry-meta">
                                <span class="author"><?php the_author(); ?></span>
                                <span class="date"><?php the_date(); ?></span>
                            </div>
                        </header>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                        <footer class="entry-footer">
                            <?php the_tags('Tags: ', ', ', '<br>'); ?>
                        </footer>
                    </article>
                <?php endwhile; ?>
            </div>
            <!-- Add wpDiscuz comments template -->
            <div id="comments" class="comments-area">
                <?php comments_template(); ?>
            </div>
        </div>
    </div>
</div>
<!-- content -->
<?php get_footer(); ?>
