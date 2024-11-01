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
    $name = $a['name'] ? '<h3 class="name">'.$a['name'].'</h3>' : '';
    $pos = $a['pos'] ? '<span class="na">'.$a['pos'].'</span>' : '';
    $fb = $a['fb'] ? '<a href="'.$a['fb'].'"><i class="fab fa-facebook-f"></i></a>' : '';
    $tw = $a['tw'] ? '<a href="'.$a['tw'].'"><i class="fab fa-twitter"></i></a>' : '';
    $ig = $a['ig'] ? '<a href="'.$a['ig'].'"><i class="fab fa-instagram"></i></a>' : '';
    $lk = $a['lk'] ? '<a href="'.$a['lk'].'"><i class="fab fa-linkedin"></i></a>' : '';

    $out .= '
        <div class="swiper-slide">
            <div class="tx-team">
                <div class="inner-image">
                '.$f_out.'
                </div>
                <div class="inner-content txtransition">
                    <h3>John Doe</h3>
                    <span>Senior Cleaner</span>
                    <div class="inner-social">
                        '.$fb.$tw.$ig.$lk.'
                    </div>
                </div>
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
