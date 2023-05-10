<?php get_header(); ?>
<!-- content -->
<div class="banner-page">
    <h1 class="banner-page-title">
        <?php while (have_posts()): the_post(); ?>
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
            <?php
            // Lấy giá trị của hai trường từ URL
            $loaiTour = isset($_GET['loai_tour']) ? $_GET['loai_tour'] : '';
            $diaDiem = isset($_GET['dia_diem']) ? $_GET['dia_diem'] : '';
            
            // Tạo các tham số cho WP_Query dựa trên giá trị của hai trường
            $args = array(
                'post_type' => 'tour-dl',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'loai-tour',
                        'field' => 'slug',
                        'terms' => $loaiTour
                    ),
                    array(
                        'taxonomy' => 'dia-diem',
                        'field' => 'slug',
                        'terms' => $diaDiem
                    )
                )
            );

            // Tạo WP_Query mới với các tham số để lọc tour
            $query = new WP_Query($args);
            
            // Kiểm tra và hiển thị kết quả
            if ($query->have_posts()) {
                echo "<h3>Tổng số kết quả: " . $query->found_posts . "</h3>";
                while ($query->have_posts()) {
                    $query->the_post();
                    // lấy thông tin tour
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
            <div class="col-lg-4 col-md-6 col-sm-12 ">
                <div class="tour-single">
                    <!-- img -->
                    <a href="<?php echo $link ?>">
                        <img src="<?php echo $image_url ?>" alt="<?php echo $name ?>" class="img-fluid w-100 tour-single-img">
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
                        <div class="review">
                            <!-- Review content here -->
                        </div>
                        <div class="button">
                            <a href="<?php echo $link ?>">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                } // End while
                wp_reset_postdata();
            } else {
                echo "<h3>Không có kết quả phù hợp</h3>";
            }
            ?>

        </div>
    </div>
</div>
<!-- content -->
<?php get_footer(); ?>
