{*
 * Papel => View de manipulação de dados da classe 'Papel'
 * Data de Cricação - 20/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/papel/Papel', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Papel</h1>
				<sub>Gerencimento - Papel</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$papel->getId()}" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="nome" name="nome" maxlength="100" value="{$papel->getNome()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status_2">status_2</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status_2" name="status_2"  value="1" {if $papel->getStatus2()}checked="checked"{/if} />
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
