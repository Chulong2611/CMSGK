<?php

/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

    <!-- === BẮT ĐẦU CẤU TRÚC 3 CỘT MỚI === -->
    <div class="homepage-layout-container section-inner">

        <!-- CỘT 1: SIDEBAR TRÁI -->
        <aside id="homepage-sidebar-left" class="widget-area">
            <div class="pages-list-widget">
                <h3 class="widget-title">Tìm hiểu thêm</h3>
                <?php
                $args = array(
                    'post_type'      => 'page',       // Chỉ lấy Pages
                    'posts_per_page' => 3,            // Giới hạn 3
                    'orderby'        => 'rand',       // Sắp xếp ngẫu nhiên
                );

                $custom_pages_query = new WP_Query($args);

                if ($custom_pages_query->have_posts()) :
                    echo '<ul>';
                    while ($custom_pages_query->have_posts()) :
                        $custom_pages_query->the_post();
                ?>

                        <li class="page-item-with-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="page-item-thumbnail">
                                        <?php the_post_thumbnail('thumbnail'); // Lấy thumbnail size nhỏ 
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <span class="page-item-title"><?php the_title(); ?></span>
                            </a>
                        </li>

                <?php
                    endwhile;
                    echo '</ul>';
                else :
                    // Không tìm thấy trang nào
                    echo '<p>Không tìm thấy trang.</p>';
                endif;

                // Khôi phục lại dữ liệu post gốc
                wp_reset_postdata();
                ?>
            </div>
        </aside>

        <!-- CỘT 2: NỘI DUNG CHÍNH (Code của bạn) -->
        <div class="homepage-main-content" style="margin: 60px 0;">

            <?php
            $archive_title    = '';
            $archive_subtitle = '';

            if (is_search()) {
                /**
                 * @global WP_Query $wp_query WordPress Query object.
                 */
                global $wp_query;

                $archive_title = sprintf(
                    '%1$s %2$s',
                    '<span class="color-accent">' . __('Search:', 'twentytwenty') . '</span>',
                    '&ldquo;' . get_search_query() . '&rdquo;'
                );

                if ($wp_query->found_posts) {
                    $archive_subtitle = sprintf(
                        /* translators: %s: Number of search results. */
                        _n(
                            'We found %s result for your search.',
                            'We found %s results for your search.',
                            $wp_query->found_posts,
                            'twentytwenty'
                        ),
                        number_format_i18n($wp_query->found_posts)
                    );
                } else {
                    $archive_subtitle = __('We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty');
                }
            } elseif (is_archive() && ! have_posts()) {
                $archive_title = __('Nothing Found', 'twentytwenty');
            } elseif (! is_home()) {
                $archive_title    = get_the_archive_title();
                $archive_subtitle = get_the_archive_description();
            }

            if ($archive_title || $archive_subtitle) {
            ?>
                <header class="archive-header has-text-align-center header-footer-group">
                    <div class="archive-header-inner section-inner medium">
                        <?php if ($archive_title) { ?>
                            <h1 class="archive-title"><?php echo wp_kses_post($archive_title); ?></h1>
                        <?php } ?>
                        <?php if ($archive_subtitle) { ?>
                            <div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post(wpautop($archive_subtitle)); ?></div>
                        <?php } ?>
                    </div><!-- .archive-header-inner -->
                </header><!-- .archive-header -->
            <?php
            }

            if (have_posts()) {

                echo '<div class="search-results-grid">';
                $i = 0;
                while (have_posts()) {
                    ++$i;
                    if ($i > 1) {
                        // echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
                    }
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                }
                echo '</div>';
            } elseif (is_search()) {
            ?>
                <div class="no-search-results-form section-inner ">
                    <div class="container">
                        <br />
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <form role="search" method="get" class="card card-sm" action="<?php echo esc_url(home_url('/')); ?>">
                                    <div class="card-body row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <i class="fas fa-search h4 text-body"></i>
                                        </div>
                                        <div class="col">
                                            <input
                                                class="form-control form-control-lg form-control-borderless"
                                                type="search"
                                                name="s"
                                                placeholder="Search topics or keywords"
                                                value="<?php echo get_search_query(); ?>"
                                                required>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-lg btn-success" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end of col-->
                        </div>
                    </div>
                    <style>
                        /* Vùng tổng thể */
                        .container {
                            padding: 30px 0;
                        }

                        /* Card bọc ngoài form */
                        .card.card-sm {
                            border: none;
                            border-radius: 50px;
                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                            transition: all 0.3s ease-in-out;
                            overflow: hidden;
                        }

                        /* Hiệu ứng hover mượt */
                        .card.card-sm:hover {
                            transform: translateY(-3px);
                            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
                        }

                        /* Vùng chứa bên trong */
                        .card-body {
                            padding: 12px 20px;
                            background-color: #fff;
                            border-radius: 50px;
                        }

                        /* Icon kính lúp */
                        .card-body i {
                            color: #888;
                            font-size: 20px;
                            transition: color 0.3s ease;
                        }

                        .card-body i:hover {
                            color: #007bff;
                        }

                        /* Ô input */
                        .form-control-borderless {
                            border: none !important;
                            outline: none;
                            background: transparent;
                            box-shadow: none;
                            transition: all 0.3s ease;
                            font-size: 16px;
                            color: #333;
                        }

                        /* Khi focus vào input */
                        .form-control-borderless:focus {
                            box-shadow: none;
                            background-color: #f9f9f9;
                            border-radius: 30px;
                            padding-left: 10px;
                        }

                        /* Nút search */
                        .btn-success {
                            background: linear-gradient(135deg, #28a745, #20c997);
                            border: none;
                            border-radius: 30px;
                            padding: 10px 25px;
                            font-weight: 600;
                            color: #fff;
                            transition: all 0.3s ease;
                        }

                        /* Hover nút search */
                        .btn-success:hover {
                            background: linear-gradient(135deg, #20c997, #28a745);
                            transform: scale(1.05);
                            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
                        }

                        /* Responsive nhỏ */
                        @media (max-width: 768px) {
                            .card-body {
                                flex-direction: column;
                                text-align: center;
                            }

                            .btn-success {
                                width: 100%;
                                margin-top: 10px;
                            }
                        }
                    </style>
                </div><!-- .no-search-results -->
            <?php
            }
            ?>

            <?php get_template_part('template-parts/pagination'); ?>


        </div> <!-- .homepage-main-content -->

    </div> <!-- .homepage-layout-container -->
    <!-- === KẾT THÚC CẤU TRÚC 3 CỘT === -->

    <!-- ========================================= -->
    <!-- === SECTION LATEST NEWS THEO DÒNG THỜI GIAN === -->
    <section class="latest-news-timeline-section">
        <div class="latest-news-container">
            <h2 class="timeline-section-title">Bài viết mới nhất</h2>
            <?php
            // Truy vấn 3 bài viết 'post' mới nhất
            $latest_posts_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $latest_posts_query = new WP_Query($latest_posts_args);

            if ($latest_posts_query->have_posts()) :
            ?>
                <ul class="timeline-list">
                    <?php
                    while ($latest_posts_query->have_posts()) :
                        $latest_posts_query->the_post();
                    ?>
                        <li class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <h3 class="timeline-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <span class="timeline-date"><?php echo get_the_date('j F, Y'); ?></span>
                                </div>
                                <div class="timeline-excerpt">
                                    <?php
                                    // Hiển thị đoạn trích ngắn
                                    echo wp_trim_words(get_the_excerpt(), 25, '...');
                                    ?>
                                </div>
                            </div>
                        </li>
                    <?php
                    endwhile;
                    ?>
                </ul>
            <?php
            else :
                // Thông báo nếu không có bài viết nào
                echo '<p>Chưa có bài viết nào.</p>';
            endif;

            // Khôi phục lại dữ liệu post gốc
            wp_reset_postdata();
            ?>
        </div>
    </section>

</main><!-- #site-content -->

<style>
    main#site-content {
        padding-top: 40px;
        padding-bottom: 0;
    }

    /* ========================================= */
    /* === BỐ CỤC TRANG CHỦ 3 CỘT === */
    /* ========================================= */

    /* Chỉ áp dụng cho màn hình lớn (desktop) */
    @media (min-width: 1200px) {
        /* Tăng breakpoint cho 3 cột */

        /* Mở rộng không gian nội dung để chứa sidebar */
        .home .section-inner {
            max-width: 140rem;
            /* 1400px */
        }

        /* Tạo bố cục 3 cột bằng CSS Grid */
        .home .homepage-layout-container {
            display: grid;
            /* Sidebar Trái | Nội dung | Sidebar Phải */
            grid-template-columns: 300px 1fr 300px;
            gap: 4rem;
            /* Khoảng cách giữa các cột */
        }

        /* Căn lề cho các sidebar */
        #homepage-sidebar-left,
        #homepage-sidebar-right {
            margin-top: 5rem;
            /* Căn chỉnh với bài viết đầu tiên */
        }


    }

    /* Trên di động (dưới 1200px), các cột sẽ tự động xếp chồng */

    /* ========================================= */
    /* === WIDGET BÊN TRÁI (BÀI VIẾT TRONG THÁNG) === */
    /* ========================================= */

    #homepage-sidebar-left .widget_child_monthly_posts .widget-title {
        font-size: 2.4rem;
        font-weight: 800;
        color: #333;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        position: relative;
        text-transform: capitalize;
    }

    /* Đường gạch chéo */
    #homepage-sidebar-left .widget_child_monthly_posts .widget-title::after {
        content: '';
        display: block;
        width: 100%;
        height: 5px;
        background-image: repeating-linear-gradient(-45deg,
                #ccc,
                #ccc 2px,
                transparent 2px,
                transparent 4px);
        position: absolute;
        bottom: 0;
        left: 0;
    }

    /* Danh sách <ol> */
    #homepage-sidebar-left .monthly-posts-widget-list {
        list-style: none;
        /* Bỏ list-style mặc định */
        margin: 0;
        border: 1px solid #eee;
        background: #fff;
        padding: 10px 15px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);

        /* Dùng CSS counter để đếm */
        counter-reset: post-counter;
        padding-left: 45px;
        /* Tạo không gian cho số thứ tự */


    }

    /* Từng mục <li> */
    #homepage-sidebar-left .monthly-posts-widget-list li {
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 1.6rem;
        line-height: 1.4;
        position: relative;

        /* Tăng biến đếm */
        counter-increment: post-counter;


    }

    #homepage-sidebar-left .monthly-posts-widget-list li:last-child {
        border-bottom: none;
    }

    /* Hiển thị số thứ tự (STT) */
    #homepage-sidebar-left .monthly-posts-widget-list li::before {
        /* Hiển thị biến đếm */
        content: counter(post-counter, decimal-leading-zero);
        /* 01, 02, 03... */
        position: absolute;
        left: -30px;
        /* Đặt số thứ tự vào khoảng trống */
        top: 50%;
        transform: translateY(-50%);
        font-weight: bold;
        font-size: 1.5rem;
        color: #aaa;
    }

    /* Tiêu đề bài viết */
    #homepage-sidebar-left .monthly-posts-widget-list li a {
        text-decoration: none;
        color: #444;
        font-weight: 500;
    }

    #homepage-sidebar-left .monthly-posts-widget-list li a:hover {
        color: #000;
    }

    /* ========================================= */
    /* === WIDGET BÊN PHẢI (BÌNH LUẬN TÙY CHỈNH) === */
    /* ========================================= */

    /* ID của widget mới là 'child_custom_comments' */
    #homepage-sidebar-right .widget_child_custom_comments .widget-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        position: relative;
        text-transform: capitalize;
        background-image: none !important;
    }

    /* Đường gạch ngang ĐƠN GIẢN dưới tiêu đề (như Hình 2) */
    #homepage-sidebar-right .widget_child_custom_comments .widget-title::after {
        content: '';
        display: block;
        width: 100%;
        height: 5px;
        background-image: repeating-linear-gradient(-45deg,
                #ccc,
                #ccc 2px,
                transparent 2px,
                transparent 4px);
        position: absolute;
        bottom: 0;
        left: 0;
    }

    /* Kiểu cho danh sách bình luận đã cắt ngắn (HTML từ PHP) */
    #homepage-sidebar-right .custom-recent-comments {
        list-style: none;
        /* Bỏ list-style mặc định */
        margin: 0;
        border: 1px solid #eee;
        background: #fff;
        padding: 10px 15px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    /* Mỗi mục bình luận */
    #homepage-sidebar-right .custom-recent-comment-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        /* Đường gạch mỏng giữa các item */
        font-size: 1.6rem;
        line-height: 1.4;
    }

    #homepage-sidebar-right .custom-recent-comment-item:last-child {
        border-bottom: none;
    }

    /* Link bình luận */
    #homepage-sidebar-right .custom-recent-comment-item a {
        text-decoration: none;
        color: #007bff;
        /* Màu xanh link như Hình 2 */
        font-weight: bold;
    }

    #homepage-sidebar-right .custom-recent-comment-item a:hover {
        text-decoration: underline;
        /* Gạch chân khi hover */
    }

    /* ========================================= */
    /* === BỐ CỤC TRANG SEARCH (2 CỘT) === */
    /* ========================================= */
    @media (min-width: 1000px) {

        /* Mở rộng không gian nội dung */
        .search .section-inner {
            max-width: 140rem;
        }

        /* Tạo bố cục 2 cột bằng CSS Grid */
        /* (Trang search sẽ có class 'search' ở thẻ body) */
        .search .homepage-layout-container {
            display: grid;
            /* Sidebar Trái | Nội dung */
            grid-template-columns: 300px 1fr;
            gap: 4rem;
        }
    }

    /* Trên di động (dưới 1000px), các cột sẽ tự động xếp chồng */

    /* ========================================= */
    /* === WIDGET DANH SÁCH PAGES BÊN TRÁI === */
    /* ========================================= */

    #homepage-sidebar-left .pages-list-widget .widget-title {
        font-size: 2.4rem;
        font-weight: 800;
        color: #333;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        position: relative;
        text-transform: capitalize;
    }

    /* Đường gạch chéo */
    #homepage-sidebar-left .pages-list-widget .widget-title::after {
        content: '';
        display: block;
        width: 100%;
        height: 5px;
        background-image: repeating-linear-gradient(-45deg,
                #ccc,
                #ccc 2px,
                transparent 2px,
                transparent 4px);
        position: absolute;
        bottom: 0;
        left: 0;
    }

    /* Danh sách <ul> */
    #homepage-sidebar-left .pages-list-widget ul {
        list-style: none;
        margin: 0;
        padding: 0;
        border: 1px solid #eee;
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    /* Từng mục <li> */
    #homepage-sidebar-left .pages-list-widget li.page-item-with-thumbnail {
        padding: 0;
        margin: 0;
        border-bottom: 1px solid #f0f0f0;
    }

    #homepage-sidebar-left .pages-list-widget li.page-item-with-thumbnail:last-child {
        border-bottom: none;
    }

    /* Thẻ <a> bọc ngoài */
    #homepage-sidebar-left .pages-list-widget li.page-item-with-thumbnail a {
        display: flex;
        /* Đây là chìa khóa */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        padding: 12px 15px;
        text-decoration: none;
        color: #444;
        font-weight: 500;
        font-size: 1.6rem;
        transition: background-color 0.2s ease;
    }

    #homepage-sidebar-left .pages-list-widget li.page-item-with-thumbnail a:hover {
        background-color: #f9f9f9;
        color: #000;
    }

    /* Vùng chứa thumbnail */
    #homepage-sidebar-left .page-item-thumbnail {
        flex-shrink: 0;
        /* Không co lại */
        width: 60px;
        /* Kích thước thumbnail */
        height: 60px;
        margin-right: 15px;
        border-radius: 4px;
        overflow: hidden;
    }

    /* Thẻ <img> của thumbnail */
    #homepage-sidebar-left .page-item-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Đảm bảo ảnh lấp đầy khung */
    }

    /* Tiêu đề trang */
    #homepage-sidebar-left .page-item-title {
        line-height: 1.4;
    }


    /* ========================================= */
    /* === TIMELINE BÀI VIẾT MỚI NHẤT === */
    /* ========================================= */

    .latest-news-timeline-section {
        width: 100%;
        padding: 40px 0;
        /* Tạo khoảng cách với phần trên */
        border-top: 1px solid #eee;
        /* Đường kẻ mờ phân cách */
        margin-top: 40px;
    }

    .latest-news-container {
        /* Căn giữa và giới hạn 2/3 chiều rộng */
        width: 66.66%;
        /* Giới hạn thêm để không quá rộng trên màn hình lớn */
        max-width: 900px;
        margin: 0 auto;
    }

    .timeline-section-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
    }

    .timeline-list {
        list-style: none;
        margin: 0;
        position: relative;
        /* Dùng để căn đường line */
    }

    /* Đường line dọc (trục timeline) */
    .timeline-list::before {
        content: '';
        position: absolute;
        top: 10px;
        /* Bắt đầu sau dấu chấm đầu tiên */
        bottom: 10px;
        /* Kết thúc trước dấu chấm cuối cùng */
        left: 27px;
        /* Căn giữa với dấu chấm (8px - 1px) */
        width: 2px;
        background-color: #00aaff;
        /* Màu xanh_ */
        opacity: 0.5;
        z-index: 1;
    }

    .timeline-item {
        position: relative;
        padding-left: 35px;
        /* Không gian cho dấu chấm */
        margin-bottom: 35px;
    }

    /* Dấu chấm tròn */
    .timeline-item .timeline-dot {
        position: absolute;
        left: 0;
        top: 5px;
        /* Căn với dòng tiêu đề */
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: #fff;
        border: 3px solid #00aaff;
        /* Màu xanh */
        z-index: 2;
        /* Nằm trên đường line */
    }

    /* Tiêu đề và Ngày */
    .timeline-content .timeline-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        /* Căn trên cùng */
        margin-bottom: 5px;
    }

    .timeline-content .timeline-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.4;
    }

    .timeline-content .timeline-title a {
        text-decoration: none;
        color: #00aaff;
        /* Màu xanh */
    }

    .timeline-content .timeline-title a:hover {
        text-decoration: underline;
    }

    .timeline-content .timeline-date {
        font-size: 1.4rem;
        color: #999;
        flex-shrink: 0;
        /* Không bị co lại */
        padding-left: 15px;
        /* Khoảng cách với tiêu đề */
        white-space: nowrap;
        /* Không xuống dòng */
    }

    /* Đoạn trích */
    .timeline-content .timeline-excerpt {
        font-size: 1.5rem;
        color: #555;
        line-height: 1.5;
    }

    /* Responsive (cho thiết bị nhỏ hơn) */
    @media (max-width: 900px) {
        .latest-news-container {
            width: 90%;
            /* Chiếm 90% trên tablet */
        }
    }

    @media (max-width: 600px) {
        .latest-news-container {
            width: 95%;
            /* Gần full trên mobile */
        }

        /* Trên mobile, đưa ngày xuống dưới tiêu đề */
        .timeline-content .timeline-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .timeline-content .timeline-date {
            padding-left: 0;
            margin-top: 5px;
            color: #777;
        }
    }
</style>
<?php
get_footer();
