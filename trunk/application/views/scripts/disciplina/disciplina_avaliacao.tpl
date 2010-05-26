		<div class="content">
			<div class="line">
				<div class="innerLine">
					<div style="width: 30%; float:left; border-right: 1px solid #666666;">
						<label class="label required" for="buscar">Buscar</label>
						<select id="buscar" name=buscar>
							<option value="{$object->getTipoPesquisa('QUESTAO')}">Questões</option>
							<option value="{$object->getTipoPesquisa('AVALIACAO')}">Avaliações</option>
						</select>
					</div>
					<div style="width: 68%; float:right;">
						<label class="label">Nível</label>
					{foreach item=item from=$niveis}
						<label><input type="checkbox" name="lista_niveis" value="{$item->getNivel()}" />{$item->getNivel()}</label>
					{/foreach}
					</div>
				</div>
			</div>
			
			<div class="line">
				<label class="label required" for="Disciplina">Disciplinas</label>
				<div class="innerLine">
					<select id="Disciplina" name=Disciplina class="key input medio" onchange="rerenderDiscAssunto(this,[{'Assunto'}])">
						<option>Selecione</option>
						{foreach item=item from=$disciplinas}
							<option value="{$item.id}">{$item.nome}</option>
						{/foreach}
					</select>
				</div>
			</div>
			<hr />
			<div class="line">
				<label class="label required" for="assunto">Assuntos</label>
				<div class="innerLine">
					<div id="assuntos">
					</div>
				</div>
			</div>
			<hr />
			<div class="line">
				<div class="innerLine">
					<input type="button" value="Buscar" onclick="alert('Ok')" />
				</div>
			</div>
		</div>