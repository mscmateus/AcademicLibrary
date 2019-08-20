<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 * @since       0.0.9
 */
class AcademicLibraryControllerAcademicLibraryCategoria extends JControllerForm
{
   public function save($data = array(), $key = 'id'){
		//Debugging 
		ini_set("display_error" , 1);
		error_reporting(E_ALL);
      $jinput = JFactory::getApplication()->input;
		
		// Get posted data
		$data  = $jinput->get('jform', null, 'raw');


		JRequest::setVar('jform', $data, 'post');
		$return = parent::save($data);
		return $return;
	}
}