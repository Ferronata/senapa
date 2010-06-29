	<div class="line" style="margin-left: 10px;">
		<label class="label" for="Aluno">Professor</label>
		<div class="innerLine">
			<select id="Professor" name=Professor class="input medio" onchange="rerenderFinalizarAvaliacao(this,$('avaliacoes'))">
				<option>Selecione</option>
				{foreach item=item from=$professores}
					<option value="{$item->getId()}">{$item->getNome()}</option>
				{/foreach}
			</select>
		</div>
	</div>
	<div id="avaliacoes">
		
	</div>