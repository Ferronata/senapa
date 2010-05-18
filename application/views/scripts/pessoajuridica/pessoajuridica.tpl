{*
 * PessoaJuridica => View de manipulação de dados da classe 'PessoaJuridica'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoajuridica/PessoaJuridica', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>PessoaJuridica</h1>
				<sub>Gerencimento - PessoaJuridica</sub>
				<div class="content">
					<div class="line">
						<label class="label required" for="pessoa_id">pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_id" name="pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$pessoa_juridica->getPessoaId()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="cnpj">cnpj</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="cnpj" name="cnpj" onkeypress="mascara(this,cnpj)" maxlength="20" value="{$pessoa_juridica->getCnpj()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="nome_fantasia">nome_fantasia</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="nome_fantasia" name="nome_fantasia" maxlength="250" value="{$pessoa_juridica->getNomeFantasia()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="inscricao_estadual">inscricao_estadual</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="inscricao_estadual" name="inscricao_estadual" maxlength="100" value="{$pessoa_juridica->getInscricaoEstadual()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="inscricao_municipal">inscricao_municipal</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="inscricao_municipal" name="inscricao_municipal" maxlength="100" value="{$pessoa_juridica->getInscricaoMunicipal()}" />
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
