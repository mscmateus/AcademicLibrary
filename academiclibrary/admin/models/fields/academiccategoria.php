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

JFormHelper::loadFieldClass('category');
//require_once JPATH_LIBRARIES . '/joomla/form/fields/tag.php';
//class JFormFieldCity extends JFormFieldList {

class JFormFieldAcademicCategoria extends JFormFieldCategory
{

	public $type = 'academiccategoria';
	public function getValue() {

	}

	public function getOptions() {
		
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		$query->select('c.cat_titulo, c.cat_id')->from('`#__al_categorias` AS c');
		
		$rows = $db->setQuery($query)->loadObjectlist();
		foreach($rows as $row){
			 $categorias[] = JHtml::_(
				'select.option', $row->cat_id, $row->cat_titulo, "value", "text");
		}
		if(empty($categorias)){
			$categorias[0]="";
		}
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $categorias);
		return $options;
	}
}
?>