{*
 * AvaliacaoAluno => View de manipulação de dados da classe 'AvaliacaoAluno'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/avaliacaoaluno/AvaliacaoAluno', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>AvaliacaoAluno</h1>
				<sub>Gerencimento - AvaliacaoAluno</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$avaliacao_aluno->getId()}" />
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_matricula">aluno_pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="aluno_pessoa_escola_matricula" name="aluno_pessoa_escola_matricula" maxlength="10" value="{$avaliacao_aluno->getAlunoPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="aluno_pessoa_escola_pessoa_fisica_pessoa_id">aluno_pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<select name=aluno_pessoa_escola_pessoa_fisica_pessoa_id class="key input pequeno">
								{foreach item=item from=$aluno_pessoa_escola_pessoa_fisica_pessoa}
									<option value="{$item.id}" {if $item.id == $avaliacao_aluno->getAlunoPessoaEscolaPessoaFisicaPessoaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="avaliacao_id">avaliacao_id</label>
						<div class="innerLine">
							<select name=avaliacao_id class="key input pequeno">
								{foreach item=item from=$avaliacao}
									<option value="{$item.id}" {if $item.id == $avaliacao_aluno->getAvaliacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_inicio">data_inicio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_inicio" name="data_inicio" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$avaliacao_aluno->getDataInicio()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hora_inicio">hora_inicio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hora_inicio" name="hora_inicio" onkeypress="mascara(this,hora)" maxlength="5" value="{$avaliacao_aluno->getHoraInicio()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="hora_fim">hora_fim</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="hora_fim" name="hora_fim" onkeypress="mascara(this,hora)" maxlength="5" value="{$avaliacao_aluno->getHoraFim()}" />
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
