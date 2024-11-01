<?php
use Themexriver_Addon\Themexriver_Addon_Helper;


$slider_options = [
    'speed' => $settings['speed']['size'],
    'invert' => ('yes' === $settings['invert']),
];

$out1 = '';
foreach ($settings['items'] as $item) {
    $rating = $item['rating'] ? '<span class="tscore"><span style="width: ' . $item['rating']['size'] . '%"></span></span>' : '';
    $desc = $item['desc'] ? '<p class="text">' . $item['desc'] . '</p>' : '';
    $img = $item['avatar']['id'] ? '<div class="author-image">' . wp_get_attachment_image($item['avatar']['id'], 'full') . '</div>' : '';
    $name = $item['name'] ? '<span class="name">' . $item['name'] . '</span>' : '';
    $pos = $item['pos'] ? '<span class="pos">' . $item['pos'] . '</span>' : '';

    $out1 .= '
        <div class="testimonial-block-two">
            <div class="inner-box">
                <div class="innerr">
                    '.$img.'
                    <div class="content">
                        '.$rating.'
                        '.$desc.'
                        <div class="author">'.$name.$pos.'</div>
                    </div>
                </div>
            </div> 
        </div>
    ';
}

?>

<?php echo '<div class="tx-scroll-feedback" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
    <?php echo Themexriver_Addon_Helper::tx_build_html($out1);?>
</div>
