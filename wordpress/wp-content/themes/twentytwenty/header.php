<?php

/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php
	wp_body_open();
	?>

	<header id="site-header" class="header-footer-group">

		<div class="header-inner section-inner">

			<div class="header-titles-wrapper">

				<?php

				// Check whether the header search is activated in the customizer.
				$enable_header_search = get_theme_mod('enable_header_search', true);

				if (true === $enable_header_search) {

				?>

					<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg('search'); ?>
							</span>
							<span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
						</span>
					</button><!-- .search-toggle -->

				<?php } ?>

				<div class="header-titles">

					<?php
					// Site title or logo.
					twentytwenty_site_logo();

					// Site description.
					twentytwenty_site_description();
					?>

				</div><!-- .header-titles -->

				<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg('ellipsis'); ?>
						</span>
						<span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
					</span>
				</button><!-- .nav-toggle -->

			</div><!-- .header-titles-wrapper -->

			<!-- Search Form -->
			<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
				<input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s">
				<button type="submit">Submit</button>
			</form>

			<div class="header-navigation-wrapper">

				<?php
				if (has_nav_menu('primary') || ! has_nav_menu('expanded')) {
				?>

					<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Horizontal', 'menu', 'twentytwenty'); ?>">

						<ul class="primary-menu reset-list-style">

							<?php
							if (has_nav_menu('primary')) {

								wp_nav_menu(
									array(
										'container'  => '',
										'items_wrap' => '%3$s',
										'theme_location' => 'primary',
									)
								);
							} elseif (! has_nav_menu('expanded')) {

								wp_list_pages(
									array(
										'match_menu_classes' => true,
										'show_sub_menu_icons' => true,
										'title_li' => false,
										'walker'   => new TwentyTwenty_Walker_Page(),
									)
								);
							}
							?>

						</ul>

					</nav><!-- .primary-menu-wrapper -->

				<?php
				}

				if (true === $enable_header_search || has_nav_menu('expanded')) {
				?>

					<div class="header-toggles hide-no-js">

						<?php
						if (has_nav_menu('expanded')) {
						?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg('ellipsis'); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

						<?php
						}

						if (true === $enable_header_search) {
						?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php twentytwenty_the_theme_svg('search'); ?>
										<span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

						<?php
						}
						?>

					</div><!-- .header-toggles -->
				<?php
				}
				?>

			</div><!-- .header-navigation-wrapper -->
			<!-- <div class="account">
				<i class="fa-solid fa-user-circle"></i>
				Account
				<i class="fa-solid fa-chevron-down"></i>
				<div class="account-dropdown">
					<a href="#">Login</a>
					<a href="#">Register</a>
					<a href="#">Logout</a>
				</div>
			</div> -->
			<div class="account">
				<i class="fa fa-user-circle"></i>
				<?php if (is_user_logged_in()) :
					$current_user = wp_get_current_user();
				?>
					<span><?php echo esc_html($current_user->display_name); ?> <i class="fa fa-chevron-down"></i></span>
					<div class="account-dropdown">
						<a href="<?php echo esc_url(admin_url()); ?>">Trang quản trị</a>
						<a href="<?php echo esc_url(get_edit_user_link()); ?>">Hồ sơ</a>
						<a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Đăng xuất</a>
					</div>
				<?php else : ?>
					<span>Account <i class="fa fa-chevron-down"></i></span>
					<div class="account-dropdown">
						<a href="<?php echo esc_url(wp_login_url()); ?>">Đăng nhập</a>
						<a href="<?php echo esc_url(wp_registration_url()); ?>">Đăng ký</a>
					</div>
				<?php endif; ?>
			</div>



		</div><!-- .header-inner -->

		<?php
		// Output the search modal (if it is activated in the customizer).
		if (true === $enable_header_search) {
			get_template_part('template-parts/modal-search');
		}
		?>

	</header><!-- #site-header -->
	<style>
		/* Style cho form tìm kiếm */
		.search-form {
			display: flex;
			gap: 8px;
			/* tạo khoảng cách giữa input và button */
		}

		.search-form input[type="search"] {
			height: 38px;
			padding: 0 12px;
			border: 1px solid #ccc;
			border-radius: 6px;
			outline: none;
			font-size: 14px;
		}

		.search-form button {
			height: 38px;
			padding: 0 16px;
			background: #f8f8f8;
			color: #333;
			border: 1px solid #ccc;
			border-radius: 6px;
			cursor: pointer;
			font-size: 14px;
			font-weight: 600;
			white-space: nowrap;
			/* không cho xuống dòng */
			display: flex;
			align-items: center;
			/* căn giữa dọc */
			justify-content: center;
			/* căn giữa ngang */
			transition: background 0.2s, color 0.2s;
		}

		.search-form button:hover {
			background: #eee;
			color: #000;
		}

		/* --- Account bên phải --- */
		.account {
			display: flex;
			flex-direction: column;
			/* icon trên, text dưới */
			align-items: center;
			justify-content: center;
			position: relative;
			cursor: pointer;
			color: #444;
			font-weight: 500;
			transition: color 0.3s ease;
			min-width: 70px;
			margin-top: 20px;
		}

		.account:hover {
			color: #000;
		}

		.account i {
			font-size: 20px;
			margin-bottom: 4px;
		}

		.account span {
			font-size: 14px;
			display: flex;
			align-items: center;
		}

		.account .fa-chevron-down {
			font-size: 10px;
			margin-left: 4px;
		}

		/* --- Dropdown --- */
		.account-dropdown {
			display: block;
			opacity: 0;
			visibility: hidden;
			position: absolute;
			top: 60px;
			right: 0;
			background: #fff;
			border: 1px solid #ddd;
			border-radius: 6px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
			min-width: 150px;
			transform: translateY(-5px);
			transition: all 0.25s ease;
		}

		.account-dropdown a {
			display: block;
			padding: 10px 14px;
			color: #333;
			text-decoration: none;
		}

		.account-dropdown a:hover {
			background: #f2f2f2;
		}

		.account:hover .account-dropdown {
			opacity: 1;
			visibility: visible;
			transform: translateY(0);
		}
	</style>

	<?php
	// Output the menu modal.
	get_template_part('template-parts/modal-menu');
