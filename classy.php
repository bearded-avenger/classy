<?php
/*
	Author: Nick Haskins
	Author URI: http://nickhaskins.com
	Plugin Name: Classy
	Plugin URI: http://nickhaskins.com
	Version: 1.0
	Description: A collection of utility and design classes making custom css a thing of the past.
	Pagelines:true
*/

// Check to make sure we're in DMS
add_action('pagelines_setup', 'baClassy_init' );
function baClassy_init() {

	if( !function_exists('pl_has_editor') )
		return;

	$landing = new baClassyClasses;
}
class baClassyClasses {

	var $ptID = 'classy';
	const version = '1.0';

	function __construct() {

		$this->id   = 'classy';
		$this->name = 'Classy';
        $this->dir  = plugin_dir_path( __FILE__ );
        $this->url  = plugins_url( '', __FILE__ );
        $this->icon = plugins_url( '/icon.png', __FILE__ );

		add_action( 'template_redirect',  array(&$this,'classy_less' ));
		add_action( 'init', array( &$this, 'init' ) );

	}

    // Add a less file
	function classy_less() {

        $file = sprintf( '%sstyle.less', plugin_dir_path( __FILE__ ) );
        if(function_exists('pagelines_insert_core_less')) {
            pagelines_insert_core_less( $file );
        }

    }

	function init(){
		add_filter('pl_settings_array', array(&$this, 'options'));
	}

    function options( $settings ){

        $settings[ $this->id ] = array(
                'name'  => $this->name,
                'icon'  => 'icon-meh',
                'pos'   => 5,
                'opts'  => $this->global_opts()
        );

        return $settings;
    }

    function remove_stuffs() {
        ob_start();
            ?>
            <div class="row">
                <ul class="span12 zmb unstyled">
                    <li style="margin-bottom:5px;"><code>classy-npt</code> - <?php _e('removes padding on top of section pad','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-npb</code> - <?php _e('removes padding on bottom of section pad','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-nmt</code> - <?php _e('removes margin on top of section pad','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-nmb</code> - <?php _e('removes margin on bottom of section pad','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-txt-npt</code> - <?php _e('removes padding on top of textbox-wrap','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-txt-npb</code> - <?php _e('removes padding on bottom of textbox-wrap','classy');?></li>
                    <li><code>classy-nothing</code> - <?php _e('removes padding and margins','classy');?></li>
                </ul>
            </div>
            <?php
        return ob_get_clean();
    }

    function add_stuffs() {
        ob_start();
            ?>
            <div class="row">
                <ul class="span12 zmb unstyled">
                    <li style="margin-bottom:5px;"><code>classy-5pad-top</code> - <?php _e('add 5px pad to top','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-10pad-top</code> - <?php _e('add 10px pad to top','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-5pad-bottom</code> - <?php _e('add 5px pad to bottom','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-10pad-bottom</code> - <?php _e('add 10px pad to bottom','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-5margin-top</code> - <?php _e('add 5px margin to top','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-10margin-top</code> - <?php _e('add 10px margin to top','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-5margin-bottom</code> - <?php _e('add 5px margin to bottom','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-10margin-bottom</code> - <?php _e('add 10px margin to bottom','classy');?></li>
                </ul>
            </div>
            <?php
        return ob_get_clean();
    }

    function design() {
        ob_start();
            ?>
            <div class="row">
                <ul class="span12 zmb unstyled">
                    <li style="margin-bottom:5px;"><code>classy-border-top</code> - <?php _e('adds matchign 1px border on top','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-border-bottom</code> - <?php _e('adds matching 1px border on bottom','classy');?></li>
                    <li style="margin-bottom:5px;"><code>classy-uppercase</code> - <?php _e('makes text uppercase','classy');?></li>
                </ul>
            </div>
            <?php
        return ob_get_clean();
    }

    function cred() {
        ob_start();
            ?>
            <div class="row">
                <ul class="span12 zmb unstyled">
                    <li><?php _e('<strong>Instructions:</strong> Add class to "Styling Classes" option on any section (excluding section areas).','classy');?></li>
                    <li><?php _e('<strong>Brought to you by:</strong>','classy');?> <a href="http://twitter.com/nphaskins" target="_blank"><?php _e('Nick Haskins','classy');?></a></li>
                </ul>
            </div>
            <?php
        return ob_get_clean();
    }

    function global_opts(){

        $global_opts = array(
            array(
                'key' => $this->id.'_remove',
                'type' => 'template',
                'span' => 2,
                'title' => __('Remove Padding & Margins', 'classy'),
                'template' => $this->remove_stuffs()
            ),
            array(
                'key' => $this->id.'_add',
                'type' => 'template',
                'span' => 2,
                'title' => __('Add Padding & Margins', 'classy'),
                'template' => $this->add_stuffs()
            ),
            array(
                'key' => $this->id.'_design',
                'type' => 'template',
                'span' => 2,
                'title' => __('Design Classes', 'classy'),
                'template' => $this->design()
            ),
            array(
                'key' => $this->id.'_cred',
                'type' => 'template',
                'span' => 2,
                'title' => __('Classy Cred', 'classy'),
                'template' => $this->cred()
            ),
        );

        return array_merge($global_opts);
    }

}


