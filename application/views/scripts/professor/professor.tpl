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
				<sub>Gerenciamento - Professor</sub>
				
				<div id="abas" class="divAba">{html_aba value='Dados Gerais' forid='aba1' classe=selected}{html_aba value='Dados Pessoais' forid='aba2'}{html_aba value='Professor' forid='aba3'}{html_aba value='Disciplinas' forid='aba4'}</div>
				
				<div id="aba1">{include file="pessoa/pessoa.tpl"}</div>
				
				<div id="aba2" style="display: none;">{include file="pessoafisica/pessoafisica.tpl"}</div>
				
				<div id="aba3" class="content" style="display: none;">

					{include file="pessoaescola/pessoaescola.tpl"}
					
					<div class="line">
						<label class="label required" for="formacao">Formação</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="formacao" name="formacao" maxlength="250" value="{$object->getFormacao()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="area_atuacao">Área de Atuação</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="area_atuacao" name="area_atuacao" maxlength="250" value="{$object->getAreaAtuacao()}" />
						</div>
					</div>
				</div>
				
				<div id="aba4" style="display: none;">{include file="disciplina/disciplina_pessoa_fisica.tpl"}</div>
				
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>
