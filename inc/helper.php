<?php
namespace Themexriver_Addon;
use Elementor\Icons_Manager;

class Themexriver_Addon_Helper
{
    static function tx_render_icon($icon, $class = '')
    {
        if ($icon['library'] == 'svg') {
            $out = wp_get_attachment_image($icon['value']['id'], 'full', '', ['class' => $class]);
        } else {
            ob_start();
            Icons_Manager::render_icon($icon, ['class' => $class, 'aria-hidden' => 'true']);
            $out = ob_get_clean();
        }

        return $out;
    }

    static function drop_tax($tax)
    {
        $categories_obj = get_categories('taxonomy=' . $tax . '');
        $categories = [];

        foreach ($categories_obj as $pn_cat) {
            $categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
        }
        return $categories;
    }

    static function tx_build_html($option, $tag = '', $cls = '')
    {
        if ($option) {
            $class = $cls ? 'class="' . $cls . '"' : '';
            if ($tag) {
                return '<' . $tag . ' ' . $class . '>' . $option . '</' . $tag . '>';
            } else {
                return $option;
            }
        }
    }

    static function get_that_link($link,$text = '',$class = '')
    {
        if ($text) {
            $url = isset($link['url']) ? 'href="' . esc_url($link['url']) . '"' : '';
            $ext = isset($link['is_external']) ? ' target= "_blank" ' : '';
            $nofollow = isset($link['nofollow']) ? ' rel= "nofollow" ' : '';
            $cls = $class ? ' class= "' . $class . '" ' : '';
            return '<a ' . $cls . $url . $ext . $nofollow . '>' . $text . '</a>';
        }
    }
}