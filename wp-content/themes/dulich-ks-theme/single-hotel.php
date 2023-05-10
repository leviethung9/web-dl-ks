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

    <div class="col-9">
        <div class="content-page page-tour">
            <!-- Slider album ảnh -->
            <div id="imageSlider" class="w3-content" style="">
                <?php
                $album_images = get_field('album_anh');
                ?>
                <?php if ($album_images): ?>
                    <?php foreach ($album_images as $key => $image): ?>
                        <img class="mySlides w-100 img-fluid" src="<?php echo esc_url($image['url']) ?>"
                            onclick="openModal(<?php echo $key; ?>)">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="w3-center">
                <div class="w3-section">
                    <button class="w3-button w3-light-grey" onclick="plusDivs(-1)">❮ Prev</button>
                    <button class="w3-button w3-light-grey" onclick="plusDivs(1)">Next ❯</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Hình ảnh</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openModal(slideIndex) {
                var slides = $('#imageSlider .mySlides');
                var modalImage = $('#modalImage');

                if (slides.length > slideIndex) {
                    var imageURL = slides.eq(slideIndex).attr('src');
                    modalImage.attr('src', imageURL);
                    $('#imageModal').modal('show');
                }
            }
        </script>
        <!-- end slider -->
        <div class="meta-hotel">
            <h1 class="name">
                <?php
                $name_hotel = get_field('ten');
                echo $name_hotel;
                ?>
            </h1>

        </div>
        <div class="hotel-info">
            <div class="hotel-star">
                <?php
                // Lấy ID của bài viết hiện tại
                $post_id = get_the_ID();

                // Lấy danh sách thuộc tính của taxonomy "star" cho bài viết hiện tại
                $terms = get_the_terms($post_id, 'star');

                // Kiểm tra xem có thuộc tính tồn tại không
                if (!empty($terms) && !is_wp_error($terms)) {
                    // Lặp qua từng thuộc tính
                    foreach ($terms as $term) {
                        // Lấy tên của thuộc tính
                        $term_name = $term->name;
                        // In ra tên thuộc tính
                        echo  '<i class="fa-solid fa-star color-yellow1 icon-star"></i>'. $term_name;
                    }
                }
                ?>

            </div>
            <div class="tour-price color-red1">
                <i class="fa-solid fa-money-bill"></i>
                <?php
                $gia_goc = get_field('gia');

                if ($gia_goc) {
                    $formatted_gia = number_format($gia_goc, 0, ',', '.') . ' VNĐ';
                    echo $formatted_gia;
                }
                ?>
            </div>
            <div class="tour-price color-red1">
                <i class="fa-solid fa-money-bill"></i>
                <?php
                $gia_km = get_field('gia_khuyen_mai');

                if ($gia_km) {
                    $formatted_gia = number_format($gia_km, 0, ',', '.') . ' VNĐ';
                    echo $formatted_gia;
                }
                ?>
            </div>
            <div class="box-pn">
            <?php
                // Lấy ID của bài viết hiện tại
                $post_id = get_the_ID();

                // Lấy danh sách thuộc tính của taxonomy "star" cho bài viết hiện tại
                $terms = get_the_terms($post_id, 'phong_ngu');

                // Kiểm tra xem có thuộc tính tồn tại không
                if (!empty($terms) && !is_wp_error($terms)) {
                    // Lặp qua từng thuộc tính
                    foreach ($terms as $term) {
                        // Lấy tên của thuộc tính
                        $term_name = $term->name;
                        // In ra tên thuộc tính
                        echo  '<i class="fa-solid fa-bed pd-icon"></i>'. $term_name;
                    }
                }
                ?>
            </div>
            <div class="box-nt">
            <?php
                // Lấy ID của bài viết hiện tại
                $post_id = get_the_ID();

                // Lấy danh sách thuộc tính của taxonomy "star" cho bài viết hiện tại
                $terms = get_the_terms($post_id, 'nha_tam');

                // Kiểm tra xem có thuộc tính tồn tại không
                if (!empty($terms) && !is_wp_error($terms)) {
                    // Lặp qua từng thuộc tính
                    foreach ($terms as $term) {
                        // Lấy tên của thuộc tính
                        $term_name = $term->name;
                        // In ra tên thuộc tính
                        echo  '<i class="fa-solid fa-restroom pd-icon"></i>'. $term_name;
                    }
                }
                ?>
            </div>
            <div class="box-dt">
            <?php
                // Lấy ID của bài viết hiện tại
                $post_id = get_the_ID();

                // Lấy danh sách thuộc tính của taxonomy "star" cho bài viết hiện tại
                $terms = get_the_terms($post_id, 'dien_tich');

                // Kiểm tra xem có thuộc tính tồn tại không
                if (!empty($terms) && !is_wp_error($terms)) {
                    // Lặp qua từng thuộc tính
                    foreach ($terms as $term) {
                        // Lấy tên của thuộc tính
                        $term_name = $term->name;
                        // In ra tên thuộc tính
                        echo  '<i class="fa-solid fa-s pd-icon"></i>'. $term_name;
                    }
                }
                ?>
            </div>
            <div class="box-address">
            <?php
                $hotel_address = get_field('dia_chi');
                echo '<i class="fa-solid fa-location-dot"></i>' . $hotel_address;
                
                ?>
            </div>
        </div>
        <div class="des-hotel">
            <?php
            $des_hotel = get_field('chi_tiet');

            if ($des_hotel) {
                $formatted_des = wpautop($des_hotel);
                echo $formatted_des;
            }
            ?>
        </div>

        <!-- Add wpDiscuz comments template -->
        <div id="comments" class="comments-area">
            <?php comments_template(); ?>
        </div>
    </div>
    <div class="col-3">
        <div class="widget">
            <p class="short-des-tour">
                <?php
                $mo_ta_ngan = get_field('mo_ta_ngan');

                if ($mo_ta_ngan) {
                    $formatted_des = wpautop($mo_ta_ngan);
                    echo $formatted_des;
                }
                ?>

            </p>
        </div>
        <div class="widget">
            <div class="box-info-people">
                <h3 class="color-red1"> Thông tin chi tiết liên hệ </h3>
                <p>
                    Họ và tên:
                    <?php
                    $ten_nv = get_field('ten_nv');
                    echo $ten_nv;
                    ?>
                </p>
                <p>
                    Hotline:
                    <?php
                    $sdt = get_field('sdt');
                    echo $sdt;
                    ?>
                </p>
                <p>
                    Email:
                    <?php
                    $email = get_field('email');
                    echo $email;
                    ?>
                </p>
                <?php
                $image_id = get_post_meta(get_the_ID(), 'avatar', true);
                $image_url = wp_get_attachment_url($image_id);
                $hhvt_ndd = get_the_title();
                ?>

                <p>
                    <?php if ($image_url): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($hhvt_ndd); ?>"
                            class="img-fluid img-thumbnail">
                    <?php endif; ?>
                </p>


            </div>
        </div>
    </div>
