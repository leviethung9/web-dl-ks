<!-- sidebar -->
<div class="widget">
<form role="search" method="get" class="d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" placeholder="Nhập từ khóa" class="form-control" name="s" value="<?php echo get_search_query(); ?>">
    <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i></button>
</form>

</div>
<div class="widget">
<h3>Chuyên mục</h3>
    <?php
    $categories = get_categories();
    ?>
    <ul>
    <?php
    foreach ($categories as $category) {
        $category_name = $category->name;
        $category_link = get_category_link($category->term_id);
    ?>
        <li><a href="<?php $category_link ?>" class="color-black2"><?php echo $category_name ?></a></li>
    <?php 
        }
    ?>
     </ul>
</div>
<div class="widget">
    <h3>Quảng cáo ADS</h3>
    <?php
    $args = array(
        'post_type' => 'ads',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    );
    $ads = get_posts($args);

    foreach ($ads as $ad) {
        $image_id = get_post_meta($ad->ID, 'hinh_anh', true);
        $image_url = wp_get_attachment_url($image_id);
        $link = get_post_meta($ad->ID, 'link_ads', true);
    ?>
        <a href="<?php echo $link ?>">
            <img src="<?php echo $image_url ?>" alt="ads" class="img-fluid w-100">
        </a>
    <?php
    }
    ?>
</div>

<!-- sidebar end -->