<?php
// Bắt đầu cấu trúc mới cho danh sách bài viết (trang chủ, danh mục, tìm kiếm,...)
if (! is_singular()) :
?>
	<div class="container">
		<article <?php post_class('custom-post-item'); ?> id="post-<?php the_ID(); ?>">

			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="full-link-wrap" style="text-decoration: none; color: inherit;">

				<div class="custom-post-wrap">
					
					<div class="custom-post-date">
						<div class="day-large">
							<?php the_time('d'); ?>
						</div>
						<div class="month-small">
							<?php
							// Lấy Tháng bằng số và thêm chữ THÁNG (Tiếng Việt)
							echo 'THÁNG ' . get_the_time('m');
							?>
						</div>
					</div>

					<div class="custom-post-divider"></div>

					<div class="custom-post-content">
						<h2 class="entry-title">
							<?php the_title(); ?>
						</h2>
						<div class="entry-excerpt">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</a>
		</article>
	</div>


<?php
endif; // Kết thúc is_singular()
?>

<style>
	/* Bố cục chính */
	.custom-post-wrap {
		display: flex;
		align-items: stretch;
		border: 1px solid #ddd;
		margin-bottom: 20px;
		background: #fff;
		text-decoration: none;
		padding: 15px 20px;
	}

	/* Ô ngày-tháng */
	.custom-post-date {
		width: 80px;
		text-align: center;
		font-family: Arial, sans-serif;
		padding-right: 10px;
	}

	.custom-post-date .day-large {
		font-size: 36px;
		font-weight: bold;
		color: #222;
		line-height: 1;
	}

	.custom-post-date .month-small {
		font-size: 12px;
		color: #666;
		margin-top: 5px;
		text-transform: uppercase;
	}

	/* Vạch chia dọc */
	.custom-post-divider {
		width: 1px;
		background: #ccc;
		margin: 0 15px;
	}

	/* Nội dung bên phải */
	.custom-post-content {
		flex: 1;
	}

	.custom-post-content .entry-title {
		font-size: 16px;
		font-weight: bold;
		margin: 0 0 6px;
		color: #1e5799;
		/* xanh đậm */
		text-transform: uppercase;
	}

	.custom-post-content .entry-excerpt {
		font-size: 13px;
		color: #444;
		line-height: 1.5;
	}

	/* Responsive */
	@media (max-width: 768px) {
		.custom-post-wrap {
			flex-direction: column;
			padding: 15px;
		}

		.custom-post-date {
			text-align: left;
			margin-bottom: 10px;
			width: auto;
		}

		.custom-post-divider {
			display: none;
		}

		.custom-post-content .entry-title {
			font-size: 15px;
		}
	}
</style>