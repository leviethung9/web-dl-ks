<?php get_header(); ?>
<!-- content -->
<div class="banner-page">
    <h1 class="banner-page-title"> Hotel </h1>
</div>
<div class="content list-tour w-70 mx-auto">
    <div class="row ">
        <div class="col-4">
            <div class="widget">
                <form action="" method="get" class="d-flex">
                    <input type="text" placeholder="Nhập từ khóa" class="form-control">
                    <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div class="widget">
                <h3 class=""> Loại khách sạn </h3>
                <form action="/action_page.php">
                    <?php
                        $star = get_terms(
                            array(
                                'taxonomy' => 'star',
                                'hide_empty' => false,
                            )
                        );
                    ?>
                    <?php foreach($star as $items): ?>
                    <input type="checkbox" id="<?php echo $items->slug ?>" name="<?php echo $items->slug ?>" value="<?php echo $items->name ?>">
                    <label for="<?php echo $items->slug ?>"> <?php echo $items->name ?></label><br>
                    <?php endforeach; ?>
                    <input type="submit" value="Lọc" class="btn btn-primary">
                </form>
            </div>
            <div class="widget">
                <h3 class=""> Loại nhà tắm </h3>
                <form action="/action_page.php">
                    <?php
                        $nha_tam = get_terms(
                            array(
                                'taxonomy' => 'nha_tam',
                                'hide_empty' => false,
                            )
                        );
                    ?>
                    <?php foreach($nha_tam as $items): ?>
                    <input type="checkbox" id="<?php echo $items->slug ?>" name="<?php echo $items->slug ?>" value="<?php echo $items->name ?>">
                    <label for="<?php echo $items->slug ?>"> <?php echo $items->name ?></label><br>
                    <?php endforeach; ?>
                    <input type="submit" value="Lọc" class="btn btn-primary">
                </form>
            </div>
            <div class="widget">
                <h3 class=""> Diện tích </h3>
                <form action="/action_page.php">
                    <?php
                        $dien_tich = get_terms(
                            array(
                                'taxonomy' => 'dien_tich',
                                'hide_empty' => false,
                            )
                        );
                    ?>
                    <?php foreach($dien_tich as $items): ?>
                    <input type="checkbox" id="<?php echo $items->slug ?>" name="<?php echo $items->slug ?>" value="<?php echo $items->name ?>">
                    <label for="<?php echo $items->slug ?>"> <?php echo $items->name ?></label><br>
                    <?php endforeach; ?>
                    <input type="submit" value="Lọc" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="col-8">
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
                            <?php
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>

        </div>
    </div>
</div>
<!-- content -->
<?php get_footer() ?>