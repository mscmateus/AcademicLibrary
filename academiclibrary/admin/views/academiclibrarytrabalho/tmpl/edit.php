<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

    // No direct access
    defined('_JEXEC') or die('Restricted access');



    $options = array(
        'active'    => 'sobreTab'    // Not in docs, but DOES work
    );
    $vetFild;
    jimport('joomla.filesystem.folder');
    jimport('joomla.filesystem.file');
?>
<form action="<?php echo JRoute::_('index.php?option=com_academiclibrary&layout=edit&tra_id=' . (int) $this->item->tra_id); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <input id="jform_title" type="hidden" name="helloworld-message-title"/>
    <div class="form-horizontal">
    <?php echo JHtml::_('bootstrap.startTabSet', 'TrabalhosTab', $options);?> 
        <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'sobreTab', JText::_('Sobre o trabalho')); ?> 
            <fieldset class="adminform">
                <legend><?php echo JText::_('Informações básicas do trabalho') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php
                        echo $this->form->renderFieldset('sobreotrabalho');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab');?> 

        <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'autoriaTab', JText::_('Autoria e Orientação')); ?> 
            <fieldset class="adminform">
            <legend><?php echo JText::_('Autoria e orientação do trabalho') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php
                        echo $this->form->renderFieldset('autoria'); 
                        ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab');?>

        <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'bancaTab', JText::_('Banca avaliadora')); ?> 
            <fieldset class="adminform">
            <legend><?php echo JText::_('Banca avaliadora do trabalho') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $this->form->renderFieldset('banca');  ?>
                    </div>
                </div>
            </fieldset> 
        <?php echo JHtml::_('bootstrap.endTab');?>

        <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'arquivosTab', JText::_('Arquivos')); ?> 
            <fieldset class="adminform">
            <legend><?php echo JText::_('Arquivos relacionados ao trabalho') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php if(JFile::exists(JPATH_ROOT."/uploads/".$this->item->tra_endereco_trabalho)){
                            echo "Arquivos atual: ".$this->item->tra_endereco_trabalho;
                        }?>
                        <?php echo $this->form->renderField('trabalho');?>
                        <?php if(JFile::exists(JPATH_ROOT."/uploads/".$this->item->tra_endereco_projeto)){
                            echo 'Arquivos atual: '. $this->item->tra_endereco_projeto;
                        }?>
                        <?php echo $this->form->renderField('projeto');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab');?>

    <?php echo JHtml::_('bootstrap.endTabSet');?>
    </div>
    <input type="hidden" name="task" value="academiclibrarytrabalho.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
