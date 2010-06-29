{*
 * AvaliacaoSituacao => View de manipulação de dados da classe 'AvaliacaoSituacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/avaliacaosituacao/AvaliacaoSituacao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>AvaliacaoSituacao</h1>
				<sub>Gerencimento - AvaliacaoSituacao</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$avaliacao_situacao->getId()}" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="nome" name="nome" maxlength="100" value="{$avaliacao_situacao->getNome()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" {if $avaliacao_situacao->getStatus()}checked="checked"{/if} />
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
