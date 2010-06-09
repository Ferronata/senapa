	<div class="line" style="margin-left: 10px;">
		<label class="label" for="Aluno">Aluno</label>
		<div class="innerLine">
			<select id="Aluno" name=Aluno class="input medio" onchange="rerenderAvaliacaoAluno(this,$('avaliacoes'))">
				<option>Selecione</option>
				{foreach item=item from=$alunos}
					<option value="{$item->getId()}">{$item->getNome()}</option>
				{/foreach}
			</select>
		</div>
	</div>
	<div id="avaliacoes">
		
	</div>