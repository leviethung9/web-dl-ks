<?php get_header(); ?>
<!-- content -->
<div class="banner-page">
    <h1 class="banner-page-title"> Tour Du Lịch </h1>
</div>
<div class="content list-tour w-70 mx-auto">
    <div class="row ">
        <div class="col-3">
            <div class="widget">
                <form action="" method="get" class="d-flex">
                    <input type="text" placeholder="Nhập từ khóa" class="form-control">
                    <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div class="widget">
                <h3 class=""> Loại Tour </h3>
                <form action="<?php echo esc_url(home_url('/bo-loc-tour/')); ?>" method="get">
                    <?php
                        $loai_tour = get_terms(
                            array(
                                'taxonomy' => 'loai-tour',
                                'hide_empty' => false,
                            )
                        );
                    ?>
                    <?php foreach($loai_tour as $items): ?>
                    <input type="checkbox" id="<?php echo $items->slug ?>" name="<?php echo $items->slug ?>" value="<?php echo $items->name ?>">
                    <label for="<?php echo $items->slug ?>"> <?php echo $items->name ?></label><br>
                    <?php endforeach; ?>
                    <input type="submit" value="Lọc" class="btn btn-primary">
                </form>
            </div>
            <div class="widget">
                <h3 class=""> Địa điểm </h3>
                <form action="<?php echo esc_url(home_url('/bo-loc-tour/')); ?>" method="get">
                    <?php
                        $dia_diem = get_terms(
                            array(
                                'taxonomy' => 'dia-diem',
                                'hide_empty' => false,
                            )
                        );
                    ?>
                    <?php foreach($dia_diem as $items): ?>
                    <input type="checkbox" id="<?php echo $items->slug ?>" name="<?php echo $items->slug ?>" value="<?php echo $items->name ?>">
                    <label for="<?php echo $items->slug ?>"> <?php echo $items->name ?></label><br>
                    <?php endforeach; ?>
                    <input type="submit" value="Lọc" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <?php
                $args = array(
                    'post_type' => 'tour-dl',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

                $tours = get_posts($args);

                foreach ($tours as $tour):
                    setup_postdata($tour);

                    $id = $tour->ID;
                    $link = get_permalink($id);
                    $name = get_post_meta($id, 'ten', true);
                    $image_id = get_post_meta($id, 'anh_dai_dien', true);
                    $image_url = wp_get_attachment_url($image_id);
                    $time = get_post_meta($id, 'thoi_gian', true);
                    $gia = get_post_meta($id, 'gia', true);
                    $gia_formatted = number_format($gia, 0, '.', ',');
                    $gia_sanitized = wp_kses($gia_formatted . ' VND', array());
                    ?>
                    <div class="col-4">
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
                <?php endforeach;
                wp_reset_postdata();
                ?>
            </div>

        </div>
    </div>
</div>
<!-- content -->
<?php get_footer() ?>