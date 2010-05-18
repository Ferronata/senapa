{*
 * ProfessorAvaliacao => View de manipulação de dados da classe 'ProfessorAvaliacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/professoravaliacao/ProfessorAvaliacao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>ProfessorAvaliacao</h1>
				<sub>Gerencimento - ProfessorAvaliacao</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$professor_avaliacao->getId()}" />
					<div class="line">
						<label class="label required" for="avaliacao_id">avaliacao_id</label>
						<div class="innerLine">
							<select name=avaliacao_id class="key input pequeno">
								{foreach item=item from=$avaliacao}
									<option value="{$item.id}" {if $item.id == $professor_avaliacao->getAvaliacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="professor_pessoa_escola_matricula">professor_pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="professor_pessoa_escola_matricula" name="professor_pessoa_escola_matricula" maxlength="10" value="{$professor_avaliacao->getProfessorPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="professor_pessoa_escola_pessoa_fisica_pessoa_id">professor_pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<select name=professor_pessoa_escola_pessoa_fisica_pessoa_id class="key input pequeno">
								{foreach item=item from=$professor_pessoa_escola_pessoa_fisica_pessoa}
									<option value="{$item.id}" {if $item.id == $professor_avaliacao->getProfessorPessoaEscolaPessoaFisicaPessoaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_cadastro">data_cadastro</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_cadastro" name="data_cadastro" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$professor_avaliacao->getDataCadastro()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="date_create">date_create</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="date_create" name="date_create" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$professor_avaliacao->getDateCreate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_update">date_update</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_update" name="date_update" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$professor_avaliacao->getDateUpdate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_delete">date_delete</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_delete" name="date_delete" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$professor_avaliacao->getDateDelete()}" />
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
