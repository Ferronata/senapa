{*
 * PessoaEscolaDisciplina => View de manipulação de dados da classe 'PessoaEscolaDisciplina'
 * Data de Cricação - 23/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoaescoladisciplina/PessoaEscolaDisciplina', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>PessoaEscolaDisciplina</h1>
				<sub>Gerencimento - PessoaEscolaDisciplina</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$pessoa_escola_disciplina->getId()}" />
					<div class="line">
						<label class="label required" for="pessoa_escola_pessoa_fisica_pessoa_id">pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_pessoa_fisica_pessoa_id" name="pessoa_escola_pessoa_fisica_pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$pessoa_escola_disciplina->getPessoaEscolaPessoaFisicaPessoaId()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="pessoa_escola_matricula">pessoa_escola_matricula</label>
						<div class="innerLine">
							<select name=pessoa_escola_matricula class="key input pequeno">
								{foreach item=item from=$pessoa_escola_matric}
									<option value="{$item.id}" {if $item.id == $pessoa_escola_disciplina->getPessoaEscolaMatricula()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="disciplina_id">disciplina_id</label>
						<div class="innerLine">
							<select name=disciplina_id class="key input pequeno">
								{foreach item=item from=$disciplina}
									<option value="{$item.id}" {if $item.id == $pessoa_escola_disciplina->getDisciplinaId()}selected="selected"{/if}>{$item.nome}</option>
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
