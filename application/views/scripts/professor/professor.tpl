{*
 * Professor => View de manipulação de dados da classe 'Professor'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/professor/Professor', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Professor</h1>
				<sub>Gerencimento - Professor</sub>
				
				<div id="abas" class="divAba">{html_aba value='Dados Gerais' forid='aba1' classe=selected}{html_aba value='Dados Pessoais' forid='aba2'}{html_aba value='Professor' forid='aba3'}</div>
				
				<div id="aba1">{include file="professor/pessoa.tpl"}</div>
				
				<div id="aba2" style="display: none;">{include file="professor/pessoafisica.tpl"}</div>
				
				<div id="aba3" class="content" style="display: none;">

					<input type="hidden" id="pessoa_escola_pessoa_fisica_pessoa_id" name="pessoa_escola_pessoa_fisica_pessoa_id" value="{$professor->getPessoaEscolaPessoaFisicaPessoaId()}" />

					<div class="line">
						<label class="label required" for="pessoa_escola_matricula">matricula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_matricula" name="pessoa_escola_matricula" maxlength="10" value="{$professor->getPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="formacao">formacao</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="formacao" name="formacao" maxlength="250" value="{$professor->getFormacao()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="area_atuacao">area_atuacao</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="area_atuacao" name="area_atuacao" maxlength="250" value="{$professor->getAreaAtuacao()}" />
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
