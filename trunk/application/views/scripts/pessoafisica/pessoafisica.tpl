{*
 * PessoaFisica => View de manipulação de dados da classe 'PessoaFisica'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoafisica/PessoaFisica', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>PessoaFisica</h1>
				<sub>Gerencimento - PessoaFisica</sub>
				<div class="content">
					<div class="line">
						<label class="label required" for="pessoa_id">pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_id" name="pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$pessoa_fisica->getPessoaId()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="cpf">cpf</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="cpf" name="cpf" onkeypress="mascara(this,cpf)" maxlength="11" value="{$pessoa_fisica->getCpf()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_nascimento">data_nascimento</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_nascimento" name="data_nascimento" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$pessoa_fisica->getDataNascimento()}" />
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
