<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component.
 *
 * The name of this class is dependent on the component being installed.
 * The class name should have the component's name, directly followed by
 * the text InstallerScript (ex:. com_helloWorldInstallerScript).
 *
 * This class will be called by Joomla!'s installer, if specified in your component's
 * manifest file, and is used for custom automation actions in its installation process.
 *
 * In order to use this automation script, you should reference it in your component's
 * manifest file as follows:
 * <scriptfile>script.php</scriptfile>
 *
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport( 'joomla.environment.uri' );

class com_academicLibraryInstallerScript
{
    /**
     * This method is called after a component is installed.
     *
     * @param  \stdClass $parent - Parent object calling this method.
     *
     * @return void
     */
    public function install($parent) 
    {
        $parent->getParent()->setRedirectURL('index.php?option=com_academiclibrary');
    }

    /**
     * This method is called after a component is uninstalled.
     *
     * @param  \stdClass $parent - Parent object calling this method.
     *
     * @return void
     */
    public function uninstall($parent) 
    {
        if(JFolder::exists(JPath::clean(JPATH_ROOT."/academicUploads/"))){
            JFolder::delete(JPath::clean(JPATH_ROOT."/academicUploads/"));
        }
      echo '<p>' . JText::_('Academic Library desinstalado com sucesso. :(') . '</p>';
   }

    /**
     * This method is called after a component is updated.
     *
     * @param  \stdClass $parent - Parent object calling object.
     *
     * @return void
     */
    public function update($parent) 
    {
        echo '<p>' . JText::sprintf('Academic Library atualizado com sucesso.', $parent->get('manifest')->version) . '</p>';
    }
}