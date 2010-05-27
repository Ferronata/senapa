		<div class="content">
				<div class="line">
					<div class="innerLine">
						<div style="width: 30%; float:left; border-right: 1px solid #666666;">
							<label class="label" for="tpPesqusia">Tipo de Pesquisa</label>
							<select id="tpPesqusia" name="tpPesqusia">
								<option value="{$object->getTipoPesquisa('QUESTAO')}">Questões</option>
								<option value="{$object->getTipoPesquisa('AVALIACAO')}">Avaliações</option>
							</select>
						</div>
						<div style="width: 68%; float:right;">
							<label class="label">Nível</label>
						{foreach item=item from=$niveis}
							<label><input type="checkbox" name="lista_niveis[]" value="{$item->getNivel()}" />{$item->getNivel()}</label>
						{/foreach}
						</div>
					</div>
				</div>
				
				<div class="line">
					<label class="label required" for="Disciplina">Disciplinas</label>
					<div class="innerLine">
						<select id="Disciplina" name=Disciplina class="key input medio" onchange="rerenderCheckDiscAssunto(this,$('values'))">
							<option>Selecione</option>
							{foreach item=item from=$disciplinas}
								<option value="{$item.id}">{$item.nome}</option>
							{/foreach}
						</select>
					</div>
				</div>
				<hr />
				<div class="divDatagridObjects">
					<table class="datagridObjects" id="values">
						<thead>
							<tr class="gridTitle">
								<td style="width: 18px;">&nbsp;</td>
								<td class="left">Assuntos</td>
							</tr>
						</thead>
											
					</table>
				</div>
				<hr />
				<div class="line">
					<div class="innerLine">
						<input type="button" value="Buscar" onclick="findQuestions($('form'),$('questoes'))" />
					</div>
				</div>
			
			<p />
			<p />
			
			<hr />
			{* {popup sticky=false closetext="X" caption="Detalhes" text="Assuntos" snapx=5 snapy=5} *}
			<div class="divDatagridObjects">
				<table class="datagridObjects" id="questoes">
					<thead>
						<tr class="gridTitle">
							<td style="width: 18px;">&nbsp;</td>
							<td style="width: 18px;">&nbsp;</td>
							<td class="left">Questões</td>
						</tr>
					</thead>
										
				</table>
			</div>
			
		</div>