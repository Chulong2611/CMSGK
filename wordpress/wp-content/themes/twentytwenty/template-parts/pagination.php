<?php
/**
 * Displays the posts pagination.
 * Ghi đè file của theme cha để hiển thị kiểu phân trang đầy đủ.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Child
 * @since 1.0.0
 */

// Lấy global $wp_query
global $wp_query;

// Chỉ hiển thị nếu có nhiều hơn 1 trang
if ( $wp_query->max_num_pages > 1 ) {
    ?>
    <nav class="pagination-wrapper" aria-label="<?php esc_attr_e( 'Posts navigation', 'twentytwenty' ); ?>">
        <?php
        // Sử dụng hàm the_posts_pagination với cài đặt tùy chỉnh
        the_posts_pagination(
            array(
                'mid_size'           => 5, // Hiển thị 5 số trang ở giữa 
                'prev_text'          => '<span class="arrow" aria-hidden="true">&larr;</span><span class="screen-reader-text">' . __( 'Previous page', 'twentytwenty' ) . '</span>',
                'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'twentytwenty' ) . '</span><span class="arrow" aria-hidden="true">&rarr;</span>',
                'screen_reader_text' => ' ', // Ẩn chữ "Posts navigation"
            )
        );
        ?>
    </nav>
    <?php
}
?>
<style>
/* ========================================= */
/* === CSS TÙY CHỈNH PHÂN TRANG (PAGINATION) === */
/* ========================================= */

/* Bọc ngoài toàn bộ - căn giữa và điều chỉnh margin */
.pagination-wrapper {
    margin: 4rem 0; /* Khoảng cách trên dưới */
    text-align: center; /* Căn giữa nội dung bên trong */
}

/* Thẻ <nav> chứa các link */
.pagination {
    border: none;
    background: none;
    border-radius: 0;
    padding: 0;
    margin: 0;
    display: inline-block; /* Để nó có thể căn giữa bằng text-align của cha */
}

/* Vùng chứa link <ul> */
.nav-links {
    display: flex; /* Sử dụng flexbox để các mục nằm trên 1 hàng */
    border: 1px solid #ddd;
    border-radius: 30px; /* Bo tròn như hình mẫu */
    overflow: hidden; /* Đảm bảo các góc được bo */
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

/* Các mục link (số trang, prev, next) */
.nav-links .page-numbers {
    display: block;
    padding: 10px 15px; /* Giảm padding một chút cho gọn */
    border-right: 1px solid #eee;
    text-decoration: none;
    color: #555;
    font-size: 1.5rem; /* Giảm font size một chút cho gọn */
    font-weight: 500;
    background: #fff;
    transition: background-color 0.2s ease, color 0.2s ease;
}

/* Bỏ viền phải của mục cuối cùng */
.nav-links .page-numbers:last-child {
    border-right: none;
}

/* Các link <, > */
.nav-links .prev,
.nav-links .next {
    font-size: 1.8rem; /* Mũi tên to hơn một chút */
    padding: 10px 15px; /* Điều chỉnh padding cho mũi tên */
}

/* Dấu '...' */
.nav-links .dots {
    padding-top: 13px; /* Căn chỉnh cho dấu ... */
    background: #fafafa;
    border-right: 1px solid #eee; /* Thêm lại viền phải cho dấu ... */
}

/* Khi hover */
.nav-links .page-numbers:hover:not(.current) {
    background-color: #f5f5f5;
    color: #000;
}

/* Trang hiện tại (CURRENT) */
.nav-links .page-numbers.current {
    background-color: #007bff; /* Màu xanh như hình mẫu */
    color: #fff;
    font-weight: bold;
    border-color: #007bff; /* Đường viền cùng màu */
}

/* Căn chỉnh mũi tên */
.nav-links .arrow {
    line-height: 1;
}

/* Ẩn text cho screen reader */
.nav-links .screen-reader-text {
    display: none;
}
</style>