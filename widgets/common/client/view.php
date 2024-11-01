<?php
use Themexriver_Addon\Themexriver_Addon_Helper;
$out = '';
$slider_options = [
    'speed' => $settings['speed']['size'],
    'item' => $settings['item']['size'],
    'space' => $settings['space']['size'],
    'itemtab' => $settings['itemtab']['size'],
    'auto' => ('yes' === $settings['auto']),
];

$previkn = $settings['previkn'] ? '<div class="txprnx txnxt">' . Themexriver_Addon_Helper::tx_render_icon($settings['previkn']) . '</div>' : '';
$nextikn = $settings['nextikn'] ? '<div class="txprnx txprev">' . Themexriver_Addon_Helper::tx_render_icon($settings['nextikn']) . '</div>' : '';

foreach ( (array) $settings['items'] as $a) {
    $img = wp_get_attachment_image($a['img']['id'], 'full','',['class'=>'txtransition']);
    $f_out = $a['link']['url'] ? '<a href="'.$a['link']['url'].'">'.$img.'</a>' : $img;
    $out .= '
        <div class="swiper-slide">
            <div class="tx-client txtransition">
                '.$f_out.'
            </div>
        </div>    
    ';
}
?>
<?php echo '<div style="display:none;" '.$this->get_render_attribute_string( 'wrapper' ).' data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
    <div class="swiper-wrapper">
        <?php echo Themexriver_Addon_Helper::tx_build_html($out); ?>
    </div>  
    <div class="swiper-pagination"></div> 
    <div class="tx-arrow">
        <?php echo Themexriver_Addon_Helper::tx_build_html($previkn . $nextikn); ?>
    </div>     
</div>
