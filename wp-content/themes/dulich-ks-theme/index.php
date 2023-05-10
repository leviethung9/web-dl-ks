<?php get_header(); ?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/Banner.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/banner-du-lich-nicotex.jpg"
                class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/banner-1.jpg" class="d-block w-100"
                alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- content -->
<div class="content w-70 mx-auto my-5">
    <!-- bo loc tour -->
    <div class="filter-box " id="filter-tour">
        <form action="<?php echo esc_url(home_url('/bo-loc-tour/')); ?>" method="get">
            <select name="loai_tour" id="loai_tour" class="form-control items-box-filter">
                <option value="">Loại Tour</option>
                <?php
                $loai_tour = get_terms(
                    array(
                        'taxonomy' => 'loai-tour',
                        'hide_empty' => false,
                    )
                );
                foreach ($loai_tour as $loai) {
                    echo '<option value="' . $loai->slug . '">' . $loai->name . '</option>';
                }
                ?>
            </select>
            <select name="dia_diem" id="dia_diem" class="form-select form-control items-box-filter">
                <option value="">Địa điểm</option>
                <?php
                $terms = get_terms(
                    array(
                        'taxonomy' => 'dia-diem',
                        'hide_empty' => false,
                        'parent' => 0 // Chỉ lấy danh mục cha
                    )
                );
                foreach ($terms as $term) {
                    echo '<option value="' . $term->slug . '">' . $term->name . '</option>';

                    // Lặp qua danh mục con của danh mục cha hiện tại
                    $child_terms = get_terms(
                        array(
                            'taxonomy' => 'dia-diem',
                            'hide_empty' => false,
                            'parent' => $term->term_id
                        )
                    );
                    foreach ($child_terms as $child_term) {
                        echo '<option value="' . $child_term->slug . '">&nbsp;&nbsp;&nbsp;' . $child_term->name . '</option>';
                    }
                }
                ?>
            </select>

            <div class="items-box-filter">
                <button type="submit" class="btn-loc">Lọc tour</button>
            </div>
            <input type="hidden" name="filter" value="true">

        </form>

    </div>
    <!-- section 1 -->
    <section class="section1 py-3">
        <div class="row ">
            <div class="col-12">
                <h3 class="text-center color-black2 py-2">Địa điểm nổi bật </h3>
            </div>
        </div>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'dia-diem-noi-bat',
                'posts_per_page' => 6,
            );

            $data_ddnb = new WP_Query($args);

            if ($data_ddnb->have_posts()) {
                while ($data_ddnb->have_posts()) {
                    $data_ddnb->the_post();

                    // Lấy thông tin ảnh đại diện
                    $id = get_the_ID();
                    $name = get_the_title();
                    $image_id = get_post_meta($id, 'hinh_anh', true);
                    $image_url = wp_get_attachment_url($image_id);

                    ?>
                    <div class="col-lg-2 col-md-4 col-sm-12 ">
                        <div class="box-ddnb">
                            <img src="<?php echo $image_url; ?>" alt="" class="img-fluid w-100">
                            <h3>
                                <?php echo $name ?>
                            </h3>
                        </div>

                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </section>
    <!-- section 1 end -->
</div>

<!-- section 2 -->
<div class="section2">
    <section class=" py-5 w-70 mx-auto">
        <div class="title-section">
            <h3 class="py-3">Tour nổi bật</h3>
        </div>
        <div class="row">
            <!-- lay ra danh sach tour noi bat -->
            <?php
            $args = array(
                'post_type' => 'tour-dl',
                'posts_per_page' => 8,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'noi-bat',
                        'field' => 'slug',
                        'terms' => 'co'
                    )
                )
            );

            $custom_query = new WP_Query($args);

            ?>
            <?php if ($custom_query->have_posts()) { ?>
                <?php while ($custom_query->have_posts()) {
                    $custom_query->the_post(); ?>
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
            <?php } ?>
        </div>
    </section>
</div>
<!-- section 2 end-->

<!-- section 3 -->
<section class="section3 my-5">
    <div class="w-70 mx-auto">
        <div class="row">
            <div class="col-6">
                <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/Frame-3150-min.png" class="img-fluid">
            </div>
            <div class="col-6">
                <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/Frame-3151-min.png" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<!-- section 3 end-->

<section class="section4 ">
    <div class="w-70 mx-auto py-5">
        <!-- bo loc tour -->
        <div class="filter-box " id="filter-hotel">
            <form action="<?php echo esc_url(home_url('/bo-loc-hotel/')); ?>" method="get">
                <select name="star" id="star" class="form-control items-box-filter">
                    <option value="">Loại khách sạn</option>
                    <?php
                    $term = get_terms(
                        array(
                            'taxonomy' => 'star',
                            'hide_empty' => false,
                        )
                    );
                    foreach ($term as $loai) {
                        echo '<option value="' . $loai->slug . '">' . $loai->name . '</option>';
                    }
                    ?>
                </select>
                <select name="phong_ngu" id="phong_ngu" class="form-control items-box-filter">
                    <option value="">Phòng ngủ</option>
                    <?php
                    $term = get_terms(
                        array(
                            'taxonomy' => 'phong_ngu',
                            'hide_empty' => false,
                        )
                    );
                    foreach ($term as $loai) {
                        echo '<option value="' . $loai->slug . '">' . $loai->name . '</option>';
                    }
                    ?>
                </select>
                <select name="nha_tam" id="nha_tam" class="form-control items-box-filter">
                    <option value="">Nhà tắm</option>
                    <?php
                    $term = get_terms(
                        array(
                            'taxonomy' => 'nha_tam',
                            'hide_empty' => false,
                        )
                    );
                    foreach ($term as $loai) {
                        echo '<option value="' . $loai->slug . '">' . $loai->name . '</option>';
                    }
                    ?>
                </select>
                <select name="dien_tich" id="dien_tich" class="form-control items-box-filter">
                    <option value="">Diện tích</option>
                    <?php
                    $term = get_terms(
                        array(
                            'taxonomy' => 'dien_tich',
                            'hide_empty' => false,
                        )
                    );
                    foreach ($term as $loai) {
                        echo '<option value="' . $loai->slug . '">' . $loai->name . '</option>';
                    }
                    ?>
                </select>
                <div class="items-box-filter">
                    <button type="submit" class="btn-loc">Lọc Hotel</button>
                </div>
                <input type="hidden" name="filter" value="true">

            </form>

        </div>
        <div class="row">
            <h3 class="color-black2 text-center text-capitalize"> Khách sạn nổi bật </h3>
        </div>
        <div class="row py-5">
            <?php
            $args = array(
                'post_type' => 'hotel',
                'posts_per_page' => 8,
            );

            $data_hotel = new WP_Query($args);

            if ($data_hotel->have_posts()) {
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

                    <div class="col-lg-3 col-md-6 col-sm-12 my-2">
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
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</section>
<section class="section6 pt-5 pb-5">
    <div class="w-70 py-2 mx-auto">
        <div class="row">
            <div class="col-12">
                <h3 class="color-black2">Phản hồi của khách hàng</h3>
            </div>
        </div>
        <div class="row st-feedback">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="item">
                    <p class="st-content">
                        “Tôi cảm thấy vô cùng hài lòng về dịch vụ của ên bẹn, chát lượng và giá cả khá hợp lý,
                        tôi sẽ ủng hộ lâu dài ...” </p>
                    <div class="author-meta">
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <div class="name">Trần Văn Kiên</div>
                        <p class="office-testimonial">Nhân viên văn phòng</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="item">
                    <p class="st-content">
                        “Tôi cảm thấy vô cùng hài lòng về dịch vụ của ên bẹn, chát lượng và giá cả khá hợp lý,
                        tôi sẽ ủng hộ lâu dài ...” </p>
                    <div class="author-meta">

                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <div class="name">Trần Văn Kiên</div>
                        <p class="office-testimonial">Nhân viên văn phòng</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="item">
                    <p class="st-content">
                        “Tôi cảm thấy vô cùng hài lòng về dịch vụ của ên bẹn, chát lượng và giá cả khá hợp lý,
                        tôi sẽ ủng hộ lâu dài ...” </p>
                    <div class="author-meta">
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <i class="review-testimonial fa-solid fa-star"></i>
                        <div class="name">Trần Văn Kiên</div>
                        <p class="office-testimonial">Nhân viên văn phòng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section7 py-2 mx-auto w-70 d-none d-lg-block">
    <div class="row bg-gray">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/Rectangle-7-min-2.png" alt=""
                class="img-fluid ww-100">
        </div>
        <div class="col-6 position-relative">
            <div class="box-form-lh">
                <h3 class="py-2 color-black2"> Đăng ký nhận thông tin </h3>
                <?php echo do_shortcode('[contact-form-7 id="124" title="Form liên hệ 1"]'); ?>
            </div>
        </div>
    </div>
</section>
<section class="section7 position-relative py-2 mx-auto w-70 d-block d-lg-none">
    <div class="row ">
        <div class="col-12">
            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/Rectangle-7-min-2.png" alt=""
                class="img-fluid ww-100">
                <div class="overlay"></div>
            <div class="box-form-lh">
                <h3 class="py-2 text-white"> Đăng ký nhận thông tin </h3>
                <?php echo do_shortcode('[contact-form-7 id="124" title="Form liên hệ 1"]'); ?>
            </div>

        </div>
    </div>
</section>

<!-- st bai viet -->
<section class="st-post bg-gray">
    <div class="w-70 row mx-auto">
        <div class="col-12">
            <h3 class="title color-black2 text-center"> Bài viết - tin tức </h3>
        </div>
        <?php
        $query = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DESC'
            )
        );
        ?>

        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()):
                $query->the_post(); ?>
                <?php
                $post_id = get_the_ID();
                $post = get_post($post_id);
                $link = get_permalink();
                $thumbnail_url = get_the_post_thumbnail_url($post_id);
                $title = $post->post_title;
                $date = get_the_date('', $post_id);
                // $excerpt = wp_trim_words($post->post_excerpt, 30, '...');
        
                ?>
                <div class="col-lg-3 col-md-6 col-sm-12">
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
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>

<!-- st bai viet end -->
<!-- content end -->
<?php get_footer(); ?>