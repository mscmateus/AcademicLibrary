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
    <form action="index.php?option=com_academiclibrary&view=academiclibrarydocentes" method="post" id="adminForm" name="adminForm">
        <div id="j-sidebar-container" class="span2">
            <?php echo JHtmlSidebar::render(); ?>
        </div>
        <div id="j-main-container" class="span10">
        <div class="row-fluid">
            <div class="span6">
                <?php echo JText::_('Pesquisar por nome'); ?>
                <?php
                    echo JLayoutHelper::render(
                        'joomla.searchtools.default',
                        array('view' => $this)
                    );
                ?>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th width="2%"><?php echo JText::_('#'); ?></th>
                <th width="4%">
                    <?php echo JHtml::_('grid.checkall'); ?>
                </th>
                <th width="90%">
                <?php echo JHtml::_('grid.sort', 'Nome do docente', 'doc_nome', $listDirn, $listOrder); ?>
                </th>
                <th width="4%">
                <?php echo JHtml::_('grid.sort', 'Id', 'doc_id', $listDirn, $listOrder); ?>
                </th>
            </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php if (!empty($this->items)) : ?>
                    <?php foreach ($this->items as $i => $row) :
                        $link = JRoute::_('index.php?option=com_academiclibrary&task=academiclibrarydocente.edit&doc_id=' . $row->doc_id);
                    ?>
                        <tr>
                            <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                            <td>
                                <?php echo JHtml::_('grid.id', $i, $row->doc_id); ?>
                            </td>
                            <td>
                                <a href="<?php echo $link; ?>" title="<?php echo JText::_('Inserção de docente'); ?>">
                                    <?php echo $row->doc_nome; ?>
                                </a>
                            </td>
                            <td align="center">
                                <?php echo $row->doc_id; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="boxchecked" value="0"/>
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
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