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
        
        add_shortcode('gdoc', array($this, 'shortcode'));
    }

    public function shortcode($atts) {
        extract(shortcode_atts(array(
            'id'     => false,

            // dimensions
            'width'    => ! empty( $content_width ) ? $content_width : '100%',
            'height'   => 300,   // default height is set to 300

            // only for documents
            'seamless' => 1,  // if set to 'true', this will not show the Google Docs header / footer.
                              // if set to 'false', this will show the Google Docs header / footer.

            // only for presentations
            'size'     => false, // preset presentation size, either 'small', 'medium' or 'large';
                                 // preset dimensions are as follows: small (480x389), medium (960x749), large (1440x1109)
                                 // to set custom size, set the 'width' and 'height' params instead
        ), $atts));

        $htmls = [];

        $method = 'open';
        $google_doc_id = '1LCxqRRPChqg0zAnYnzhA36gR7ndAg1_M23nQH0XVCGM';
        $url = "https://script.google.com/macros/s/AKfycbzggDVc5GFSNttaMkYU6pi8iy88exVSTiwyrKvwrr2nCj7m0rM/exec?method=". $method ."&gid=" . $google_doc_id;
        
        $args_json = file_get_contents($url);

        $forms = $this->get_doc_args(json_decode($args_json, true));
        foreach ($forms as $input) {
            $htmls[] = $input;
        }

        $htmls[] = $this->get_embedded_doc($id, $width, $height, $seamless, $size);

        return apply_filters('gdoc_output', implode("\n", $htmls));
    }

    public function get_doc_args($fields)
    {
        $htmls = [];
        $htmls[] = '<form id="doc_param">';
        foreach ($fields as $field) {
            $htmls[] = $this->new_text_field($field['tag_string'], $this->underscored($field['tag_id']));
        }
        $htmls[] = '</form>';
        return $htmls;
    }

    public function new_text_field($title, $id)
    {
        return '<span>'. $title .'</span><input type="text" id='. $id .'/><br/>';
    }

    public function get_embedded_doc($id, $width, $height, $seamless, $size)
    {
        if (!$id) return;

        # docx
        // $output = '<iframe src="https://docs.google.com/file/d/' . $id .'/preview" width="' . $width . '" height="'. $height .'"></iframe>';

        # google doc preview
        $output = '<iframe src="https://docs.google.com/document/d/' . $id . '/preview?embedded=false" width="' . $width . 
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