<?php
use Themexriver_Addon\Themexriver_Addon_Helper;
$options = [
    'id' => substr($this->get_id_int(), 0, 3), 
];
$icon = Themexriver_Addon_Helper::tx_render_icon($settings['actikn'],'actikn');
$inacon = Themexriver_Addon_Helper::tx_render_icon($settings['iactikn'],'inactikn');

$indicator = '<span class="tbxicon">' . $icon . $inacon . '</span>';

$tabti = '';

foreach ($settings['tabs'] as $a) {
    $title = $a['title'] ? '<div class="accortitle"><div class="title">' . $a['title'] .'</div>'. $indicator . '</div>' : '';
    $content = '<p class="accorbody">' . $a['content'] . '</p>';
    $tabti .= '<li>' . $title . $content . '</li>';
}
?>

<?php echo '<div class="txacdn" data-xld =\'' . wp_json_encode($options) . '\'>'; ?>
<ul <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
	<?php echo Themexriver_Addon_Helper::tx_build_html($tabti); ?>
</ul>
</div>
