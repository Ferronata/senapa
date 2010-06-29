{*
 * AlunoDisciplina => View de manipulação de dados da classe 'AlunoDisciplina'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/alunodisciplina/AlunoDisciplina', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>AlunoDisciplina</h1>
				<sub>Gerencimento - AlunoDisciplina</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$aluno_disciplina->getId()}" />
					<div class="line">
						<label class="label required" for="disciplina_id">disciplina_id</label>
						<div class="innerLine">
							<select name=disciplina_id class="key input pequeno">
								{foreach item=item from=$disciplina}
									<option value="{$item.id}" {if $item.id == $aluno_disciplina->getDisciplinaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_matricula">aluno_pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="aluno_pessoa_escola_matricula" name="aluno_pessoa_escola_matricula" maxlength="10" value="{$aluno_disciplina->getAlunoPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_pessoa_fisica_pessoa_id">aluno_pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<select name=aluno_pessoa_escola_pessoa_fisica_pessoa_id class="key input pequeno">
								{foreach item=item from=$aluno_pessoa_escola_pessoa_fisica_pessoa}
									<option value="{$item.id}" {if $item.id == $aluno_disciplina->getAlunoPessoaEscolaPessoaFisicaPessoaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
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
