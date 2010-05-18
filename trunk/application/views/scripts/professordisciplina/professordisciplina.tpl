{*
 * ProfessorDisciplina => View de manipulação de dados da classe 'ProfessorDisciplina'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/professordisciplina/ProfessorDisciplina', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>ProfessorDisciplina</h1>
				<sub>Gerencimento - ProfessorDisciplina</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$professor_disciplina->getId()}" />
					<div class="line">
						<label class="label required" for="disciplina_id">disciplina_id</label>
						<div class="innerLine">
							<select name=disciplina_id class="key input pequeno">
								{foreach item=item from=$disciplina}
									<option value="{$item.id}" {if $item.id == $professor_disciplina->getDisciplinaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="professor_pessoa_escola_matricula">professor_pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="professor_pessoa_escola_matricula" name="professor_pessoa_escola_matricula" maxlength="10" value="{$professor_disciplina->getProfessorPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="professor_pessoa_escola_pessoa_fisica_pessoa_id">professor_pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<select name=professor_pessoa_escola_pessoa_fisica_pessoa_id class="key input pequeno">
								{foreach item=item from=$professor_pessoa_escola_pessoa_fisica_pessoa}
									<option value="{$item.id}" {if $item.id == $professor_disciplina->getProfessorPessoaEscolaPessoaFisicaPessoaId()}selected="selected"{/if}>{$item.nome}</option>
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
