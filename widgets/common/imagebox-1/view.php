<?php
use Themexriver_Addon\Themexriver_Addon_Helper;

$slider_options = [
    'speed' => $settings['speed']['size'],
    'invert' => ('yes' === $settings['invert']),
];

$out1 = '';
foreach ($settings['items'] as $item) {

    $img = $item['img']['id'] ? '<div class="image">' . wp_get_attachment_image($item['img']['id'], 'full','',["class" => "txtransition"]) . '</div>' : '';
    $theme = $item['clr'] ? 'style="background:'.$item['clr'].';"' : '';
    $pre = $item['pre'] ? '<div '.$theme.' class="lessons">' . $item['pre'] . '</div>' : '';
    $pos = $item['pos'] ? '<span class="pos">' . $item['pos'] . '</span>' : '';

    $out1 .= '
        <div class="service-block">
            <div class="inner-box">
                '.$img.'
                <div class="lower-content">
                    '.$pre.'
                    <div class="lower-box">
                        '.Themexriver_Addon_Helper::get_that_link($item['url'],$item['ttl'],'title').'
                    </div>
                </div>
            </div>
        </div>
    ';
}

?>

<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
    <?php echo Themexriver_Addon_Helper::tx_build_html($out1);?>
</div>