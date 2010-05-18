{*
 * PessoaEscola => View de manipulação de dados da classe 'PessoaEscola'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoaescola/PessoaEscola', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>PessoaEscola</h1>
				<sub>Gerencimento - PessoaEscola</sub>
				<div class="content">
					<div class="line">
						<label class="label required" for="matricula">matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="matricula" name="matricula" maxlength="10" value="{$pessoa_escola->getMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="pessoa_fisica_pessoa_id">pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_fisica_pessoa_id" name="pessoa_fisica_pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$pessoa_escola->getPessoaFisicaPessoaId()}" />
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
