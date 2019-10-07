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
<h3><?php echo $this->item->tra_cat_titulo ?></h3> 
        <fieldset class="adminform">
            <div class="row-fluid">
                <div class="span6">
                    <h1><?php echo $this->item->tra_titulo ?></h1>
                    <br/>
                    <h4>Sobre o trabalho</h4>
                    <p><strong>Tema</strong>: <?php echo $this->item->tra_tema ?></p>
                    <p><strong>Autoria</strong>: <?php
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
                    <p><strong>Orientação</strong>: <?php 
                    $aux=0;
                    foreach ($this->item->orientadores as $orientador){
                        if($aux!= sizeof($this->item->orientadores)-1){
                            echo $orientador.", ";
                        }else{
                            echo $orientador;
                        }
                        $aux++;
                    }?></p>
                    <p><strong>Ano</strong>: <?php echo $this->item->tra_ano ?></p>
                    <p><strong>Nota</strong>: <?php echo $this->item->tra_nota == 0.0 ? "Não definida": $this->item->tra_nota ?></p>
                    <p><strong>Palavras-chaves</strong>: <?php echo $this->item->tra_palavras_chaves ?></p>
                    <p><strong>Resumo</strong>: <?php echo $this->item->tra_resumo ?></p>

                    <p><strong>Membros da banca</strong>: <?php 
                    $aux=0;
                    foreach ($this->item->banca as $membro){
                        if($aux!= sizeof($this->item->banca)-1){
                            echo $membro.", ";
                        }else{
                            echo $membro;
                        }
                        $aux++;
                    }?></p>
                    <p><strong>Data de defesa</strong>: <?php 
                        echo $item->tra_defesa_data = date_format(date_create($this->item->tra_defesa_data), "d/m/Y");
                    ?></p>
                    <br/>
                    <h4>Download de arquivos</h4>

                    <?php
                        jimport('joomla.filesystem.file');
                        jimport( 'joomla.environment.uri' );

                        if(JFile::exists(JPath::clean(JPATH_ROOT."/academicUploads/".$this->item->tra_endereco_trabalho))){
                            $link = JUri::root().JPath::clean("/academicUploads/".$this->item->tra_endereco_trabalho);
                            echo '<a target="_blank" href="'.$link.'">Arquivo do trabalho</a><br/>';
                        }else{
                            echo 'Não há arquivo do trabalho disponível.<br/>';
                        }

                        if(JFile::exists(JPath::clean(JPATH_ROOT."/academicUploads/".$this->item->tra_endereco_projeto))){
                            $link = JUri::root().JPath::clean("/academicUploads/".$this->item->tra_endereco_projeto);
                            echo '<a target="_blank" href="'.$link.'">Arquivo do projeto</a><br/>';
                        }else{
                            echo 'Não há arquivo do projeto disponível.';
                        }
                    ?>
                </div>
            </div>
        </fieldset>
</div>
<input type="hidden" name="task" value="academiclibrarytrabalho.exibi" />
<?php echo JHtml::_('form.token'); ?>
