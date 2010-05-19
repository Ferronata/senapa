{*
 * PessoaJuridica => View de manipulação de dados da classe 'PessoaJuridica'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<!-- --><form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoajuridica/PessoaJuridica', 'form', 'save');" onsubmit="return(runAction(this))"> <!-- -->
			<!-- <form id="form" name="form" method="post" action="/senapa/pessoajuridica/PessoaJuridica" onsubmit="return(runAction(this))">-->
				<h1>Instituição</h1>
				<sub>Gerencimento - Instituição</sub>
				
				<div id="abas" class="divAba">{html_aba value='Dados Gerais' forid='aba1' classe=selected}{html_aba value='Instituição' forid='aba2'}</div>
				
				<div id="aba1">{include file="pessoajuridica/pessoa.tpl"}</div>
				
				<div id="aba2" class="content" style="display: none;">
					<input type="hidden" id="pessoa_id" name="pessoa_id" value="{$pessoa_juridica->getPessoaId()}" />
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
