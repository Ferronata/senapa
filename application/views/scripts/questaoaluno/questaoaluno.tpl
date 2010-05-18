{*
 * QuestaoAluno => View de manipulação de dados da classe 'QuestaoAluno'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/questaoaluno/QuestaoAluno', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>QuestaoAluno</h1>
				<sub>Gerencimento - QuestaoAluno</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$questao_aluno->getId()}" />
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_matricula">aluno_pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="aluno_pessoa_escola_matricula" name="aluno_pessoa_escola_matricula" maxlength="10" value="{$questao_aluno->getAlunoPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_pessoa_fisica_pessoa_id">aluno_pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<select name=aluno_pessoa_escola_pessoa_fisica_pessoa_id class="key input pequeno">
								{foreach item=item from=$aluno_pessoa_escola_pessoa_fisica_pessoa}
									<option value="{$item.id}" {if $item.id == $questao_aluno->getAlunoPessoaEscolaPessoaFisicaPessoaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="questao_id">questao_id</label>
						<div class="innerLine">
							<select name=questao_id class="key input pequeno">
								{foreach item=item from=$questao}
									<option value="{$item.id}" {if $item.id == $questao_aluno->getQuestaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="inicio">inicio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="inicio" name="inicio" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$questao_aluno->getInicio()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="tempo_resolucao">tempo_resolucao</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="tempo_resolucao" name="tempo_resolucao" onkeypress="mascara(this,hora)" maxlength="5" value="{$questao_aluno->getTempoResolucao()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="resposta">resposta</label>
						<div class="innerLine">
							<input type="text" class="input pequeno" id="resposta" name="resposta" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$questao_aluno->getResposta()}" />
						</div>
					</div>
				</div>
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>
