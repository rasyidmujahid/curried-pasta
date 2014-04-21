<?php
/*
Plugin Name: Document Template
Plugin URI: https://github.com/rasyidmujahid/curried-pasta
Description: Create and download a document with provided template, just by filling required fields.
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
        
        wp_enqueue_script("jquery");
        wp_enqueue_script("jqueryui");
        
        wp_register_style('purecss', 'http://yui.yahooapis.com/pure/0.4.2/pure-min.css');
        wp_enqueue_style('purecss'); 

        wp_register_style('cssload', plugins_url('/curried-pasta/css/cssload.css'));
        wp_enqueue_style('cssload'); 

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

        $htmls = array();

        $method = 'open';

        $google_doc_id = $id;

        $url = "https://script.google.com/macros/s/AKfycbwwYoxBOohaKW36y8uX6YvdE7GpkaYJL3aICBAU_aP57PI1oiE/exec?method=" . 
            $method ."&gid=" . $google_doc_id;

        $site_url = get_site_url();

        if (strstr(get_site_url(), 'mech.eng.ui.ac.id')) {
            $context_params = array(
                'http' => array(
                    'proxy' => 'tcp://152.118.148.7:3128',
                    'request_fulluri' => true,
                ),
            );
            $stream_context = stream_context_create($context_params);
        }
        
        $json_response = file_get_contents($url, false, $stream_context);
        $json_data = json_decode($json_response, true);

        $content_html = file_get_contents($json_data['html'], false, $stream_context);
        
        $cleaned_content = $this->get_cleaned_content($content_html);
        
        $htmls[] = '<div id="google_doc_html">' . $cleaned_content . '</div>';

        return apply_filters('gdoc_output', implode("\n", $htmls));
    }

    public function get_cleaned_content($content_html)
    {
        $p = str_replace('}p{', '}#google_doc_html > p{', $content_html);
        $p = str_replace('}li{', '}#google_doc_html > li{', $p);
        $p = str_replace('<style type="text/css">', '<style type="text/css"> table, th, td { border: 0px solid rgba(0, 0, 0, 0.1) } ', $p);
        return $p;
    }

    public function get_doc_fields($google_doc_id, $fields)
    {
        $inputs = array();
        foreach ($fields as $field) {
            $inputs[] = $this->new_text_field(ucwords(strtolower($field['tag_string'])), $this->underscored($field['tag_id']));
        }
        $inputs = implode("\n", $inputs);

        $htmls = <<<EOD
            <form id="doc_param" method="post" class="pure-form pure-form-aligned">
                <fieldset>
                <input type="hidden" name="gid" id="gid" value="$google_doc_id"/>
                $inputs
                <div id="curry-button" class="pure-controls">
                    <button id="curry-button-submit" type="submit" class="pure-button pure-button-primary">Submit</button>
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
        $output = '<iframe id="curry-embedded-doc" src="https://docs.google.com/document/d/' . $id . 
            '/preview?embedded=true" width="' . $width . 
            '" height="'. $height .'"></iframe>';

        # google doc viewer
        // $output = '<iframe src="https://docs.google.com/viewer?url=https://docs.google.com/document/d/'. $id .'/export?format%3Dpdf&id='. $id .'&embedded=true" style="width:680px; height:860px;" frameborder="0"></iframe>';

        return $output;
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