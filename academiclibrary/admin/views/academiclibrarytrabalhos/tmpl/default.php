<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_academiclibrary&view=academiclibrarytrabalhos" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
	<div class="row-fluid">
		<div class="span6">
			<?php echo JText::_('Pesquisar por título'); ?>
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

			<th width="4%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>

			<th width="4%">
			<?php echo JHtml::_('grid.sort', 'Id', 'tra_id', $listDirn, $listOrder); ?>
			</th>
			
			<th width="15%">
			<?php echo JHtml::_('grid.sort', 'Categoria', 'tra_cat', $listDirn, $listOrder); ?>
			</th>

			<th width="30%">
			<?php echo JHtml::_('grid.sort', 'Título', 'tra_titulo', $listDirn, $listOrder); ?>
			</th>
		
			<th width="25%">
			<?php echo JHtml::_('grid.sort', 'Autor', 'dis_nome', $listDirn, $listOrder); ?>
			</th>
			
			<th width="10%">
			<?php echo JHtml::_('grid.sort', 'ano', 'tra_ano', $listDirn, $listOrder); ?>
			</th>

			<th width="2%"><?php echo JText::_('#'); ?></th>

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
					$link = JRoute::_('index.php?option=com_academiclibrary&task=academiclibrarytrabalho.edit&tra_id=' . $row->tra_id);
				?>
					<tr>

						<td>
							<?php echo JHtml::_('grid.id', $i, $row->tra_id); ?>
						</td>

						<td align="center">
							<?php echo $row->tra_id; ?>
						</td>

						<td align="center">
								<?php echo ( $row->tra_cat==0 ? "Trabalho de Conclussão de Curso": "Relatório de Estágio"); ?>
							</a>
						</td>

						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('Inserção de trabalho acadêmico'); ?>">
								<?php echo $row->tra_titulo; ?>
							</a>
						</td>

						<td align="center">
							<?php echo $row->dis_nome; ?>
						</td>

						<td align="center">
							<?php echo $row->tra_ano; ?>
						</td>

						<td><?php echo $this->pagination->getRowOffset($i); ?></td>

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