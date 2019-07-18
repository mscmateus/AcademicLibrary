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
?>
<input id="jform_title" type="hidden" name="helloworld-message-title"/>
<div class="form-horizontal">
<h1><?php echo $this->item->tra_cat==0 ? 'Trabalho de Conclusão de Curso' : 'Relatório de Estágio' ?></h1>
<?php echo JHtml::_('bootstrap.startTabSet', 'TrabalhosTab', $options);?> 
    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'sobreTab', JText::_('Sobre o trabalho')); ?> 
        <fieldset class="adminform">
            <div class="row-fluid">
                <div class="span6">
                    <h3>Título: <?php echo $this->item->tra_titulo ?></h3>
                    <p>Tema: <?php echo $this->item->tra_tema ?></p>
                    <p>Ano: <?php echo $this->item->tra_ano ?></p>
                    <p>Palavras-chaves: <?php echo $this->item->tra_palavras_chaves ?></p>
                    <p>Resumo: <?php echo $this->item->tra_resumo ?></p>
                </div>
            </div>
        </fieldset>
    <?php echo JHtml::_('bootstrap.endTab');?> 

    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'autoriaTab', JText::_('Autoria e Orientação')); ?> 
        <fieldset class="adminform">
            <div class="row-fluid">
                <div class="span6">
                    <p>Autoria: <?php
                    $aux=0;
                    foreach ($this->item->autores as $autor){
                        if($aux!= sizeof($this->item->autores)-1){
                            echo  $autor.", ";
                        }else{
                            echo  $autor;
                        }
                        $aux++;
                    }
                    ?></p>
                    <p>Orientação: <?php 
                    $aux=0;
                    foreach ($this->item->orientadores as $orientador){
                        if($aux!= sizeof($this->item->orientadores)-1){
                            echo $orientador.", ";
                        }else{
                            echo $orientador;
                        }
                        $aux++;
                    }?></p>
                </div>
            </div>
        </fieldset>
    <?php echo JHtml::_('bootstrap.endTab');?>

    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'bancaTab', JText::_('Banca avaliadora')); ?> 
        <fieldset class="adminform">
            <div class="row-fluid">
                <div class="span6">
                    <p>Data de defesa: <?php echo $this->item->tra_defesa_data ?></p>
                    <p>Membros da banca: <?php 
                    $aux=0;
                    foreach ($this->item->banca as $membro){
                        if($aux!= sizeof($this->item->banca)-1){
                            echo $membro.", ";
                        }else{
                            echo $membro;
                        }
                        $aux++;
                    }?></p>
                </div>
            </div>
        </fieldset> 
    <?php echo JHtml::_('bootstrap.endTab');?>

    <?php echo JHtml::_('bootstrap.addTab', 'TrabalhosTab', 'arquivosTab', JText::_('Arquivos')); ?> 
        <fieldset class="adminform">
            <div class="row-fluid">
                <div class="span6">
                    <?php echo 'link do arquivo'  ?>
                </div>
            </div>
        </fieldset>
    <?php echo JHtml::_('bootstrap.endTab');?>

<?php echo JHtml::_('bootstrap.endTabSet');?>
</div>
<input type="hidden" name="task" value="academiclibrarytrabalho.exibi" />
<?php echo JHtml::_('form.token'); ?>
