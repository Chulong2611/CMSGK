<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

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

		$i = 0;

		while (have_posts()) {
			++$i;
			if ($i > 1) {
				//echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part('template-parts/content', get_post_type());
		}
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

</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
