<?php
/* Created by Juwan Park <http://parkjuwan.dothome.co.kr> */
/**
 * @class gravagen
 * @author Juwan Park (park_juwan@naver.com)
 * @version 1.0
 * @brief Widget to display Gravatar
 *
 * $Pre-configured by using $gravagen
 */
class gravagen extends WidgetHandler
{
	/**
	 * @brief Widget execution
	 * Get extra_vars declared in ./widgets/widget/conf/info.xml as arguments
	 * After generating the result, do not print but return it.
	 */
	function proc($args)
	{
		// Get a Gravatar info
		if ($args->image_size == "") {
			// Blank to 80px
			$imgsize = 80;
		} else {
			$imgsize = (int)$args->image_size;
		}
		
		if ($gotcode == 404) {
			$gravaurl = $args->custom_default_url;
		}
		
		// Generate a Gravatar URL
		$widget_info = new stdClass();
		$widget_info->gravaurl = $this->get_gravatar($args->user_email, $imgsize, $args->default_image, 'g', false);
		
		// Set a path of the template skin (values of skin, colorset settings)
		$tpl_path = sprintf('%sskins/%s', $this->widget_path, $args->skin);
		Context::set('colorset', $args->colorset);
		Context::set('widget_info', $widget_info);
		
		// Specify a template file
		$tpl_file = 'grava';
		// Compile a template
		$oTemplate = &TemplateHandler::getInstance();
		return $oTemplate->compile($tpl_path, $tpl_file);
	}
	
	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source https://gravatar.com/site/implement/images/php/
	 */
	function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
		$url = 'https://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}
}
/* End of file gravagen.class.php */
/* Location: ./widgets/gravagen/gravagen.class.php */
