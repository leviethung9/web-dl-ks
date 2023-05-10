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
        <div class="meta-tour">
            <h1 class="name">
                <?php
                $name_tour = get_field('ten');
                echo $name_tour;
                ?>
            </h1>

        </div>
        <div class="tour-info">
            <div class="tour-date">
                <i class="fa-regular fa-clock"></i>
                <?php
                $time_tour = get_field('thoi_gian');
                echo $time_tour;
                ?>
            </div>
            <div class="tour-price color-red1">
                <i class="fa-solid fa-money-bill"></i>
                <?php
                $gia_tour = get_field('gia');

                if ($gia_tour) {
                    $formatted_gia = number_format($gia_tour, 0, ',', '.') . ' VNĐ';
                    echo $formatted_gia;
                }
                ?>
            </div>
        </div>
        <div class="des-tour">
            <?php
            $des_tour = get_field('mo_ta_chi_tiet');

            if ($des_tour) {
                $formatted_des = wpautop($des_tour);
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
                    $hhvt_ndd = get_field('hhvt_ndd');
                    echo $hhvt_ndd;
                    ?>
                </p>
                <p>
                    Hotline:
                    <?php
                    $hotline = get_field('hotline');
                    echo $hotline;
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
<div class="row w-70 mx-auto my-2">
    <div class="col-12">
        <h3> Tour liên quan </h3>
    </div>
    <?php
    $dia_diem_terms = get_the_terms(get_the_ID(), 'dia-diem');
    if ($dia_diem_terms && !is_wp_error($dia_diem_terms)) {
        $dia_diem_ids = array();
        foreach ($dia_diem_terms as $term) {
            $dia_diem_ids[] = $term->term_id;
        }

        $args = array(
            'post_type' => 'tour-dl',
            // Thay 'your_custom_post_type' bằng tên của custom post type của bạn
            'posts_per_page' => 4,
            // Số lượng bài viết liên quan tối đa
            'tax_query' => array(
                array(
                    'taxonomy' => 'dia-diem',
                    'field' => 'term_id',
                    'terms' => $dia_diem_ids,
                    'operator' => 'IN',
                ),
            ),
            'post__not_in' => array(get_the_ID()), // Loại trừ bài viết hiện tại
        );

        $related_query = new WP_Query($args);

        if ($related_query->have_posts()) {
            while ($related_query->have_posts()) {
                $related_query->the_post();
                ?>
                <?php
                // lay thong tin tour
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
                <div class="col-lg-3 col-md-6 col-sm-12 ">
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

                            </div>
                            <div class="button">
                                <a href="<?php echo $link ?>">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php wp_reset_postdata(); ?>
        <?php }
    }
    ?>


</div>
<!-- content -->
<?php get_footer() ?>