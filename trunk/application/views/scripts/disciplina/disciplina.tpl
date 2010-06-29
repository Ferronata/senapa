{*
 * Disciplina => View de manipulação de dados da classe 'Disciplina'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/disciplina/Disciplina', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Disciplina</h1>
				<sub>Gerencimento - Disciplina</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$disciplina->getId()}" />
					<div class="line">
						<label class="label required" for="codigo">Código</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="codigo" name="codigo" maxlength="8" value="{$disciplina->getCodigo()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nome">Nome</label>
						<div class="innerLine">
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="200" value="{$disciplina->getNome()}" />
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
