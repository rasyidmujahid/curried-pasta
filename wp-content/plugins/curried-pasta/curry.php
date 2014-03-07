<?php
/*
Plugin Name: Another Google Docs Shortcode
Plugin URI: https://github.com/rasyidmujahid/curried-pasta
Description: Embed a Google Doc (only) into your blog posts
Author: rasyidmujahid
Author URI: https://github.com/rasyidmujahid/curried-pasta
Version: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


class Curry {

    protected $plugin_path;
    protected $plugin_url;

    public function __construct(){
        // $this->plugin_path = dirname(__FILE__);
        // $this->plugin_url = WP_PLUGIN_URL . '/curried-pasta';
        // wp_enqueue_script('curry_js', plugins_url('js/curry.js', __FILE__));

        wp_enqueue_script("jquery");
        
        wp_register_style('purecss', 'http://yui.yahooapis.com/pure/0.4.2/pure-min.css');
        wp_enqueue_style('purecss'); 

        wp_register_script('curryjs', plugins_url('/curried-pasta/js/curry.js'));
        wp_enqueue_script('curryjs');
        
        add_shortcode('gdoc', array($this, 'shortcode'));
    }

    public function shortcode($atts) {
        extract(shortcode_atts(array(
            'id' => false,
            'width' => ! empty( $content_width ) ? $content_width : '100%',
            'height' => 300
        ), $atts));

        $htmls = [];

        $method = 'open';
        $google_doc_id = '1LCxqRRPChqg0zAnYnzhA36gR7ndAg1_M23nQH0XVCGM';
        $url = "https://script.google.com/macros/s/AKfycbzggDVc5GFSNttaMkYU6pi8iy88exVSTiwyrKvwrr2nCj7m0rM/exec?method=". $method ."&gid=" . $google_doc_id;
        
        $args_json = file_get_contents($url);

        $htmls[] = $this->get_doc_fields($google_doc_id, json_decode($args_json, true));

        $htmls[] = $this->get_embedded_doc($id, $width, $height);

        return apply_filters('gdoc_output', implode("\n", $htmls));
    }

    public function get_doc_fields($google_doc_id, $fields)
    {
        $inputs = [];
        foreach ($fields as $field) {
            $inputs[] = $this->new_text_field(ucwords(strtolower($field['tag_string'])), $this->underscored($field['tag_id']));
        }
        $inputs = implode("\n", $inputs);

        $htmls = <<<EOD
            <form id="doc_param" method="post" class="pure-form pure-form-aligned">
                <fieldset>
                <input type="hidden" name="gid" id="gid" value="$google_doc_id"/>
                $inputs
                <div class="pure-controls">
                    <button type="submit" class="pure-button pure-button-primary">Cetak</button>
                </div>
                </fieldset>
            </form>
EOD;
        return $htmls;
    }

    public function new_text_field($title, $id)
    {
        return <<<EOD
        <div class="pure-control-group">
            <label for=$id>$title</label><input type="text" id=$id name=$id placeholder="$title"/>
        </div>
EOD;
    }

    public function get_embedded_doc($id, $width, $height)
    {
        if (!$id) return;

        # docx
        // $output = '<iframe src="https://docs.google.com/file/d/' . $id .'/preview" width="' . $width . '" height="'. $height .'"></iframe>';

        # google doc preview
        $output = '<iframe src="https://docs.google.com/document/d/' . $id . '/preview?embedded=true" width="' . $width . 
            '" height="'. $height .'"></iframe>';

        # google doc viewer
        // $output = '<iframe src="https://docs.google.com/viewer?url=https://docs.google.com/document/d/'. $id .'/export?format%3Dpdf&id='. $id .'&embedded=true" style="width:680px; height:860px;" frameborder="0"></iframe>';

        return $output;
        // return apply_filters('gdoc_output', $output);
    }

    public function underscored($string)
    {
        $normalized = strtolower($string);
        preg_match_all("/\{(.*)\}/", $normalized, $result, PREG_SET_ORDER);
        $normalized = preg_replace("/\s+/", "_", $result[0][1]);
        return $normalized;
    }

}
$curry = new Curry();