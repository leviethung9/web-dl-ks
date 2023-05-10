<div class="footer bg-gray">
            <div class="row w-70 mx-auto">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="ft-title">
                        <h3>Thông tin</h3>
                    </div>
                    <div class="ft-content">
                        <ul class="menu-ft">
                            <li> <a href="">Địa chỉ: Mỹ Đình - Nam Từ liêm - Hà Nội</a> </li>
                            <li> <a href="">Sdt: 0123.456.789</a> </li>
                            <li> <a href="">Email: Demo@gamil.com</a> </li>
                            <li> <a href="">Zalo: 0366.963.369</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="ft-title">
                        <h3>Hỗ trợ</h3>
                    </div>
                    <div class="ft-content">
                        <ul class="menu-ft">
                            <li> <a href="">Giới thiệu</a> </li>
                            <li> <a href="">Liên hệ</a> </li>
                            <li> <a href="">Thỏa thuận</a> </li>
                            <li> <a href="">Quy định - hỗ trợ</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="ft-title">
                        <h3>Tour</h3>
                    </div>
                    <div class="ft-content">
                        <ul class="menu-ft">
                            <li> <a href="">Tour bình dân</a> </li>
                            <li> <a href="">tour VIP</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="ft-title">
                        <h3>Đến với chúng tôi</h3>
                    </div>
                    <div class="ft-content">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14896.507261626179!2d105.75876931470043!3d21.0276112187979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454bab9b67e93%3A0xbbe16aced529963f!2zTeG7uSDEkMOsbmgsIE5hbSBU4burIExpw6ptLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1683627159352!5m2!1svi!2s"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="row w-70 ft-coppyright mx-auto">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h5 class="text-coppyright">© Copyright Traveler 2022</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="box-items-bank">
                        <img src="http://localhost/dulich-ks/wp-content/uploads/2023/05/Frame-3182-4.svg" alt=""
                            class="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- code finish here -->
    <script>
        jQuery(document).ready(function ($) {
            $('#loai_tour').select2({
                placeholder: 'Chọn loại tour',
                allowClear: true,
                minimumResultsForSearch: 1,
                // width: '100%'
            });
            $('#dia_diem').select2({
                placeholder: 'Chọn địa điểm',
                allowClear: true,
                minimumResultsForSearch: 1,
                // width: '100%'
            });
            $('#star').select2({
                placeholder: 'Loại hotel ',
                allowClear: true,
                minimumResultsForSearch: 1,
                // width: '100%'
            });
            $('#phong_ngu').select2({
                placeholder: 'Phòng ngủ ',
                allowClear: true,
                minimumResultsForSearch: 1,
                // width: '100%'
            });
            $('#nha_tam').select2({
                placeholder: 'Nhà tắm ',
                allowClear: true,
                minimumResultsForSearch: 1,
                // width: '100%'
            });
            $('#dien_tich').select2({
                placeholder: 'Diện tích ',
                allowClear: true,
                minimumResultsForSearch: 1,
                // width: '100%'
            });
        });
        
    </script>

    <script src="<?php echo get_template_directory_uri() . '/assets/js/index.js' ?>"></script>
    <script src="<?php echo get_template_directory_uri() . '/assets/js/slider.js' ?>"></script>
    <?php wp_footer()?>
    <a id="back-to-top" href="#">Top</a>

</body>

</html>