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
<form action="index.php?option=com_academiclibrary&view=academiclibrarydiscentes" method="post" id="adminForm" name="adminForm">
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
			<th width="10%">
			<?php echo JHtml::_('grid.sort', 'Matrícula', 'dis_matricula', $listDirn, $listOrder); ?>
			</th>
			<th width="80%">
			<?php echo JHtml::_('grid.sort', 'Nome do discente', 'dis_nome', $listDirn, $listOrder); ?>
			</th>
			<th width="4%">
			<?php echo JHtml::_('grid.sort', 'Id', 'dis_id', $listDirn, $listOrder); ?>
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
					$link = JRoute::_('index.php?option=com_academiclibrary&task=academiclibrarydiscente.edit&dis_id=' . $row->dis_id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->dis_id); ?>
						</td>
						<td align="center">
							<?php echo $row->dis_matricula; ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('Inserção de discente'); ?>">
								<?php echo $row->dis_nome; ?>
							</a>
						</td>
						<td align="center">
							<?php echo $row->dis_id; ?>
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