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
?>

<legend><?php echo JText::_('Detalhes'); ?></legend>
<?php echo JHtml::_('bootstrap.startTabSet', 'TrabalhosTab', $options);?> 

    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'sobreTab', JText::_('Sobre o trabalho')); ?> 
        <form action="<?php echo JRoute::_('index.php?option=com_academiclibrary&layout=edit&tra_id=' . (int) $this->item->tra_id); ?>"
        method="post" name="adminForm" id="adminForm">
            <div class="form-horizontal">
                <fieldset class="adminform">
                    <div class="row-fluid">
                        <div class="span6">
                            <?php
                            $vetFild;
                            $aux=0;
                            foreach ($this->form->getFieldset() as $field):
                                $vetFild[$aux] = $field;
                                $aux++;
                            endforeach; ?>
                            <?php for($i = 0; $i< 8; $i++){?>
                                <div class="control-group">
                                    <div class="control-label"><?php echo $vetFild[$i]->label; ?></div>
                                    <div class="controls"><?php echo $vetFild[$i]->input; ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </fieldset>
            </div>
            <input type="hidden" name="task" value="academiclibrarytrabalho.edit" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
    <?php echo JHtml::_('bootstrap.endTab');?> 

    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'autoriaTab', JText::_('Autoria e Orientação')); ?> 
    <form action="<?php echo JRoute::_('index.php?option=com_academiclibrary&layout=edit&tra_id=' . (int) $this->item->tra_id); ?>"
        method="post" name="adminForm" id="adminForm">
            <div class="form-horizontal">
                <fieldset class="adminform">
                    <div class="row-fluid">
                        <div class="span6">
                            <?php for($i = 8; $i< 9; $i++){?>
                                <div class="control-group">
                                    <div class="control-label"><?php echo $vetFild[$i]->label; ?></div>
                                    <div class="controls"><?php echo $vetFild[$i]->input; ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </fieldset>
            </div>
            <input type="hidden" name="task" value="academiclibrarytrabalho.edit" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
    <?php echo JHtml::_('bootstrap.endTab');?>

    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'bancaTab', JText::_('Banca avaliadora')); ?> 
        <p>Content of the second tab.</p> 
    <?php echo JHtml::_('bootstrap.endTab');?>

    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'arquivosTab', JText::_('Arquivos')); ?> 
        <p>Content of the second tab.</p> 
    <?php echo JHtml::_('bootstrap.endTab');?>

<?php echo JHtml::_('bootstrap.endTabSet');?>