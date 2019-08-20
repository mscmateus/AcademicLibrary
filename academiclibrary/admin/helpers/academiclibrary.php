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
 * HelloWorld component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class AcademicLibraryHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */

	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(
			JText::_('Categorias'),
			'index.php?option=com_academiclibrary&view=academiclibrarycategorias',
			$submenu == 'academiclibrarycategorias'
		);
		JHtmlSidebar::addEntry(
			JText::_('Docentes'),
			'index.php?option=com_academiclibrary&view=academiclibrarydocentes',
			$submenu == 'academiclibrarydocentes'
		);
		JHtmlSidebar::addEntry(
			JText::_('Discentes'),
			'index.php?option=com_academiclibrary&view=academiclibrarydiscentes',
			$submenu == 'academiclibrarydiscentes'
		);
		JHtmlSidebar::addEntry(
			JText::_('Trabalhos Acadêmicos'),
			'index.php?option=com_academiclibrary&view=academiclibrarytrabalhos',
			$submenu == 'academiclibrarytrabalhos'
		);
	}
}