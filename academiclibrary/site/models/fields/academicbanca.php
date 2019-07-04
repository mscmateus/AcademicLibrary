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

class JFormFieldAcademicBanca extends JFormFieldTag
{
	// public static function getDocentes($trabalhoId, $select = 0) {

	// 	$db = JFactory::getDBO();

	// 	if ($select == 1) {
	// 		$query = 'SELECT b.ban_doc_id';
	// 	} else {
	// 		$query = 'SELECT d.*';
	// 	}
	// 	$query .= ' FROM #__al_docentes AS d'
	// 			//.' LEFT JOIN #__phocadownload AS f ON f.id = r.fileid'
	// 			.' LEFT JOIN #__al_banca AS b ON d.doc_id = b.ban_doc_id'
	// 		    .' WHERE b.ban_tra_id = '.(int) $trabalhoId
	// 			.' ORDER BY d.doc_id';
	// 	$db->setQuery($query);

	// 	/*if (!$db->query()) {
	// 		echo PhocaDownloadException::renderErrorInfo('Database Error - Getting Selected Tags');
	// 		return false;
	// 	}*/
	// 	if ($select == 1) {
	// 		$docentes = $db->loadColumn();
	// 	} else {
	// 		$docentes = $db->loadObjectList();
	// 	}

	// 	return $docentes;
	// }

	// public static function storeDocentes($docentesArray, $trabalhoId) {


	// 	if ((int)$trabalhoId > 0) {
	// 		$db = JFactory::getDBO();
	// 		$query = ' DELETE '
	// 				.' FROM #__al_banca'
	// 				. ' WHERE ban_tra_id = '. (int)$trabalhoId;
	// 		$db->setQuery($query);
	// 		// if (!$db->execute()) {
	// 		// 	echo PhocaDownloadException::renderErrorInfo('Database Error - Deleting FileId Tags');
	// 		// 	return false;
	// 		// }

	// 		if (!empty($docentesArray)) {

	// 			$values 		= array();
	// 			$valuesString 	= '';

	// 			foreach($docentesArray as $k => $v) {
	// 				$values[] = ' ('.(int)$trabalhoId.', '.(int)$v.')';
	// 			}

	// 			if (!empty($values)) {
	// 				$valuesString = implode($values, ',');

	// 				$query = ' INSERT INTO #__al_banca (ban_tra_id, ban_doc_id)'
	// 							.' VALUES '.(string)$valuesString;

	// 				// $db->setQuery($query);
	// 				// if (!$db->execute()) {
	// 				// 	echo PhocaDownloadException::renderErrorInfo('Database Error - Insert FileId Tags');
	// 				// 	return false;
	// 				// }

	// 			}
	// 		}
	// 	}

	// }

	// public static function getAllDocentesSelectBox($doc_nome, $doc_id, $activeArray, $javascript = NULL, $order = 'doc_id' ) {

	// 	$db = JFactory::getDBO();
	// 	$query = 'SELECT d.doc_id AS value, d.doc_nome AS text'
	// 			.' FROM #__al_docentes AS d'
	// 			. ' ORDER BY '. $order;
	// 			//. ' ORDER BY d.doc_id';
	// 	$db->setQuery($query);

	// 	/*if (!$db->execute()) {
	// 		echo PhocaDownloadException::renderErrorInfo('Database Error - Getting All Tags');
	// 		return false;
	// 	}*/

	// 	$docentes = $db->loadObjectList();

	// 	$docentesO = JHTML::_('select.genericlist', $docentes, $doc_nome, ' class="inputbox" size="4" multiple="multiple" mode="ajax"'. $javascript, 'value', 'text', $activeArray, $doc_id);

	// 	return $docentesO;
	// }


	// public $type 		= 'academicdocentes';

	// protected function getInput() {
		
	// 	$doc_id = (int) $this->form->getValue('doc_id');

	// 	$activeDocentes = array();
	// 	if ((int)$doc_id > 0) {
	// 		$activeDocentes	= $this->getDocentes($doc_id, 1);
	// 	}
		
		
	// 	return $this->getAllDocentesSelectBox($this->doc_nome, $this->doc_id, $activeDocentes, NULL, 'd.doc_id' );
		
		
	//}

	public $type 		= 'academicbanca';
	public function getValue() {

	}

	public function getOptions() {

		
		$db = JFactory::getDbo();
		
		
		
		$query = $db->getQuery(true);
		$query->select('d.doc_nome')->from('`#__al_docentes` AS d');
		
		
		
		$rows = $db->setQuery($query)->loadObjectlist();
		foreach($rows as $row){
			 $docentes[] = $row->doc_nome;
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