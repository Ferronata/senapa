{*
 * PessoaJuridica => View de manipula��o de dados da classe 'PessoaJuridica'
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<!-- --><form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/pessoajuridica/PessoaJuridica', 'form', 'save');" onsubmit="return(runAction(this))"> <!-- -->
				<h1>Institui��o</h1>
				<sub>Gerencimento - Institui��o</sub>
				
				<div id="abas" class="divAba">{html_aba value='Dados Gerais' forid='aba1' classe=selected}{html_aba value='Institui��o' forid='aba2'}</div>
				
				<div id="aba1">{include file="pessoajuridica/pessoa.tpl"}</div>
				
				<div id="aba2" class="content" style="display: none;">
					<input type="hidden" id="pessoa_id" name="pessoa_id" value="{$pessoa_juridica->getPessoaId()}" />
					<div class="line">
						<label class="label required" for="cnpj">CNPJ</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="cnpj" name="cnpj" onkeypress="mascara(this,cnpj_mask)" maxlength="18" value="{$pessoa_juridica->getCnpj()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="nome_fantasia">Nome Fantasia</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="nome_fantasia" name="nome_fantasia" maxlength="250" value="{$pessoa_juridica->getNomeFantasia()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="inscricao_estadual">Inscric�o Estadual</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="inscricao_estadual" name="inscricao_estadual" maxlength="100" value="{$pessoa_juridica->getInscricaoEstadual()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="inscricao_municipal">Inscric�o Municipal</label>
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
