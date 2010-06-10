{*
 * FeedbackAvaliacaoAlternativa => View de manipula��o de dados da classe 'FeedbackAvaliacaoAlternativa'
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @version 1.0
 *}
				<div class="content">
					<div class="line">
						<label class="label" for="alternativaDescricao">Alternativa</label>
						<div class="innerLine">
							<textarea class="input normal" id="alternativaDescricao" name="alternativaDescricao"></textarea>
						</div>
					</div>
				</div>
				<div><input type="button" class="addElement" onclick="addComponentText($('values'),$('alternativaDescricao'),$('contadorAlternativa'))" value="Adicionar"></div>
				<input type="hidden" id="contadorAlternativa" name="contadorAlternativa" value="0" />
				<div class="divDatagridObjects">
					<table class="datagridObjects" id="values">
						<thead>
							<tr class="gridTitle">
								<td style="text-align: left; padding: 0 2px;">Alternativas</td>
								<td style="width: 16px;"></td>
							</tr>
						</thead>
						<tbody>
							{foreach item=item from=$alternativas->getAlternativas()}
							    <tr>
							    	<td class="left"><input type="hidden" name="lista_alternativa_id[]" value="{$item->getId()}" />{$item->getDescricao()}</td>
							    	<td><input type="button" class="bt_remove" onclick="removeDefaultComponent(this)" value="remover" /></td>
							    </tr>
							{/foreach}
						</tbody>
					</table>
					</div>