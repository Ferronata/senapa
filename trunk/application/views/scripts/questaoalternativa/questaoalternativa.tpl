{*
 * QuestaoAlternativa => View de manipulação de dados da classe 'QuestaoAlternativa'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
				<div class="content">				
					<div class="line">
						<label class="label" for="descricao">Alternativa</label>
						<div class="innerLine">
							<textarea class="input normal" id="alternativa_descricao" name="alternativa_descricao"></textarea>
						</div>
					</div>
					<div><input type="button" class="addElement" onclick="addComponent($('values'),[{'alternativa_descricao'}])" value="Adicionar"></div>
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="values">
							<thead>
								<tr class="gridTitle">
									<td>Descrição</td>
									<td>Resposta</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								{foreach item=item from=$telefones}
								    <tr>
								    	<td><input type="hidden" name="listaalternativa[]" value="{$item.id}" />{$item.descricao}</td>
								    	<td><input type="radio" name="resposta" value="1" /></td>
								    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
								    </tr>
								{/foreach}
							</tbody>
						</table>
					</div>
				</div>