{*
 * Disciplina => View de manipulação de dados da classe 'Disciplina'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
	<div class="content">
		<div class="line">
			<label class="label" for="disciplina">Disciplina</label>
			<div class="innerLine">
				<select name=disciplina class="input pequeno">
					{foreach item=item from=$disciplinas}
						<option value="{$item.id}">{$item.nome}</option>
					{foreachelse}
						<option>Nenhum Registro</option>
					{/foreach}
				</select>
			</div>
			<div><input type="button" class="addElement" onclick="addComponent($('values'),[{'disciplina'}])" value="Adicionar"></div>
			<div class="divDatagridObjects">
				<table class="datagridObjects" id="values">
					<thead>
						<tr class="gridTitle">
							<td>Disciplinas</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						{foreach item=item from=$listaDisciplina->getDisciplinas()}
						    <tr>
						    	<td><input type="hidden" name="lista_disciplina[]" value="{$item->getId()}" />{$item->getNome()}</td>
						    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
						    </tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>
	</div>