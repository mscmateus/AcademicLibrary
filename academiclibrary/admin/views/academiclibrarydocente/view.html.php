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
 * HelloWorld View
 *
 * @since  0.0.1
 */
class AcademicLibraryViewAcademicLibraryDocente extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form = null;

	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}


		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;

		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);

		$isNew = ($this->item->doc_id == 0);

		if ($isNew)
		{
			$title = JText::_('Inserção de docente');
		}
		else
		{
			$title = JText::_('Edição de docente');
		}

		JToolbarHelper::title($title, 'academiclibrarydocente');
		JToolbarHelper::save('academiclibrarydocente.save');
		JToolbarHelper::cancel(
			'academiclibrarydocente.cancel',
			$isNew ? 'Cancelar' : 'Fechar'
		);
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$isNew = ($this->item->doc_id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('Academic Library - Inserção de docente') :
                JText::_('Academic Library - Edição de docente'));
	}
}