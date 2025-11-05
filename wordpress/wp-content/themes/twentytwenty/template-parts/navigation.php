<?php
/**
 * Displays the next and previous post navigation in single-post.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

// Lấy đối tượng bài viết trước và tiếp theo
$prev_post = get_previous_post();
$next_post = get_next_post();

// Chỉ hiển thị nếu có 1 trong 2
if ( $prev_post || $next_post ) {
	?>

	<nav class="pagination-single section-inner" aria-label="<?php esc_attr_e( 'Post', 'twentytwenty' ); ?>" role="navigation">


		<div class="pagination-single-inner">

			<?php if ( $prev_post ) : // Kiểm tra nếu có bài viết TRƯỚC ĐÓ ?>
				<div class="previous-post">
					<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
						<span class="arrow" aria-hidden="true">&larr;</span>
						<span class="title">
							<span class="title-label">Bài viết trước</span>
							<span class="post-data">
								<span class="post-date">
									<span class="day"><?php echo get_the_date( 'd', $prev_post->ID ); ?></span>
									<span class="month-year"><?php echo get_the_date( 'm/y', $prev_post->ID ); ?></span>
								</span>
								<span class="post-title"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span>
							</span>
						</span>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( $next_post ) : // Kiểm tra nếu có bài viết TIẾP THEO ?>
				<div class="next-post">
					<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
						<span class="title">
							<span class="title-label">Bài viết tiếp theo</span>
							<span class="post-data">
								<span class="post-title"><?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?></span>
								<span class="post-date">
									<span class="day"><?php echo get_the_date( 'd', $next_post->ID ); ?></span>
									<span class="month-year"><?php echo get_the_date( 'm/y', $next_post->ID ); ?></span>
								</span>
							</span>
						</span>
						<span class="arrow" aria-hidden="true">&rarr;</span>
					</a>
				</div>
			<?php endif; ?>

		</div></nav><?php
}?>

<style>
.pagination-single {
	border-top: 2px solid #000;
	margin-top: 3em;
	margin-bottom: 3em;
}

/* Tùy chỉnh điều hướng bài viết đơn */
.pagination-single .post-data {
    display: flex;
    align-items: center; /* Căn giữa ngày tháng và tiêu đề */
    gap: 15px; /* Khoảng cách giữa ngày và tiêu đề */
}

/* Định dạng chung cho box ngày tháng */
.pagination-single .post-date {
    text-align: center;
    line-height: 1.2;
    flex-shrink: 0; /* Ngăn không cho co lại khi tiêu đề quá dài */
    width: 50px; /* Cho độ rộng cố định */
}

/* Định dạng số NGÀY */
.pagination-single .post-date .day {
    display: block;
    font-size: 1.9rem; /* Kích thước số ngày */
    font-weight: 700;
    color: #000; /* Màu đen cho số ngày */
}

/* Định dạng THÁNG/NĂM */
.pagination-single .post-date .month-year {
    display: block;
    font-size: 1.2rem; /* Kích thước tháng/năm */
    color: #333; /* Màu đen nhạt hơn cho tháng/năm */
    margin-top: -2px;
}

/* Tùy chỉnh tiêu đề bài viết cho gọn */
.pagination-single .post-title {
    font-weight: 500;
    font-size: 1.7rem;
    line-height: 1.4;
    color: #000; /* Màu đen cho tiêu đề bài viết */
}

/* Đảo ngược thứ tự cho bài viết "Tiếp theo" */
.pagination-single .next-post .post-data {
    flex-direction: row-reverse; /* Đưa ngày tháng sang bên phải */
}

.pagination-single .next-post .title {
    text-align: right; /* Căn phải chữ */
}

/* Điều chỉnh màu chữ cho "Bài viết trước" / "Bài viết tiếp theo" */
.pagination-single .title-label {
    color: #000; /* Màu đen cho label */
    font-weight: bold; /* In đậm hơn */
    font-size: 1.7rem; /* Kích thước chữ */
}

/* Màu mũi tên điều hướng */
.pagination-single .arrow {
    color: #000; /* Màu đen cho mũi tên */
    font-size: 1.7rem; /* Kích thước mũi tên */
    margin-right: 5px; /* Khoảng cách với chữ "Bài viết trước" */
}


/* Điều chỉnh đường gạch ngang (separator) */
.pagination-single hr.styled-separator {
    border: none; /* Xóa border mặc định */
    border-top: 1px solid #ccc; /* Đường gạch mỏng màu xám */
    margin-top: 2.5em; /* Khoảng cách trên */
    margin-bottom: 2.5em; /* Khoảng cách dưới */
    width: 100%; /* Chiều rộng đầy đủ */
    background: none; /* Đảm bảo không có màu nền */
    position: relative;
}

/* Thêm dấu // vào giữa đường gạch */
.pagination-single hr.styled-separator::before {
    content: '//';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff; /* Nền trắng để che đường gạch */
    padding: 0 10px; /* Khoảng cách xung quanh dấu // */
    color: #999; /* Màu của dấu // */
    font-size: 1.2rem;
}

/* Điều chỉnh khoảng cách và căn chỉnh tổng thể */
.pagination-single-inner {
    display: flex;
    justify-content: space-between; /* Đẩy hai phần sang hai bên */
    align-items: center; /* Căn giữa theo chiều dọc */
    padding: 0; /* Bỏ padding mặc định nếu có */
	margin-top: 15px;
}

.pagination-single .previous-post,
.pagination-single .next-post {
    flex: 1; /* Cho phép mỗi bên chiếm một nửa không gian */
}

/* Đảm bảo link không bị đổi màu khi hover */
.pagination-single a:hover .title-label,
.pagination-single a:hover .arrow,
.pagination-single a:hover .post-date .day,
.pagination-single a:hover .post-date .month-year,
.pagination-single a:hover .post-title {
    color: #000; /* Giữ nguyên màu đen khi hover */
    text-decoration: none; /* Bỏ gạch chân khi hover */
}
</style>