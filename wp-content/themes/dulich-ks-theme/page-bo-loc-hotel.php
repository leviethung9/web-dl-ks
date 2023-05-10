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
            $star = isset($_GET['star']) ? $_GET['star'] : '';
            $phong_ngu = isset($_GET['phong_ngu']) ? $_GET['phong_ngu'] : '';
            $nha_tam = isset($_GET['nha_tam']) ? $_GET['nha_tam'] : '';
            $dien_tich = isset($_GET['dien_tich']) ? $_GET['dien_tich'] : '';
            // Tạo các tham số cho WP_Query dựa trên giá trị của hai trường
            $args = array(
                'post_type' => 'hotel',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'star',
                        'field' => 'slug',
                        'terms' => $star
                    ),
                    array(
                        'taxonomy' => 'phong_ngu',
                        'field' => 'slug',
                        'terms' => $phong_ngu
                    )
                    ,
                    array(
                        'taxonomy' => 'nha_tam',
                        'field' => 'slug',
                        'terms' => $nha_tam
                    )
                    ,
                    array(
                        'taxonomy' => 'dien_tich',
                        'field' => 'slug',
                        'terms' => $dien_tich
                    )
                )
            );

            // Tạo WP_Query mới với các tham số để lọc tour
            $data_hotel = new WP_Query($args);
            
            // Kiểm tra và hiển thị kết quả
            if ($data_hotel->have_posts()) {
                echo "<h3>Tổng số kết quả: " . $data_hotel->found_posts . "</h3>";
                while ($data_hotel->have_posts()) {
                    $data_hotel->the_post();

                    // Lấy thông tin ảnh đại diện
                    $id = get_the_ID();
                    $link = get_the_permalink();
                    $name = get_the_title();
                    $image_id = get_post_meta($id, 'anh_dai_dien', true);
                    $image_url = wp_get_attachment_url($image_id);
                    // lay so sao hotel
                    $star = '';
                    $terms = get_the_terms($id, 'star');
                    if ($terms && !is_wp_error($terms)) {
                        $term_names = array();
                        foreach ($terms as $term) {
                            $term_names[] = $term->name;
                        }
                        $star = implode(', ', $term_names);
                    }
                    // lay so luong phong ngu
                    $pn = '';
                    $terms = get_the_terms($id, 'phong_ngu');
                    if ($terms && !is_wp_error($terms)) {
                        $term_names = array();
                        foreach ($terms as $term) {
                            $term_names[] = $term->name;
                        }
                        $pn = implode(', ', $term_names);
                    }
                    // lay so luong nha tam
                    $nt = '';
                    $terms = get_the_terms($id, 'nha_tam');
                    if ($terms && !is_wp_error($terms)) {
                        $term_names = array();
                        foreach ($terms as $term) {
                            $term_names[] = $term->name;
                        }
                        $nt = implode(', ', $term_names);
                    }
                    // lay dien tich
                    $dt = '';
                    $terms = get_the_terms($id, 'dien_tich');
                    if ($terms && !is_wp_error($terms)) {
                        $term_names = array();
                        foreach ($terms as $term) {
                            $term_names[] = $term->name;
                        }
                        $dt = implode(', ', $term_names);
                    }
                    //   lay gia va gia khuyen mai
                    $regular_price = get_post_meta($id, 'gia', true);
                    $sale_price = get_post_meta($id, 'gia_khuyen_mai', true);
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 ">
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
