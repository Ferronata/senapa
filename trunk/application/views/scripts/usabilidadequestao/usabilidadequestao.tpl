{*
 * UsabilidadeQuestao => View de manipulação de dados da classe 'UsabilidadeQuestao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/usabilidadequestao/UsabilidadeQuestao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>UsabilidadeQuestao</h1>
				<sub>Gerencimento - UsabilidadeQuestao</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$usabilidade_questao->getId()}" />
					<div class="line">
						<label class="label required" for="avaliacao_id">avaliacao_id</label>
						<div class="innerLine">
							<select name=avaliacao_id class="key input pequeno">
								{foreach item=item from=$avaliacao}
									<option value="{$item.id}" {if $item.id == $usabilidade_questao->getAvaliacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="professor_pessoa_escola_matricula">professor_pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="professor_pessoa_escola_matricula" name="professor_pessoa_escola_matricula" maxlength="10" value="{$usabilidade_questao->getProfessorPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="professor_pessoa_escola_pessoa_fisica_pessoa_id">professor_pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<select name=professor_pessoa_escola_pessoa_fisica_pessoa_id class="key input pequeno">
								{foreach item=item from=$professor_pessoa_escola_pessoa_fisica_pessoa}
									<option value="{$item.id}" {if $item.id == $usabilidade_questao->getProfessorPessoaEscolaPessoaFisicaPessoaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="questao_alternativa_id">questao_alternativa_id</label>
						<div class="innerLine">
							<select name=questao_alternativa_id class="key input pequeno">
								{foreach item=item from=$questao_alternativa}
									<option value="{$item.id}" {if $item.id == $usabilidade_questao->getQuestaoAlternativaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_escolha">data_escolha</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_escolha" name="data_escolha" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$usabilidade_questao->getDataEscolha()}" />
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
