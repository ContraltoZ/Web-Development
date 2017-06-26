<?php

/**
 * Plugin Name: WP BookWidgets
 * Plugin URI: https://github.com/remko/wp-bookwidgets
 * Description: Integrate BookWidgets widgets in your WordPress site
 * Version: 0.1
 * Author: Remko Tronçon
 * Author URI: https://el-tramo.be
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: wp-bookwidgets
*/

namespace wp_bookwidgets;

////////////////////////////////////////////////////////////////////////////////
// Options for launching a widget using LTI
// Can be changed using the `bw_widget_launch_options` filter.
////////////////////////////////////////////////////////////////////////////////

class WidgetLaunchOptions {
  /**
   * A WP_User-like struct.
   * Should have the fields `ID`, `user_email`, `user_firstname`, 
   * and `user_lastname`.
   */
  public $student;

  /**
   * Email address that will receive student results.
   * If the widget allows this, the student can still override this.
   */
  public $teacher_email = null;

  /**
   * The class ID for the widget.
   * If the widget allows this, the student can still override this.
   */
  public $student_class_id = null;

  public $context_id;
  public $submit_url = null;
}

////////////////////////////////////////////////////////////////////////////////

$baseURI = "https://www.bookwidgets.com";

function use_lti() {
  return is_user_logged_in() && get_option("bw_lti_enabled");
}

function get_play_link($code) {
  global $baseURI;
  return "{$baseURI}/play/{$code}";
}

function get_lti_play_link($code) {
  global $baseURI;
  return "{$baseURI}/lti/play/{$code}";
}

function get_oauth_signature($url, $params, $secret) {
  ksort($params);
  $baseString = implode("&", array_map('rawurlencode', [
    "POST",
    $url,
    implode("&", array_map(function ($key, $value) {
      return rawurlencode($key) . '=' . rawurlencode($value);
    }, array_keys($params), $params))
  ]));
  $key = $secret . "&";
  return base64_encode(hash_hmac('sha1', $baseString, $key, true));
}

function get_lti_launch_form($code, $name, $target = null, $time = 'time', $uniqid = 'uniqid') {
  $widgetLaunchOptions = new WidgetLaunchOptions;
  $widgetLaunchOptions->student = wp_get_current_user();
  $widgetLaunchOptions->context_id = get_the_ID();
  $widgetLaunchOptions = apply_filters(
    'bw_widget_launch_options', $widgetLaunchOptions);

  $current_user = $widgetLaunchOptions->student;
  $params = array_filter([
    "lti_message_type" => "basic-lti-launch-request",
    "lti_version" => "LTI-1p0",

    "user_id" => $current_user->ID,
    "roles" => "Student",
    "lis_person_contact_email_primary" => $current_user->user_email,
    "lis_person_name_given" => $current_user->user_firstname,
    "lis_person_name_family" => $current_user->user_lastname,

    "oauth_consumer_key" => get_option("bw_lti_consumer_key"),
    "oauth_signature_method" => "HMAC-SHA1",
    "oauth_timestamp" => call_user_func($time),
    "oauth_nonce" => call_user_func($uniqid, "", true),
    "oauth_version" => "1.0",

    "context_id" => $widgetLaunchOptions->context_id,
    "custom_teacher_email" => $widgetLaunchOptions->teacher_email,
    "custom_student_class_id" => $widgetLaunchOptions->student_class_id,
    "custom_submit_url" => $widgetLaunchOptions->submit_url,
  ], function ($value) { return $value !== null; });

  $action = get_lti_play_link($code);
  $signature = esc_attr(get_oauth_signature($action, $params, get_option("bw_lti_consumer_secret")));

  $form = "<form action=\"{$action}\" method=\"POST\" encType=\"application/x-www-form-urlencoded\"";
  if ($target) {
    $form .= " target=\"{$target}\"";
  }
  $form .= " name=\"{$name}\">";
  foreach ($params as $key => $value) {
    $name = esc_attr($key);
    $value = esc_attr($value);
    $form .= "<input type=\"hidden\" name=\"{$name}\" value=\"{$value}\"/>";
  }
  $form .= "<input type=\"hidden\" name=\"oauth_signature\" value=\"{$signature}\"/>";
  $form .= "<input type=\"submit\" value=\"Play Widget\" style=\"display: none\"/>";
  $form .= "</form>";
  return $form;
}

function get_autolaunch_script($name) {
  return "<script language=\"javascript\">document.{$name}.submit();</script>";
}

add_shortcode('bw_link', function($atts, $content = null) {
  $a = shortcode_atts([
    'code' => '',
  ], $atts);
  $text = empty($content) ? $a["code"] : $content;
  $link = use_lti()
    ? home_url("?bw_link={$a['code']}")
    : get_play_link($a["code"]);
  return "<a href=\"" . esc_attr($link) . "\">{$text}</a>";
});

