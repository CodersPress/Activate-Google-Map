<?php
/*
Plugin Name: Activate/Deactivate Google map
Plugin URI: http://coderspress.com/
Description: Activates or Deactivates your Homepage (new)Google Map & Search Results map.
Version: 2015.0624
Updated: 24th June 2015
Author: sMarty 
Author URI: http://coderspress.com
WP_Requires: 3.8.1
WP_Compatible: 4.2.2
License: http://creativecommons.org/licenses/GPL/2.0
*/
add_action( 'init', 'adm_plugin_updater' );
function adm_plugin_updater() {
	if ( is_admin() ) { 
	include_once( dirname( __FILE__ ) . '/updater.php' );
		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'Activate-Google-Map',
			'api_url' => 'https://api.github.com/repos/CodersPress/Activate-Google-Map',
			'raw_url' => 'https://raw.github.com/CodersPress/Activate-Google-Map/master',
			'github_url' => 'https://github.com/CodersPress/Activate-Google-Map',
			'zip_url' => 'https://github.com/CodersPress/Activate-Google-Map/zipball/master',
			'sslverify' => true,
			'access_token' => 'a68a9651c1ecb34270861fa946ebd45402094626',
		);
		new WP_ADM_UPDATER( $config );
	}
}
add_action('admin_menu', 'activate_map_menu');
function activate_map_menu() {
	add_menu_page('Map Button Styling', 'De|Activate Map', 'administrator', __FILE__, 'activate_button_styling_page',plugins_url('/images/styling.jpg', __FILE__));
	add_action( 'admin_init', 'register_button_styling_settings' );
}
function register_button_styling_settings() {
   	register_setting("activate-map-settings-group", "mobile_only");
	register_setting("activate-map-settings-group", "ad_button_top");
	register_setting("activate-map-settings-group", "ad_button_right");
    register_setting("activate-map-settings-group", "ad_button_color");
	register_setting("activate-map-settings-group", "ad_button_background_color");
	register_setting("activate-map-settings-group", "ad_button_border_color");
    register_setting("activate-map-settings-group", "ad_button_border");
    register_setting("activate-map-settings-group", "ad_button_height");
	register_setting("activate-map-settings-group", "ad_button_width");
	register_setting("activate-map-settings-group", "ad_button_radius");
    register_setting("activate-map-settings-group", "ad_button_text_align");
	register_setting("activate-map-settings-group", "ad_button_line_height");
    register_setting("activate-map-settings-group", "ad_activate_text");
	register_setting("activate-map-settings-group", "ad_deactivate_text");
}
function activate_map_defaults()
{
    $option = array(
        "mobile_only" => "no",
        "ad_button_top" => "10",
        "ad_button_right" => "10",
        "ad_button_color" => "#fff",
        "ad_button_background_color" =>"#F0AD4E",
        "ad_button_border_color" => "#000",
        "ad_button_border" => "1",
        "ad_button_height" => "30",
        "ad_button_width" => "120",
        "ad_button_radius" => "12",
        "ad_button_text_align" => "center",
        "ad_button_line_height" => "28",
        "ad_activate_text" => "Activate Map",
        "ad_deactivate_text" => "Deactivate Map",
    );
  foreach ( $option as $key => $value )
    {
       if (get_option($key) == NULL) {
        update_option($key, $value);
       }
    }
    return;
}
register_activation_hook(__FILE__, "activate_map_defaults");
function activate_button_styling_page() {
if ($_REQUEST['settings-updated']=='true') {
echo '<div id="message" class="updated fade"><p><strong>Plugin settings saved.</strong></p></div>';
}
?>
<style>
.m-button {
    top: <?php echo get_option("ad_button_top");?>%;
    right:<?php echo get_option("ad_button_right");?>%;
    position: absolute;
    color:<?php echo get_option("ad_button_color");?>;
    background-color:<?php echo get_option("ad_button_background_color");?>;
    border:<?php echo get_option("ad_button_border_color");?> solid <?php echo get_option("ad_button_border");?>px;
    height:<?php echo get_option("ad_button_height");?>px;
    width:<?php echo get_option("ad_button_width");?>px;
    border-radius: <?php echo get_option("ad_button_radius");?>px;
    text-align:<?php echo get_option("ad_button_text_align");?>;
    line-height:<?php echo get_option("ad_button_line_height");?>px;
    cursor: pointer;
    z-index:1;
}
</style>
<div class="wrap">
<h2>Usage and Button Styling Options</h2>
 <hr />
<form method="post" action="options.php">
    <?php settings_fields("activate-map-settings-group");?>
    <?php do_settings_sections("activate-map-settings-group");?>
      <table class="widefat" style="width:800px;">
<thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Usage</th>
                <th style="color:#fff;">Yes/No</th>
                <th style="color:#fff;"></th>
            </tr>
        </thead>
<tr>
<td>Mobile Only</td>
<td> 
        <select name="mobile_only" />
        <option value="yes" <?php if ( get_option('mobile_only') == yes ) echo 'selected="selected"'; ?>>Yes</option>
        <option value="no" <?php if ( get_option('mobile_only') == no ) echo 'selected="selected"'; ?>>No</option>
         </select>
</td>
<td></td>
        </tr>
<tr>
<thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Font, Borders and Colors</th>
                <th style="color:#fff;">Setting</th>
                <th style="color:#fff;"></th>
            </tr>
        </thead>
<tr>
        <td>Font Color</td>
        <td><input type="text" name="ad_button_color" value="<?php echo get_option("ad_button_color");?>"/>;</td>
        <td style="width:<?php echo get_option("ad_button_width"); ?>px;  height:<?php echo get_option("ad_button_height");?>px; color:<?php echo get_option( "ad_button_color" );?>;"></td>
</tr>        

<tr>
<td>Border Color</td>
<td><input type="text" name="ad_button_border_color" value="<?php echo get_option("ad_button_border_color");?>"/>;</td>
<td><div style="width:<?php echo get_option("ad_button_width"); ?>px;  height:<?php echo get_option("ad_button_height"); ?>px; border:<?php echo get_option("ad_button_border_color");?> solid <?php echo get_option("ad_button_border");?>px;"></td>
</tr>
<tr>
<td>Border Width</td>
<td><input type="text" name="ad_button_border" size="5" value="<?php echo get_option("ad_button_border");?>"/>px;</td>
<td><div style="width:<?php echo get_option("ad_button_width"); ?>px;  height:10px; border-bottom: <?php echo get_option("ad_button_border");?>px solid <?php echo get_option("ad_button_border_color");?>;"></div></td>
</tr>
<tr>
<td>Border Radius</td>
<td><input type="text" name="ad_button_radius" size="5" value="<?php echo get_option("ad_button_radius");?>"/>px;</td>
<td><div style="width:<?php echo get_option("ad_button_width");?>px;  height:<?php echo get_option("ad_button_height");?>px; border-radius:<?php echo get_option("ad_button_radius"); ?>px; background-color:<?php echo get_option("ad_button_background_color");?>;"></div></td>
</tr>
<tr>
<td>Background</td>
<td><input type="text" name="ad_button_background_color" value="<?php echo get_option("ad_button_background_color");?>"/>;</td>
<td><div style="width:<?php echo get_option("ad_button_width");?>px;  height:<?php echo get_option("ad_button_height");?>px; background-color:<?php echo get_option("ad_button_background_color");?>;"></div></td>
</tr>
<thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Box Size</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;"></th>
            </tr>
        </thead>
<tr>
<td>Height</td>
<td><input id="ad_button_height" type="text" size="5" name="ad_button_height" value="<?php echo get_option("ad_button_height");?>" />px;</td>
<td></td>
</tr>
<tr>
<td>Width</td>
<td><input id="ad_button_width" type="text" size="5" name="ad_button_width" value="<?php echo get_option("ad_button_width");?>" />px;</td>
<td></td>
</tr>
<thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Button Text</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;"></th>
            </tr>
        </thead>
<tr>
<td>Activate</td>
<td><input id="ad_activate_text" type="text" size="20" name="ad_activate_text" value="<?php echo get_option("ad_activate_text");?>" /></td>
<td></td>
</tr>
<tr>
<td>Deactivate</td>
<td><input id="ad_deactivate_text" type="text" size="20" name="ad_deactivate_text" value="<?php echo get_option("ad_deactivate_text");?>" /></td>
<td></td>
</tr>
<thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Text positions</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;"></th>
            </tr>
        </thead>
<tr>
<td>Line-Height</td>
<td><input id="ad_button_line_height" type="text" size="20" name="ad_button_line_height" value="<?php echo get_option("ad_button_line_height");?>" />px;</td>
<td></td>
</tr>
<tr>
<td>Text Alignment</td>
<td><select name="ad_button_text_align" />
        <option value="left" <?php if ( get_option('ad_button_text_align') == left ) echo 'selected="selected"'; ?>>left</option>
        <option value="center" <?php if ( get_option('ad_button_text_align') == center ) echo 'selected="selected"'; ?>>center</option>
        <option value="right" <?php if ( get_option('ad_button_text_align') == right ) echo 'selected="selected"'; ?>>right</option>
         </select></td>
<td></td>
</tr>
<thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Box positions</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;"></th>
            </tr>
        </thead>
<tr>
<td>From Top</td>
<td><input id="ad_button_top" type="text" size="5" name="ad_button_top" value="<?php echo get_option("ad_button_top");?>" />% Drop</td>
<td></td>
</tr>
<tr>
<td>From Right</td>
<td><input id="ad_button_right" type="text" size="5" name="ad_button_right" value="<?php echo get_option("ad_button_right");?>" />% Left</td>
<td></td>
</tr>
    </table>
    <?php submit_button(); ?><div class="m-button"></div>
</form>
</div>
<? } 
add_action( "wp_footer", "activate_map", 100);
function activate_map(){
?>
<style>
.m-button {
    top: <?php echo get_option("ad_button_top");?>%;
    right:<?php echo get_option("ad_button_right");?>%;
    position: absolute;
    color:<?php echo get_option("ad_button_color");?>;
    background-color:<?php echo get_option("ad_button_background_color");?>;
    border:<?php echo get_option("ad_button_border_color");?> solid <?php echo get_option("ad_button_border");?>px;
    height:<?php echo get_option("ad_button_height");?>px;
    width:<?php echo get_option("ad_button_width");?>px;
    border-radius: <?php echo get_option("ad_button_radius");?>px;
    text-align:<?php echo get_option("ad_button_text_align");?>;
    line-height:<?php echo get_option("ad_button_line_height");?>px;
    cursor: pointer;
    z-index:1;
}
</style>
<script type="text/javascript">
function runOverlay() {
    function create_overlay(jQuery) {
        var d = document.createElement('div');
        jQuery(d).css({
            opacity: '0.5',
            width: '100%',
            height: '100%',
            position: 'absolute',
            top: 0,
            left: 0,
            display: 'none',
            zIndex: 1
        }).attr('id', 'map_overlay');
       jQuery("#wlt_childtheme_map, #wlt_google_map").append(d);
    }
    if (jQuery('#map_overlay').length == 0) {
        create_overlay(jQuery);
    }
    jQuery('#map_overlay').fadeIn('fast');
    var mClass = 'inactive';
    var mTitle = "<?php echo get_option( 'ad_activate_text' ); ?>";
    var mButton = jQuery('<div class="m-button ' + mClass + '">' + mTitle + '</div>').appendTo("#wlt_childtheme_map, #wlt_google_map");
    mButton.click(function () {
        if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active').addClass('inactive').text("<?php echo get_option( 'ad_activate_text' ); ?>");
            jQuery('#map_overlay').fadeIn('fast');
        } else {
            jQuery(this).removeClass('inactive').addClass('active').text("<?php echo get_option( 'ad_deactivate_text' ); ?>");
            jQuery('#map_overlay').fadeOut('fast');
        }
    });
};
var mobileOnly = "<?php echo get_option( 'mobile_only' ); ?>";

setTimeout(function(){ 

if( mobileOnly === "yes") {
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { runOverlay(); }
} else { runOverlay(); }

}, 3000);
</script>
<?php
}
?>