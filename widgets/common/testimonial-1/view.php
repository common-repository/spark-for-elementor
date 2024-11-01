<?php
use Themexriver_Addon\Themexriver_Addon_Helper;

$previkn = $settings['previkn'] ? '<div class="txprnx txnxt">' . Themexriver_Addon_Helper::tx_render_icon($settings['previkn']) . '</div>' : '';
$nextikn = $settings['nextikn'] ? '<div class="txprnx txprev">' . Themexriver_Addon_Helper::tx_render_icon($settings['nextikn']) . '</div>' : '';

$quote_icon = Themexriver_Addon_Helper::tx_render_icon($settings['ikn'],'quote-icon');

$slider_options = [
    'speed' => $settings['speed']['size'],
    'item' => $settings['item']['size'],
    'space' => $settings['space']['size'],
    'itemtab' => $settings['itemtab']['size'],
    'auto' => ('yes' === $settings['auto']),
];

$out1 = '';
foreach ($settings['items'] as $item) {
    $rating = $item['rating'] ? '<span class="tscore"><span style="width: ' . $item['rating']['size'] . '%"></span></span>' : '';
    $desc = $item['desc'] ? '<p class="text">' . $item['desc'] . '</p>' : '';
    $img = $item['avatar']['id'] ? '<div class="author-image">' . wp_get_attachment_image($item['avatar']['id'], 'full') . '</div>' : '';
    $name = $item['name'] ? '<h5 class="name">' . $item['name'] . '</h5>' : '';
    $pos = $item['pos'] ? '<p class="pos">' . $item['pos'] . '</p>' : '';

    $out1 .= '
        <div class="swiper-slide">
            <div class="testimonial-block">
                <div class="inner-box">
                    <div class="upper-box">
                        '.$quote_icon.'
                        ' . $rating . '
                        ' . $desc . '
                    </div>
                    <div class="lower-box">
                        ' . $img . '
                        <div class="author-meta">
                        ' . $name . '
                        ' . $pos . '
                        </div>
                    </div>
                </div>
            </div>
        </div>
  ';
}

?>

<?php echo '<div style="display:none;" class="swiper-container testimonial-1 txswiper" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
<div class="swiper-wrapper">
    <?php echo Themexriver_Addon_Helper::tx_build_html($out1); ?>
</div>
<div class="swiper-pagination"></div>
<div class="tx-arrow">
    <?php echo Themexriver_Addon_Helper::tx_build_html($previkn . $nextikn); ?>
</div>
</div>