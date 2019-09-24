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
	public $edicao = true;
	public function saveBanca($traId, $banca){
		
		$db = JFactory::getDbo();
		// Create a new query object.
		$query = $db->getQuery(true);

		if($this->edicao == true){
			$query->delete($db->quoteName('#__al_banca'));
			$query->where($db->quoteName('ban_tra_id'). '=' . $traId);
			$db->setQuery($query);
			$db->execute();
		}

		foreach ($banca as $membroId){
			$query = $db->getQuery(true);
			// Insert columns.
			$columns = array('ban_tra_id', 'ban_doc_id');
			// Insert values.
			$values = array($traId, $membroId);
			// Prepare the insert query.
			$query
				->insert($db->quoteName('#__al_banca'))
				->columns($db->quoteName($columns))
				->values(implode(',', $values));
			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);
			$db->execute();
		}
	}

	public function saveAutoria($traId, $autores){
		
		$db = JFactory::getDbo();
		// Create a new query object.
		$query = $db->getQuery(true);

		if($this->edicao == true){
			$query->delete($db->quoteName('#__al_autoria'));
			$query->where($db->quoteName('aut_tra_id'). '=' . $traId);
			$db->setQuery($query);
			$db->execute();
		}

		foreach ($autores as $autorId){
			$query = $db->getQuery(true);
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
		if($this->edicao == true){
			$query->delete($db->quoteName('#__al_orientacao'));
			$query->where($db->quoteName('ori_tra_id'). '=' . $traId);
			$db->setQuery($query);
			$db->execute();
		}

		foreach ($orientadores as $orientadorId){
			$query = $db->getQuery(true);
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
			->select('MAX('.$db->quoteName('tra_id').') as max')
			->from($db->quoteName('#__al_trabalhos'));
		$db->setQuery($query);
		$db->execute();
		$db->setQuery((string) $query);
		$result = $db->loadObjectList();
		$id = $result[0]->max;
		$this->edicao = false;
		if($id == NULL){
			$id=1;
			$query= 'ALTER TABLE #__al_trabalhos AUTO_INCREMENT = 0';
			$db->setQuery($query);
			$db->execute();
		}else{
			$id = (int) $result[0]->max;
			$id++;
		}
		return  $id  ;
	}
   public function save($data = array(), $key = 'id'){
		//Debugging 
		ini_set("display_error" , 1);
		error_reporting(E_ALL);
		
		// Neccesary libraries and variables
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		// Get input object
		$jinput = JFactory::getApplication()->input;
		
		// Get posted data
		$data  = $jinput->get('jform', null, 'raw');
		if($data["tra_id"]=='' || $data["tra_id"]==null){
			$id = $this->getAId();
		}else{
			$id=$data["tra_id"];
		}
		//Pegando os arquivos
		$files = $this->input->files->get('jform', array(), 'array');
		//Salvando banca no DB
		$this->saveBanca($id, $data["banca"]);
		//Salvando autores no DB
		$this->saveAutoria($id, $data["autores"]);
		//Salvanco orientadores no DB
		$this->saveOrientacao($id, $data["orientadores"]);
		//Salvando arquivo do projeto, type = 0 = projeto
		
		$projeto = $files["projeto"];
		$trabalho = $files["trabalho"];

		if($projeto["name"] != ''){
			$extencao = explode(".", $projeto["name"]);
			$projeto["name"] = "pro".time().".".$extencao[sizeof($extencao)-1];
		}
		if($trabalho["name"] != ''){
			$extencao = explode(".", $trabalho["name"]);
			$trabalho["name"] = "tra".time().".".$extencao[sizeof($extencao)-1];
		}


		$file_exttra=strtolower(end(explode('.',JFile::makeSafe($trabalho['name']))));
		$filenametra = $trabalho['name'] = str_replace(' ', '-', $trabalho['name']);
		// Move the uploaded file into a permanent location.
		if ( $filenametra != '' && $filenametra != $data["tra_endereco_projeto"]) {
			// Make sure that the full file path is safe.s
			$filepathtra = JPath::clean(JPATH_ROOT."/uploads/". $filenametra);
			// Move the uploaded file.
			if($this->edicao == true){
					JFile::delete(JPath::clean(JPATH_ROOT."/uploads/".$data["tra_endereco_trabalho"]));
					$data["tra_endereco_trabalho"] = "";
					if(JFile::upload( $trabalho['tmp_name'], $filepathtra )){
						$data["tra_endereco_trabalho"] = $filenametra;
					}
			}else{
				if(JFile::upload( $trabalho['tmp_name'], $filepathtra )){
					//JFile::delete(JPath::clean(JPATH_ROOT."/uploads/".$data["tra_endereco_projeto"]));
					$data["tra_endereco_trabalho"] = $filenametra;
				}
			}
		}

		$file_exttra=strtolower(end(explode('.',JFile::makeSafe($projeto['name']))));
		$filenametra = $projeto['name'] = str_replace(' ', '-', $projeto['name']);
		// Move the uploaded file into a permanent location.
		if ( $filenametra != '' && $filenametra != $data["tra_endereco_projeto"]) {
			// Make sure that the full file path is safe.s
			$filepathtra = JPath::clean(JPATH_ROOT."/uploads/". $filenametra);
			// Move the uploaded file.
			if($this->edicao == true){
					JFile::delete(JPath::clean(JPATH_ROOT."/uploads/".$data["tra_endereco_projeto"]));
					$data["tra_endereco_projeto"] = "";
					if(JFile::upload( $projeto['tmp_name'], $filepathtra )){
						$data["tra_endereco_projeto"] = $filenametra;
					}
			}else{
				if(JFile::upload( $projeto['tmp_name'], $filepathtra )){
					//JFile::delete(JPath::clean(JPATH_ROOT."/uploads/".$data["tra_endereco_projeto"]));
					$data["tra_endereco_projeto"] = $filenametra;
				}
			}
		}





		JRequest::setVar('jform', $data, 'post');
		$return = parent::save($data);
		return $return;
	}
}