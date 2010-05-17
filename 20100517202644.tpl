{*
 * Aluno => View de manipulação de dados da classe 'Aluno'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/aluno/Aluno', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Aluno</h1>
				<sub>Gerencimento - Aluno</sub>
				<div class="content">
					<div class="line">
						<label class="label required" for="pessoa_escola_pessoa_fisica_pessoa_id">pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_pessoa_fisica_pessoa_id" name="pessoa_escola_pessoa_fisica_pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$aluno->getPessoaEscolaPessoaFisicaPessoaId()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="pessoa_escola_matricula">pessoa_escola_matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_matricula" name="pessoa_escola_matricula" maxlength="10" value="{$aluno->getPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="area_interece">area_interece</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="area_interece" name="area_interece" maxlength="250" value="{$aluno->getAreaInterece()}" />
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
