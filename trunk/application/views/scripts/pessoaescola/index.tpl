{*
 * PessoaEscola => View de manipulação de dados do usuário
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
		<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoaEscola', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Usuário</h1>
				<sub>Gerencimento - Usuário</sub>
				
				<div id="abas" class="divAba">{html_aba value='Dados Gerais' forid='aba1' classe=selected}{html_aba value='Dados Pessoais' forid='aba2'}{html_aba value='Administração' forid='aba3'}{if $object->getPapelId() != $object->ENUM('P_S_ADMIN') && $object->getPapelId() != $object->ENUM('P_ADMIN')}{html_aba value='Disciplinas' forid='aba4'}{/if}</div>
				
				<div id="aba1">{include file="pessoa/pessoaOff.tpl"}</div>
				
				<div id="aba2" style="display: none;">{include file="pessoafisica/pessoafisicaOff.tpl"}</div>
				
				<div id="aba3" class="content" style="display: none;">
					{include file="pessoaescola/pessoaescolaOff.tpl"}
				</div>
				
				{if $object->getPapelId() != $object->ENUM('P_S_ADMIN') && $object->getPapelId() != $object->ENUM('P_ADMIN')}
					<div id="aba4" style="display: none;">{include file="disciplina/disciplina_pessoa_fisicaOff.tpl"}</div>
				{/if}
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
				</div>
			</form>
		</div>
	</div>
</center>