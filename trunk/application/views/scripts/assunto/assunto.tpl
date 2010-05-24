{*
 * Assunto => View de manipulação de dados da classe 'Assunto'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/assunto/Assunto', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Assunto</h1>
				<sub>Gerencimento - Assunto</sub>
				
				<div id="abas" class="divAba">{html_aba value='Dados Gerais' forid='aba1' classe=selected}{html_aba value='Disciplinas' forid='aba2'}</div>
				
				<div id="aba1" class="content">
					<input type="hidden" id="id" name="id" value="{$object->getId()}" />
					<div class="line">
						<label class="label required" for="nome">Assunto</label>
						<div class="innerLine">
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="200" value="{$object->getNome()}" />
						</div>
					</div>
				</div>
				
				<div id="aba2" style="display: none;">{include file="disciplina/disciplina_pessoa_fisica.tpl"}</div>
				
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>
