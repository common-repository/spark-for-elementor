<?php
use Themexriver_Addon\Themexriver_Addon_Helper;
$query_args = [
    'post_type' => 'courses',
    'posts_per_page' => 7,
    'tax_query' => [
        [
            'taxonomy' => 'course-category',
            'field' => 'term_id',
            'terms' => $settings['cat'],
        ],
    ],
];
$loop = new \WP_Query($query_args);
?>
<div class="tx-course-grid-wrap">
<?php if ($loop->have_posts()) : ?>
	<?php while ($loop->have_posts()) : $loop->the_post(); ?>

        <div class="inner-box">
            <div class="image">
                <a href="course-detail.html"><img class="transition-500ms" src="assets/images/resource/course-21.jpg" alt=""></a>
                <div class="category">Neutrition</div>
            </div>
            <div class="lower-content">
                <div class="rating">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <i>(108)</i>
                </div>
                <h6><a href="course-detail.html"><?php the_title();?></a></h6>
                <div class="price">$29.00<span>$29.00</span></div>
            </div>
        </div>

	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php endif;?>
</div>