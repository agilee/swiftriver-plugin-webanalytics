<?php defined('SYSPATH') OR die('No direct script access');

/**
 * Init for the WebAnalytics plugin
 *
 * @package   SwiftRiver
 * @author    Ushahidi Team
 * @category  Plugins
 * @copyright (c) 2008-2011 Ushahidi Inc <htto://www.ushahidi.com>
 */
class Webanalytics_Init {

	public function __construct() 
	{
		// Hook into the footer
		Swiftriver_Event::add('swiftriver.footer', array($this, 'analytics_js'));
	}

	/**
	 * Render the Analytics Javascript
	 * Cache it to prevent a query to the DB everytime
	 * a page is loaded
	 *
	 * @return  void
	 */
	public function analytics_js()
	{
		// Analytics Cache
		if ( ! ($cache = Cache::instance()->get('webanalytics', FALSE)) )
		{
			$cache = '';
			$analytics = Model_Setting::get_settings(array('webanalytics_google', 'webanalytics_gauges'));
			
			if ($analytics['webanalytics_google'])
			{
				$cache .= View::factory('webanalytics/google')
					->bind('webanalytics_google', $analytics['webanalytics_google']);
			}

			if ($analytics['webanalytics_gauges'])
			{
				$cache .= View::factory('webanalytics/gauges')
					->bind('webanalytics_gauges', $analytics['webanalytics_gauges']);
			}

			// Save Cache (30 day expiry)
			Cache::instance()->set('webanalytics', $cache, 2592000);
		}

		echo $cache;
	}
}

// Initialize the plugin
new Webanalytics_Init;

?>