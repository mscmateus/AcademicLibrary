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
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class AcademicLibraryModelAcademicLibraryTrabalho extends JModelAdmin
{
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'AcademicLibraryTrabalho', $prefix = 'AcademicLibraryTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm(
			'com_academiclibrary.academiclibrarytrabalho',
			'academiclibrarytrabalho',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			'com_academiclibrary.edit.academiclibrarytrabalho.data',
			array()
		);

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);
		if($item->tra_id!='' && $item->tra_id!=null){
			$db = JFactory::getDbo();
			//Pegar autores e carrega no item para o formulario
			$query = $db->getQuery(true);
			$query
				->select(array('dis_nome'))
				->from($db->quoteName('#__al_discentes', 'd'))
				->join('INNER', $db->quoteName('#__al_autoria', 'a') . 'ON (' . $db->quoteName('d.dis_id'). '='. $db->quoteName('a.aut_dis_id').')')
				->where($db->quoteName('a.aut_tra_id'). '=' . $item->tra_id);
			$db->setQuery($query);
			$db->execute();
			// Reset the query using our newly populated query object.
			$autores = $db->loadObjectList();
			$aux = 0;
			foreach($autores as $autor){
				$item->autores[$aux]=$autor->dis_nome;
				$aux++;
			}
			//pega os orientadores
			$query = $db->getQuery(true);
			$query
				->select(array('doc_nome'))
				->from($db->quoteName('#__al_docentes', 'd'))
				->join('INNER', $db->quoteName('#__al_orientacao', 'o') . 'ON (' . $db->quoteName('d.doc_id'). '='. $db->quoteName('o.ori_doc_id').')')
				->where($db->quoteName('o.ori_tra_id'). '=' . $item->tra_id);
			$db->setQuery($query);
			$db->execute();
	
			$orientadores = $db->loadObjectList();
			$aux = 0;
			foreach($orientadores as $orientador){
				$item->orientadores[$aux]=$orientador->doc_nome;
				$aux++;
			}
			//pega os membros da banca
			$query = $db->getQuery(true);
			$query
				->select(array('doc_nome'))
				->from($db->quoteName('#__al_docentes', 'd'))
				->join('INNER', $db->quoteName('#__al_banca', 'b') . 'ON (' . $db->quoteName('d.doc_id'). '='. $db->quoteName('b.ban_doc_id').')')
				->where($db->quoteName('b.ban_tra_id'). '=' . $item->tra_id);
			$db->setQuery($query);
			$db->execute();
	
			$banca = $db->loadObjectList();
			$aux = 0;
			foreach($banca as $membro){
				$item->banca[$aux]=$membro->doc_nome;
				$aux++;
			}
		}
		//var_dump($item);
		return $item;
	}
}