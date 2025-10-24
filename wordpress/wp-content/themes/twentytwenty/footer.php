<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<!-- Footer -->
<section id="footer">
	<div class="container">
		<div class="row text-center text-xs-center text-sm-left text-md-left">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<h5>CMS</h5>
				<ul class="list-unstyled quick-links">
					<li><a href="http://localhost:8333/"><i class="fa fa-angle-double-right"></i>Trang chủ</a></li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<ul class="list-unstyled quick-links">
					<?php
					// Hiển thị 5 bài viết mới nhất trong footer
					the_widget(
						'WP_Widget_Recent_Posts',
						array(
							'title'  => 'Bài viết mới nhất', // tiêu đề widget
							'number' => 5                     // số lượng bài viết muốn hiển thị
						),
						array(
							'before_widget' => '<div class="widget_recent_posts">', // thẻ bao quanh widget
							'after_widget'  => '</div>',
							'before_title'  => '<h5 class="widget-title">',         // thẻ tiêu đề
							'after_title'   => '</h5>'
						)
					);
					?>
					<!-- <li><a href="http://localhost:8080/wp-admin/index.php"><i class="fa fa-angle-double-right"></i>Dashboard</a></li>
						<li><a href="http://localhost:8080/wp-admin/post-new.php"><i class="fa fa-angle-double-right"></i>Add post</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Videos</a></li> -->
				</ul>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<ul class="list-unstyled quick-links">
					<?php
					// Hiển thị 5 bình luận gần đây trong footer
					the_widget(
						'WP_Widget_Recent_Comments',
						array(
							'title'  => 'Bình luận gần đây',
							'number' => 5
						),
						array(
							'before_widget' => '<div class="widget_recent_comments">',
							'after_widget'  => '</div>',
							'before_title'  => '<h5 class="widget-title">',
							'after_title'   => '</h5>'
						)
					);
					?>
					<!-- <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
						<li><a href="https://wwwe.sunlimetech.com" title="Design and developed by"><i class="fa fa-angle-double-right"></i>Imprint</a></li> -->
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
				<ul class="list-unstyled list-inline social text-center">
					<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa-brands fa-facebook-f"></i></a></li>
					<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa-brands fa-twitter"></i></a></li>
					<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa-brands fa-instagram"></i></a></li>
					<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa-brands fa-google-plus-g"></i></a></li>
					<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02" target="_blank"><i class="fa fa-envelope"></i></a></li>
				</ul>
			</div>

		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
				<p><u><a href="https://www.nationaltransaction.com/">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
				<p class="h6">© All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a></p>
			</div>
			<hr>
		</div>
	</div>
</section>
<!-- ./Footer -->


<?php wp_footer(); ?>

</body>

<style>
	/* bai viet moi nhat*/
	.widget_recent_posts ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Thêm icon Font Awesome 7 trước mỗi tiêu đề bài viết trong widget */
.widget_recent_posts ul li::before {
    font-family: "Font Awesome 7 Free";
    font-weight: 700; /* solid */
    content: "\f101"; /* fa-angles-right */
    color: #fff;
    background-color: #00785c;
    padding: 4px 6px;
    border-radius: 3px;
    margin-right: 8px;
    font-size: 1em;
    transition: all 0.3s ease;
}

/* Thêm icon Font Awesome 7 trước mỗi comment trong widget */
.widget_recent_comments ul li::before {
    font-family: "Font Awesome 7 Free";
    font-weight: 900; /* solid */
    content: "\f101"; /* fa-angles-right */
    color: #fff;
    background-color: #00785c;
    padding: 4px 6px;
    border-radius: 3px;
    margin-right: 8px;
    font-size: 1em;
    transition: all 0.3s ease;
}

</style>

</html>