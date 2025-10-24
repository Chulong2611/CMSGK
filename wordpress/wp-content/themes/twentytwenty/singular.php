<?php

/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" style="background-color: #fff;">

    <?php

    // if ( have_posts() ) {

    // 	while ( have_posts() ) {
    // 		the_post();

    // 		get_template_part( 'template-parts/content', get_post_type() );
    // 	}
    // }

    ?>

    <div class="container single-container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-11 col-sm-12">

                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-content'); ?>>

                            <h1 class="single-post-title mb-4"><?php the_title(); ?></h1>

                            <div class="single-post-meta text-muted mb-3">
                                <span><i class="fas fa-user"></i> <?php the_author(); ?></span> &nbsp;|&nbsp;
                                <span><i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                            </div>

                            <div class="single-post-body">
                                <?php the_content(); ?>
                            </div>

                        </article>
                <?php
                    endwhile;
                else :
                    echo '<p>Không tìm thấy bài viết.</p>';
                endif;
                ?>

            </div>
        </div>


        <style>
            .single-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 40px 15px;
                background-color: #fff;
            }

            .single-post-title {
                font-size: 28px;
                font-weight: bold;
                color: #222;
                margin-bottom: 20px;
            }

            .single-post-meta {
                font-size: 14px;
                color: #777;
                margin-bottom: 25px;
            }

            .single-post-body {
                font-size: 16px;
                line-height: 1.8;
                color: #333;
            }

            /* ✅ Căn giữa ảnh và khung figure */
            .single-post-body figure,
            .single-post-body img {
                display: block;
                margin: 25px auto;
                text-align: center;
                max-width: 100%;
                height: auto;
                border-radius: 6px;
                /* Bo nhẹ góc ảnh */
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
                /* Bóng nhẹ */
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                /* Hiệu ứng hover mượt */
            }

            /* ✅ Hiệu ứng khi hover ảnh */
            .single-post-body img:hover {
                transform: scale(1.02);
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            }

            /* ✅ Chú thích ảnh */
            .single-post-body figcaption,
            .single-post-body .wp-caption-text {
                font-size: 14px;
                font-style: italic;
                color: #666;
                text-align: center;
                margin-top: 5px;
                line-height: 1.5;
            }

            /* ✅ Cải thiện khoảng cách trong bài viết */
            .single-post-body p {
                margin-bottom: 1.2rem;
            }

            .single-post-body h2,
            .single-post-body h3,
            .single-post-body h4 {
                margin-top: 2rem;
                margin-bottom: 1rem;
                color: #222;
            }

            .single-post-body a {
                color: #0073aa;
                text-decoration: none;
            }

            .single-post-body a:hover {
                text-decoration: underline;
            }
        </style>

        <!--  Hiển thị bài viết liên quan -->
        <?php
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array_map(function ($cat) {
                return $cat->term_id;
            }, $categories);

            $related_posts = new WP_Query([
                'category__in'   => $category_ids,
                'post__not_in'   => [$post->ID],
                'posts_per_page' => 5,
                'ignore_sticky_posts' => 1,
            ]);

            if ($related_posts->have_posts()) :
        ?>
                <div class="related-posts container my-5">
                    <h3 class="related-title">BÀI VIẾT LIÊN QUAN</h3>
                    <ul class="related-list">
                        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                            <li class="related-item">
                                <span class="related-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    <?php echo get_the_date('d F, Y'); ?>
                                </span>
                                <a href="<?php the_permalink(); ?>" class="related-link">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
        <?php
                wp_reset_postdata();
            endif;
        }
        ?>

        
        <?php
        // Hiển thị khung bình luận
        if (comments_open() || get_comments_number()) :
            ?>
    <div class="post-comments container my-5">
        <?php comments_template(); ?>
    </div>
<?php
        endif;
        ?>

    </div> <!-- .end container -->
</main><!-- #site-content -->




<style>
    .related-posts {
        border-top: 2px solid #222;
        color: #222;
    }

    .related-title {
        text-align: center;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 25px;
        color: #222;
        letter-spacing: 1px;
    }

    .related-list {
        list-style: none;
        padding: 0;
        margin: 0 auto;
        max-width: 700px;
    }

    .related-item {
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .related-item:last-child {
        border-bottom: none;
    }

    .related-date {
        font-size: 13px;
        white-space: nowrap;
        min-width: 130px;
        display: inline-block;
    }

    .related-link {
        color: #222;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .related-link:hover {
        font-weight: 700;
        /* In đậm tiêu đề bài viết */
    }
</style>

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
