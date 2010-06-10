{*
 * QuestaoAlternativa => View de manipulação de dados da classe 'QuestaoAlternativa'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
 {literal}
 <style type="text/css">
 	.left{text-align: left !important; padding: 0 2px !important;}
 </style>
 {/literal}
				<div class="content">				
					<div class="line">
						<label class="label" for="alternativa_descricao">Alternativa</label>
						<div class="innerLine">
							<textarea class="input normal" id="alternativa_descricao" name="alternativa_descricao"></textarea>
						</div>
					</div>
					<div><input type="button" class="addElement" onclick="addComponentRadio($('values'),[{'alternativa_descricao'}],$('contadorAlternativa'))" value="Adicionar"></div>
					<input type="hidden" id="contadorAlternativa" name="contadorAlternativa" value="0" />
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="values">
							<thead>
								<tr class="gridTitle">
									<td style="text-align: left; padding: 0 2px;">Descrição</td>
									<td style="width: 16px;">Resposta</td>
									<td style="width: 16px;"></td>
								</tr>
							</thead>
							<tbody>
								{foreach item=item from=$alternativas->getAlternativas()}
								    <tr>
								    	<td class="left"><input type="hidden" name="lista_alternativa_id[]" value="{$item->getId()}" />{$item->getDescricao()}</td>
								    	<td><input type="radio" name="lista_radio" {if $item->getId() == $object->getResposta()} checked="checked" {/if} value="{$item->getId()}" /></td>
								    	<td><input type="button" class="bt_remove" onclick="removeCheckboxComponent(this)" value="remover" /></td>
								    </tr>
								{/foreach}
							</tbody>
						</table>
					</div>
				</div>