{*
 * AlunoAvaliacao => View de manipulação de dados da classe 'AlunoAvaliacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/alunoavaliacao/AlunoAvaliacao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>AlunoAvaliacao</h1>
				<sub>Gerencimento - AlunoAvaliacao</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$aluno_avaliacao->getId()}" />
					<div class="line">
						<label class="label required" for="avaliacao_id">avaliacao_id</label>
						<div class="innerLine">
							<select name=avaliacao_id class="key input pequeno">
								{foreach item=item from=$avaliacao}
									<option value="{$item.id}" {if $item.id == $aluno_avaliacao->getAvaliacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_matricula">aluno_pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="aluno_pessoa_escola_matricula" name="aluno_pessoa_escola_matricula" maxlength="10" value="{$aluno_avaliacao->getAlunoPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_pessoa_fisica_pessoa_id">aluno_pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<select name=aluno_pessoa_escola_pessoa_fisica_pessoa_id class="key input pequeno">
								{foreach item=item from=$aluno_pessoa_escola_pessoa_fisica_pessoa}
									<option value="{$item.id}" {if $item.id == $aluno_avaliacao->getAlunoPessoaEscolaPessoaFisicaPessoaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_acesso">data_acesso</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_acesso" name="data_acesso" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$aluno_avaliacao->getDataAcesso()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="date_create">date_create</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="date_create" name="date_create" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$aluno_avaliacao->getDateCreate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_update">date_update</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_update" name="date_update" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$aluno_avaliacao->getDateUpdate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_delete">date_delete</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_delete" name="date_delete" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$aluno_avaliacao->getDateDelete()}" />
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
