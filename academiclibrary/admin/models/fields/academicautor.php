<?php
/*
 * @package		Joomla.Framework
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die();

JFormHelper::loadFieldClass('tag');
//require_once JPATH_LIBRARIES . '/joomla/form/fields/tag.php';
//class JFormFieldCity extends JFormFieldList {

class JFormFieldAcademicAutor extends JFormFieldTag
{
	public $type 		= 'academicautor';
	public function getValue() {
	}

	public function getOptions() {

		
		$db = JFactory::getDbo();
		
		
		
		$query = $db->getQuery(true);
		$query->select('d.dis_nome, d.dis_id')->from('`#__al_discentes` AS d');
		
		
		
		$rows = $db->setQuery($query)->loadObjectlist();
		foreach($rows as $row){
			 $discentes[] = JHtml::_(
				'select.option', $row->dis_id, $row->dis_nome, "value", "text");
		}
		// Merge any additional options in the XML definition.
		if(empty($discentes)){
			$discentes[0]="";
		}
		$options = array_merge(parent::getOptions(), $discentes);
		return $options;
	}
}
?>