$bwNextEmbedID = 0;
$bwForms = [];

add_action('wp_footer', function () {
  global $bwForms;
  foreach ($bwForms as $form) {
    echo $form;
  }
});

add_shortcode("bw_embed", function ($atts) {
  $a = shortcode_atts([
    'code' => '',
    'width' => null,
    'height' => null
  ], $atts);
  $result = "";
  if (use_lti()) {
    global $bwNextEmbedID;
    global $bwForms;
    $embedID = $bwNextEmbedID++;
    $formName = "bwWidgetLaunchForm{$embedID}";
    $frameName = "bwWidgetFrame{$embedID}";
    $bwForms[] = get_lti_launch_form($a['code'], $formName, $frameName);
    $bwForms[] = get_autolaunch_script($formName);
    $result .= "<iframe name={$frameName}";
  }
  else {
    $result = "<iframe src=\"" . esc_attr(get_play_link($a["code"])) . "\"";
  }
  $result .= " class=\"bw-widget-frame\"";
  if ($a['width']) {
    $result .= " width=\"" . esc_attr($a['width']) . "\"";
  }
  if ($a['height']) {
    $result .= " height=\"" . esc_attr($a['height']) . "\"";
  }
  $result .= "></iframe>";

  return $result;
});


add_action('wp_enqueue_scripts', function() {
  global $baseURI;
  wp_enqueue_script("bw_embed_support", "{$baseURI}/js/embed-support.js", false);
});


////////////////////////////////////////////////////////////////////////////////
// Cache handling
////////////////////////////////////////////////////////////////////////////////

// Always forcing no-cache, since there's no late point where we can decide
// whether we want to do this or not :(
if (get_option('bw_lti_enabled')) {
  // Add as many no-cache headers as we can, to make sure hitting the 'back' button 
  // in the browser doesn't use a cached page (since a cached page will illegally 
  // reuse any generated nonce)
  add_filter('nocache_headers', function ($headers) {
    $headers["Cache-Control"] = "private, must-revalidate, max-age=0, no-store, no-cache, must-revalidate, post-check=0, pre-check=0";
    return $headers;
  });
  nocache_headers();
}


////////////////////////////////////////////////////////////////////////////////
// Settings
////////////////////////////////////////////////////////////////////////////////

add_action('admin_init', function () {
  register_setting('bw-settings-general', 'bw_lti_enabled');
  register_setting('bw-settings-general', 'bw_lti_consumer_key');
  register_setting('bw-settings-general', 'bw_lti_consumer_secret');
});

add_action('admin_menu', function () {
  add_options_page(
    'BookWidgets Settings', 
    'BookWidgets', 
    'administrator', 
    'bw-settings', 
    function () {
      ?>
        <div class="wrap">
          <h2>BookWidgets Settings</h2>

          <form method="post" action="options.php">
            <?php settings_fields('bw-settings-general'); ?>
            <?php do_settings_sections('bw-settings'); ?>
            <table class="form-table">
              <tr valign="top">
                <th scope="row">LTI</th>
                <td>
                  <label for="bw_lti_enabled">
                    <input id="bw_lti_enabled" type="checkbox" name="bw_lti_enabled" value="1" <?php checked('1', get_option('bw_lti_enabled')); ?> /> 
                    Automatically sign in students in widgets using their user account
                    from this site.
                  </label>
                  <p class="description">
                    To enable this, you need to enter your BookWidgets LTI credentials below.
                    You can get your LTI credentials from 
                    <a href="mailto:support@bookwidgets.com">BookWidgets support</a>.
                  </p>
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">LTI Consumer Key</th>
                <td><input type="text" name="bw_lti_consumer_key" value="<?php echo esc_attr( get_option('bw_lti_consumer_key') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">LTI Consumer Secret</th>
                <td><input type="text" name="bw_lti_consumer_secret" value="<?php echo esc_attr( get_option('bw_lti_consumer_secret') ); ?>" /></td>
              </tr>
            </table>
            <?php submit_button(); ?>
          </form>
        </div>
      <?php
    }
  );
});


////////////////////////////////////////////////////////////////////////////////
// Auto-submit form for links
////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['bw_link'])) {
  // add_filter('the_title','bw_link_page_title');
  add_filter('the_content', function () {
    return get_lti_launch_form($_GET["bw_link"], 'widgetLaunchForm')
      . get_autolaunch_script("widgetLaunchForm");
  });
  add_action('template_redirect', function () {
    ?>
      <html>
        <body>
          <?php the_content(); ?>
        </body>
      </html>
    <?php
    exit;
  });
}

?>
