{*
 * AvaliacaoSituacao => View de manipulação de dados da classe 'AvaliacaoSituacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/avaliacaosituacao/AvaliacaoSituacao', 'form', 'save');" onsubmit="return(runAction(this))">
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
					<div class="line">
						<label class="label required" for="date_create">date_create</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="date_create" name="date_create" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$avaliacao_situacao->getDateCreate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_update">date_update</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_update" name="date_update" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$avaliacao_situacao->getDateUpdate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_delete">date_delete</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_delete" name="date_delete" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$avaliacao_situacao->getDateDelete()}" />
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
