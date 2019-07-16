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



class AcademicLibraryControllerAcademicLibraryTrabalho extends JControllerForm
{
	public function saveBanca($traId, $banca){
		
		$db = JFactory::getDbo();
		// Create a new query object.
		$query = $db->getQuery(true);

		//foreach ($banca as $membroId){
			// Insert columns.
			$columns = array('ban_tra_id', 'ban_doc_id');
			// Insert values.
			$values = array($traId, $banca[0]);
			// Prepare the insert query.
			$query
				->insert($db->quoteName('#__al_banca'))
				->columns($db->quoteName($columns))
				->values(implode(',', $values));
			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);
			$db->execute();
		//}
	}

	public function saveAutoria($traId, $autores){
		
		$db = JFactory::getDbo();
		// Create a new query object.
		$query = $db->getQuery(true);

		foreach ($autores as $autorId){
			// Insert columns.
			$columns = array('aut_tra_id', 'aut_dis_id');
			// Insert values.
			$values = array($traId, $autorId);
			// Prepare the insert query.
			$query
				->insert($db->quoteName('#__al_autoria'))
				->columns($db->quoteName($columns))
				->values(implode(',', $values));
			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);
			$db->execute();
		}
	}

	public function saveOrientacao($traId, $orientadores){
		
		$db = JFactory::getDbo();
		// Create a new query object.
		$query = $db->getQuery(true);

		foreach ($orientadores as $orientadorId){
			// Insert columns.
			$columns = array('ori_tra_id', 'ori_doc_id');
			// Insert values.
			$values = array($traId, $orientadorId);
			// Prepare the insert query.
			$query
				->insert($db->quoteName('#__al_orientacao'))
				->columns($db->quoteName($columns))
				->values(implode(',', $values));
			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);
			$db->execute();
		}
	}
	public function getAId(){
		$db = JFactory::getDbo();
		// Create a new query object.
		$query = $db->getQuery(true);
		$query
			->select('MAX('.$db->quoteName('tra_id').')')
			->from($db->quoteName('#__al_trabalhos'));
		$db->setQuery($query);
		$db->execute();
		$db->setQuery((string) $query);
		$result = $db->loadObjectList();
		$id = $result->tra_id;
		return $id == '' ? 1 : $id+1 ;
	}
   public function save($data = array(), $key = 'id'){
		//Debugging 
		ini_set("display_error" , 1);
		error_reporting(E_ALL);
		
		// Neccesary libraries and variables
		jimport('joomla.filesystem.file');
		// Get input object
		$jinput = JFactory::getApplication()->input;
		
		// Get posted data
		$data  = $jinput->get('jform', null, 'raw');

		$id = $this->getAId();
		//Pegando os arquivos
		$files = $this->input->files->get('jform', array(), 'array');
		//Salvando banca no DB
		$this->saveBanca($id, $data["banca"]);
		//Salvando autores no DB
		$this->saveAutoria($id, $data["autores"]);
		//Salvanco orientadores no DB
		$this->saveOrientacao($id, $data["orientadores"]);
		//Salvando arquivo do projeto, type = 0 = projeto
		$file_ext=strtolower(end(explode('.',JFile::makeSafe($files["projeto"][0]['name']))));
		$filename = $files["projeto"][0]['name'] = str_replace(' ', '-', $files["projeto"][0]['name']);
		// Move the uploaded file into a permanent location.
		if ( $filename != '' ) {
			// Make sure that the full file path is safe.s
			$data["tra_endereco_projeto"] = JPATH_ROOT."/uploads/". $filename;
			$filepath = JPath::clean(JPATH_ROOT."/uploads/". $filename);
			// Move the uploaded file.
			JFile::upload( $files["projeto"][0]['tmp_name'], $filepath );
		}

		$file_exttra=strtolower(end(explode('.',JFile::makeSafe($files["trabalho"][0]['name']))));
		$filenametra = $files["trabalho"][0]['name'] = str_replace(' ', '-', $files["trabalho"][0]['name']);
		// Move the uploaded file into a permanent location.
		if ( $filenametra != '' ) {
			// Make sure that the full file path is safe.s
			$data["tra_endereco_trabalho"] = JPATH_ROOT."/uploads/". $filenametra;
			$filepathtra = JPath::clean(JPATH_ROOT."/uploads/". $filenametra);
			// Move the uploaded file.
			JFile::upload( $files["projeto"][0]['tmp_name'], $filepathtra );
		}
		var_dump($data["banca"]);
		JRequest::setVar('jform', $data, 'post');
		$return = parent::save($data);
		return $return;
   }
}