<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Web Analytics Settings Controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to GPLv3 license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/gpl.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package	   SwiftRiver - http://github.com/ushahidi/Swiftriver_v2
 * @category   Controllers
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v3 (GPLv3) 
 */
class Controller_Settings_Webanalytics extends Controller_Settings_Main {

	/**
	 * @return	void
	 */
	public function before()
	{
		// Execute parent::before first
		parent::before();
		
		// Add an Admin User Menu Link
		Swiftriver_Event::add('swiftriver.settings.nav', array($this, 'webanalytics_menu'));
	}

	/**
	 * Render the Web Analytics Menu
	 */
	public function webanalytics_menu()
	{
		echo View::factory('webanalytics/menu');
	}

	/**
	 * List all the available settings for Web Analytics
	 *
	 * @return  void
	 */
	public function action_index()
	{
		$this->template->header->title = __('Web Analytics Settings');
		$this->settings_content = View::factory('pages/settings/webanalytics')
		    ->bind('action_url', $action_url);

		$this->active = 'webanalytics';
		
		// Setting items
		$settings = array(
			'webanalytics_google' => '',
			'webanalytics_gauges' => ''
		);

		if ($this->request->post())
		{
			// Setup validation for the application settings
			$validation = Validation::factory($this->request->post())
				->rule('form_auth_token', array('CSRF', 'valid'));
			
			if ($validation->check())
			{
				// Set the setting key values
				$settings = array(
					'webanalytics_google' => $this->request->post('webanalytics_google'),
					'webanalytics_gauges' => $this->request->post('webanalytics_gauges')
				);

				// Update the settings
				Model_Setting::update_settings($settings);
				
				$this->settings_content->set('messages', 
					array(__('Web Analytics settings have been updated.')));

				// Delete cached javascript
				Cache::instance()->delete('webanalytics');
			}
			else
			{
				$this->settings_content->set('errors', $validation->errors('user'));
			}
		}
		
		$this->settings_content->settings = Model_Setting::get_settings(array_keys($settings));
	}

}