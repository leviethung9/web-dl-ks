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
                <div class="row">
                <?php
    $query = new WP_Query(
      array(
        'post_type' => 'post',
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => 'DESC'
      )
    );
    ?>

    <?php if ($query->have_posts()) : ?>
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $post = get_post($post_id);
        $link = get_permalink();
        $thumbnail_url = get_the_post_thumbnail_url($post_id);
        $title = $post->post_title;
        $date = get_the_date('', $post_id);
        // $excerpt = wp_trim_words($post->post_excerpt, 30, '...');
        
        ?>
        <div class="col-4">
          <div class="box-post">
            <a href="<?php echo $link ?>">
              <img src="<?php echo $thumbnail_url ?>" alt="<?php echo $title ?>" class="img-fluid w-100">
            </a> 
            <div class="box-post-content">
              <a class="name" href="<?php echo $link ?>"><h4><?php echo $title ?></h4></a>
              <p class="post-date">
              <i class="fa-solid fa-clock"></i>  <?php echo $date ?>
              </p>
              <div class="d-grid gap-2">
                <a href="<?php echo $link ?>" class="btn btn-primary">Xem thêm</a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
                </div>
                </div>
        <?php endwhile; ?>

    </div>
</div>
<!-- content -->
<?php get_footer() ?>