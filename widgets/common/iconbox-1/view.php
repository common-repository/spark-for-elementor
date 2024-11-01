<?php
use Themexriver_Addon\Themexriver_Addon_Helper;
$icon = Themexriver_Addon_Helper::tx_render_icon($settings['ico']);
$img = wp_get_attachment_image($settings['img']['id'], 'full');
$type = $settings['type'] == 'image' ? $img : $icon;

?>
<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
    <div class="inner-box txtransition">
        <div class='img-wrap txtransition'><?php echo Themexriver_Addon_Helper::tx_build_html($type);?></div>
        <?php echo Themexriver_Addon_Helper::tx_build_html($settings['pre'],'span','step');?>
        <?php echo Themexriver_Addon_Helper::get_that_link($settings['link'],$settings['title'],'title');?>
        <?php echo Themexriver_Addon_Helper::tx_build_html($settings['description'],'p','desc');?>
    </div>
</div> 