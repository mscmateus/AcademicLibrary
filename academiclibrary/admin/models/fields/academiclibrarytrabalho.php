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

JFormHelper::loadFieldClass('list');

/**
 * HelloWorld Form Field class for the HelloWorld component
 *
 * @since  0.0.1
 */
class JFormFieldAcademicLibraryTrabalho extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'AcademicLibraryTrabalho';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{

		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select(
			'tra_id',
			'tra_tema',
			'tra_titulo',
			'tra_ano',
			'tra_cat',
			'tra_nota',
			'tra_palavras_chaves',
			'tra_resumo',
			'tra_autor',
			'tra_orientador',
			'tra_ban_id',
			'published',);
		$query->from('#__al_trabalhos');
		
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();


		$options  = array();
		
		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', 
				$message->tra_id,
				$message->tra_tema,
				$message->tra_titulo,
				$message->tra_ano,
				$message->tra_cat,
				$message->tra_nota,
				$message->tra_palavras_chaves,
				$message->tra_resumo,
				$message->tra_defesa_data,
				$message->tra_endereco_projeto,
				$message->tra_endereco_trabalho,
				$message->published;
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}