</div>
<div class="row w-70 mx-auto my-2 hotel-lq">
    <div class="col-12">
        <h3> Hotel liên quan </h3>
    </div>
    <?php
$star_terms = get_the_terms(get_the_ID(), 'star');
if ($star_terms && !is_wp_error($star_terms)) {
    $star_ids = array();
    foreach ($star_terms as $term) {
        $star_ids[] = $term->term_id;
    }

    $args = array(
        'post_type' => 'hotel',
        'posts_per_page' => 4,
        'tax_query' => array(
            array(
                'taxonomy' => 'star',
                'field' => 'term_id',
                'terms' => $star_ids,
                'operator' => 'IN',
            ),
        ),
        'post__not_in' => array(get_the_ID()),
    );

    $related_query = new WP_Query($args);

    if ($related_query->have_posts()) {
        while ($related_query->have_posts()) {
            $related_query->the_post();

            $id = get_the_ID();
            $link = get_the_permalink();
            $name = get_the_title();
            $image_id = get_post_meta($id, 'anh_dai_dien', true);
            $image_url = wp_get_attachment_url($image_id);

            // Lấy thông tin star
            $star = '';
            $terms = get_the_terms($id, 'star');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                $star = implode(', ', $term_names);
            }

            // Lấy thông tin phòng ngủ
            $pn = '';
            $terms = get_the_terms($id, 'phong_ngu');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                $pn = implode(', ', $term_names);
            }

            // Lấy thông tin nhà tắm
            $nt = '';
            $terms = get_the_terms($id, 'nha_tam');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                $nt = implode(', ', $term_names);
            }

            // Lấy thông tin diện tích
            $dt = '';
            $terms = get_the_terms($id, 'dien_tich');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                $dt = implode(', ', $term_names);
            }

            // Lấy thông tin giá và giá khuyến mãi
            $regular_price = get_post_meta($id, 'gia', true);
            $sale_price = get_post_meta($id, 'gia_khuyen_mai', true);
            ?>

            <div class="col-lg-3 col-md-6 col-sm-12 my-2">
                <div class="box-hotel">
                    <a href="<?php echo $link ?>">
                    <img src="<?php echo $image_url ?>" alt="<?php echo $name ?>" class="img-fluid w-100">
                    </a>
                    <div class="hotel-content">
                        <h5 class="py-2 hotel-type">Loại khách sạn: <span><?php echo $star ?></span></h5>
                        <h3 class="hotel-name py-2"><?php echo $name ?></h3>
                        <p class="py-1"><i class="fa-solid fa-bed"></i> <span><?php echo $pn ?></span></p>
                        <p class="py-1"><i class="fa-solid fa-bath"></i> <span><?php echo $nt ?></span></p>
                        <p class="py-1"><i class="fa-solid fa-s"></i> <span><?php echo $dt ?></span></p>
                    </div>
                    <div class="hotel-price">
                        <h4 class="">
                            Giá gốc:
                            <span class="regular-price"><?php echo number_format($regular_price, 0, ',', '.') . ' vnđ' ?></span>
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
        }
        wp_reset_postdata();
    }
}
?>
</div>
<?php get_footer() ?>