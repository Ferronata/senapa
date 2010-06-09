{*
 * Disciplina => View de manipulação de dados da classe 'Disciplina'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
	<div class="content">
		<div class="line">
			<div class="divDatagridObjects">
				<table class="datagridObjects" id="values">
					<thead>
						<tr class="gridTitle">
							<td class="left">Disciplinas</td>
						</tr>
					</thead>
					<tbody>
						{foreach item=item from=$listaDisciplina->getDisciplinas()}
						    <tr>
						    	<td class="left"><input type="hidden" name="lista_disciplina[]" value="{$item->getId()}" />{$item->getNome()}</td>
						    </tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>
	</div>