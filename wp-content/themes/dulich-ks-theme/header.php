<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"
        integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- cdn jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- cdn select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/core.css' ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/reponsive.css' ?>">
    <title>
        <?php echo get_page_title_by_slug(); ?>
    </title>
    <?php wp_head(); ?>
</head>

<body>
    <!-- coder start here -->
    <div class="container-fluid">
        <!-- header -->
        <div class="header ">
            <div class="hd-top bg-green1 w-100">
                <div class="hd-top-content w-70 mx-auto d-flex justify-content-between align-items-center">
                    <div class="slogan">
                        <h5 class="text-white"> Mẫu website du lịch - khách sạn </h5>
                    </div>
                    <div class="menu-top">
                        <?php
                        // Gọi menu ra trang web
                        wp_nav_menu(
                            array(
                                'theme_location' => 'top-menu',
                                'container' => 'nav',
                                'container_class' => 'top-menu'
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="hd-main w-100">
                <div class="hd-main-content w-70 mx-auto d-flex justify-content-between align-items-center">
                    <div class="logo py-5">
                        <a href="<?php echo home_url(); ?>">
                            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/logohotel.png" alt=""
                                srcset="">
                        </a>

                    </div>
                    <div class="hd-search">
                        <form role="search" method="get" class="d-flex " action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="search" placeholder="Nhập từ khóa" class="form-control" name="s"
                                value="<?php echo get_search_query(); ?>">
                            <button type="submit" class="btn btn-primary"> <i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="hotline">
                        <img src="http://localhost/dulich-ks/wp-content/uploads/2023/04/hotline.svg" alt="">
                        <div class="hotline-text">
                            <h5 class="text-black">1900 1088</h5>
                            <p class="text-black">Tổng đài miễn phí</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hd-bottom bg-green1 w-100">
                <div class="hd-bottom-content w-70 mx-auto d-flex justify-content-between align-items-center">
                    <div class="main-menu">
                        <?php
                        // Gọi menu ra trang web
                        wp_nav_menu(
                            array(
                                'theme_location' => 'main-menu',
                                'container' => 'nav',
                                'container_class' => 'main-menu'
                            )
                        );
                        ?>
                    </div>
                    <div class="hd-btn">
                        <a href="http://localhost/dulich-ks/dang-ky/" class="btn  btn-danger">Đăng ký</a>
                        <a href="http://localhost/dulich-ks/wp-login.php" class="btn  btn-primary">Đăng nhập</a>
                    </div>
                </div>
            </div>
            <!-- header mobile -->
            <div class="hd-main-mb w-100">
                <div class=" w-70 mx-auto d-flex justify-content-between align-items-center">
                    <div class="col-4">
                    <button class="openbtn" onclick="openNav()"> <i class="fa-solid fa-bars"></i></button>
                        <div class="box-nav-mb" id="menu-mb">
                            <a href="" class="btn-hide-nav" onclick="closeNav()">X</a>
                            <div class="main-menu-mb">
                                <?php
                                // Gọi menu ra trang web
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'main-menu',
                                        'container' => 'nav',
                                        'container_class' => 'main-menu-mb'
                                    )
                                );
                                ?>
                            </div>
                            <div class="hd-search">
                        <form role="search" method="get" class="d-flex " action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="search" placeholder="Nhập từ khóa" class="form-control" name="s"
                                value="<?php echo get_search_query(); ?>">
                            <button type="submit" class="btn btn-primary"> <i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <a href="<?php echo home_url(); ?>">
                            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/logohotel.png" alt=""
                                srcset="">
                        </a>
                    </div>
                    <div class="col-4">
                        <div class="hotline">
                            <img src="http://localhost/dulich-ks/wp-content/uploads/2023/04/hotline.svg" alt="">
                            <div class="hotline-text">
                                <h5 class="text-black">1900 1088</h5>
                                <p class="text-black">Tổng đài miễn phí</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header end -->