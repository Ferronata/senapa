		
		<div class="line">
			<label class="label required" for="Disciplina">Disciplinas</label>
			<div class="innerLine">
				<select id="Disciplina" name=Disciplina class="key input medio" onchange="rerenderDiscAssunto(this,[{'Assunto'}])">
					<option>Selecione</option>
					{foreach item=item from=$disciplinas}
						<option value="{$item.id}" {if $item.id == $disciplina->getId()}selected="selected"{/if}>{$item.nome}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="line">
			<label class="label required" for="Assunto">Assunto</label>
			<div class="innerLine">
				<select id="Assunto" name=Assunto class="key input medio">
					<option>Selecione</option>
					{foreach item=item from=$assuntos}
						<option value="{$item.id}" {if $item.id == $assuntoQuestao->getAssuntoId()}selected="selected"{/if}>{$item.nome}</option>
					{/foreach}
				</select>
			</div>
		</div>