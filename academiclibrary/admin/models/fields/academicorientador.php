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

class JFormFieldAcademicOrientador extends JFormFieldTag
{

	public $type 		= 'academicorientador';
	public function getValue() {

	}

	public function getOptions() {

		
		$db = JFactory::getDbo();
		
		
		
		$query = $db->getQuery(true);
		$query->select('d.doc_nome, d.doc_id')->from('`#__al_docentes` AS d');
		
		
		
		$rows = $db->setQuery($query)->loadObjectlist();
		foreach($rows as $row){
			 $docentes[] = JHtml::_(
				'select.option', $row->doc_id, $row->doc_nome, "value", "text");
		}
		if(empty($docentes)){
			$docentes[0]="";
		}
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $docentes);
		return $options;
	}
}
?>