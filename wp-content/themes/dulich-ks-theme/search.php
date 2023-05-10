<?php get_header(); ?>
<!-- content -->
<div class="banner-page">
    <h1 class="banner-page-title">
        Tìm kiếm
    </h1>
</div>
<div class="row w-70 mx-auto my-2">
    <div class="col-3">
        <!-- get sidebar -->
        <?php get_sidebar(); ?>
    </div>
    <div class="col-9">
        <div class="content-page">
            <?php
            $search_query = get_search_query();
            echo 'Từ khóa tìm kiếm: <h4 class="color-red">' . $search_query . '</h4>';
            ?>

            <?php
            $search_query = get_search_query();
            if ($search_query) {
                // Query cho trường custom post type 1
                $args_custom_post_type_1 = array(
                    'post_type' => 'tour-dl',
                    's' => $search_query,
                    // Thêm các tham số tùy chọn khác nếu cần
                );
                $query_custom_post_type_1 = new WP_Query($args_custom_post_type_1);

                // Kiểm tra và hiển thị kết quả trường custom post type 1
                if ($query_custom_post_type_1->have_posts()) {
                    echo '<h5>Kết quả tìm kiếm cho Tour du lịch:</h5>';
                    ?>
                    <div class="row">
                        <?php while ($query_custom_post_type_1->have_posts()) {
                            $query_custom_post_type_1->the_post();
                            // Lấy thông tin tour
                            $id = get_the_ID();
                            $link = get_permalink();
                            $name = get_post_meta($id, 'ten', true);
                            $image_id = get_post_meta($id, 'anh_dai_dien', true);
                            $image_url = wp_get_attachment_url($image_id);
                            $time = get_post_meta($id, 'thoi_gian', true);
                            $gia = get_post_meta($id, 'gia', true);
                            $gia_formatted = number_format($gia, 0, '.', ',');
                            $gia_sanitized = wp_kses($gia_formatted . ' VND', array());
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="tour-single">
                                    <!-- img -->
                                    <a href="<?php echo $link ?>">
                                        <img src="<?php echo $image_url ?>" alt="<?php echo $name ?>"
                                            class="img-fluid w-100 tour-single-img">
                                    </a>
                                    <!-- img end -->
                                    <div class="content">
                                        <a href="<?php echo $link ?>" class="name-tour"><?php echo $name ?></a>
                                        <div class="tour-time">
                                            <i class="fa-regular fa-clock"></i>
                                            <?php echo $time ?>
                                        </div>
                                        <div class="tour-price">
                                            <i class="fa-solid fa-money-bill"></i>
                                            <?php echo $gia_sanitized; ?>
                                        </div>
                                    </div>
                                    <div class="tour-button">
                                        <div class="review"></div>
                                        <div class="button">
                                            <a href="<?php echo $link ?>">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        wp_reset_postdata();
                }
            }
            ?>
                <!-- ket qua phan hotel -->
                <?php
                $search_query = get_search_query();
                if ($search_query) {
                    // Query cho trường custom post type 2
                    $args_custom_post_type_2 = array(
                        'post_type' => 'hotel',
                        's' => $search_query,
                        // Thêm các tham số tùy chọn khác nếu cần
                    );
                    $query_custom_post_type_2 = new WP_Query($args_custom_post_type_2);

                    // Kiểm tra và hiển thị kết quả trường custom post type 2
                    if ($query_custom_post_type_2->have_posts()) {
                        echo '<h5>Kết quả tìm kiếm cho Khách sạn - Resolt - Homestay:</h5>';
                        ?>
                        <div class="row">
                            <?php while ($query_custom_post_type_2->have_posts()) {
                                $query_custom_post_type_2->the_post();
                                // Lấy thông tin khách sạn
                                $id = get_the_ID();
                                $link = get_permalink();
                                $name = get_the_title();
                                $image_id = get_post_meta($id, 'anh_dai_dien', true);
                                $image_url = wp_get_attachment_url($image_id);
                                // Lấy số sao khách sạn
                                $star = '';
                                $terms = get_the_terms($id, 'star');
                                if ($terms && !is_wp_error($terms)) {
                                    $term_names = array();
                                    foreach ($terms as $term) {
                                        $term_names[] = $term->name;
                                    }
                                    $star = implode(', ', $term_names);
                                }
                                // Lấy số lượng phòng ngủ
                                $pn = '';
                                $terms = get_the_terms($id, 'phong_ngu');
                                if ($terms && !is_wp_error($terms)) {
                                    $term_names = array();
                                    foreach ($terms as $term) {
                                        $term_names[] = $term->name;
                                    }
                                    $pn = implode(', ', $term_names);
                                }
                                // Lấy số lượng nhà tắm
                                $nt = '';
                                $terms = get_the_terms($id, 'nha_tam');
                                if ($terms && !is_wp_error($terms)) {
                                    $term_names = array();
                                    foreach ($terms as $term) {
                                        $term_names[] = $term->name;
                                    }
                                    $nt = implode(', ', $term_names);
                                }
                                // Lấy diện tích
                                $dt = '';
                                $terms = get_the_terms($id, 'dien_tich');
                                if ($terms && !is_wp_error($terms)) {
                                    $term_names = array();
                                    foreach ($terms as $term) {
                                        $term_names[] = $term->name;
                                    }
                                    $dt = implode(', ', $term_names);
                                }
                                // Lấy giá và giá khuyến mãi
                                $regular_price = get_post_meta($id, 'gia', true);
                                $sale_price = get_post_meta($id, 'gia_khuyen_mai', true);
                                ?>

                                <div class="col-lg-4 col-md-6 col-sm-12 my-2">
                                    <div class="box-hotel">
                                        <a href="<?php echo $link ?>">
                                            <img src="<?php echo $image_url ?>" alt="<?php echo $name ?>" class="img-fluid w-100">
                                        </a>
                                        <div class="hotel-content">
                                            <h5 class="py-2 hotel-type"></h5> Loại khách sạn: <span>
                                                <?php echo $star ?>
                                            </span> </h5>
                                            <h3 class="hotel-name py-2">
                                                <?php echo $name ?>
                                            </h3>
                                            <p class="py-1"><i class="fa-solid fa-bed"></i> <span>
                                                    <?php echo $pn ?>
                                                </span> </p>
                                            <p class="py-1"><i class="fa-solid fa-bath"></i> <span>
                                                    <?php echo $nt ?>
                                                </span> </p>
                                            <p class="py-1"><i class="fa-solid fa-s"></i> <span>
                                                    <?php echo $dt ?>
                                                </span> </p>
                                        </div>
                                        <div class="hotel-price">
                                            <h4 class="">
                                                Giá gốc:
                                                <span class="regular-price">
                                                    <?php echo number_format($regular_price, 0, ',', '.') . ' vnđ' ?>
                                                </span>
                                            </h4>
                                            <h4 class="">
                                                Giá khuyến mại:
                                                <span class="sale-price">
                                                    <?php
                                                    if ($sale_price && $sale_price > 0) {
                                                        echo number_format($sale_price, 0, ',', '.') . ' vnđ';
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>
                                                </span>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            wp_reset_postdata();
                    }
                }
                ?>
                </div>
            </div>
        </div>
   
<?php
$search_query = get_search_query();
if ($search_query) {
    // Query cho bài viết mặc định
    $args_default_post_type = array(
        'post_type' => 'post',
        // Loại bài viết mặc định
        's' => $search_query,
        // Thêm các tham số tùy chọn khác nếu cần
    );
    $query_default_post_type = new WP_Query($args_default_post_type);

    // Kiểm tra và hiển thị kết quả bài viết mặc định
    if ($query_default_post_type->have_posts()) {
        echo '<h5>Kết quả tìm kiếm cho Bài viết:</h5>';
        ?>
        <div class="row">
            <?php
            while ($query_default_post_type->have_posts()) {
                $query_default_post_type->the_post();
                // Lấy thông tin bài viết
                $post_id = get_the_ID();
                $post = get_post($post_id);
                $link = get_permalink();
                $thumbnail_url = get_the_post_thumbnail_url($post_id);
                $title = $post->post_title;
                $date = get_the_date('', $post_id);
                // Hiển thị thông tin bài viết
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-post">
                        <a href="<?php echo $link ?>">
                            <img src="<?php echo $thumbnail_url ?>" alt="<?php echo $title ?>" class="img-fluid w-100">
                        </a>
                        <div class="box-post-content">
                            <a class="name" href="<?php echo $link ?>">
                                <h4>
                                    <?php echo $title ?>
                                </h4>
                            </a>
                            <p class="post-date">
                                <i class="fa-solid fa-clock"></i>
                                <?php echo $date ?>
                            </p>
                            <div class="d-grid gap-2">
                                <a href="<?php echo $link ?>" class="btn btn-primary">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php
            }
            wp_reset_postdata();
    }
}
?>
 </div>
</div>
</div>
        <!-- content -->
        <?php get_footer(); ?>