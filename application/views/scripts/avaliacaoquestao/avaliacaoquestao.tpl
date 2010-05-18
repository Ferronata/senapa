{*
 * AvaliacaoQuestao => View de manipulação de dados da classe 'AvaliacaoQuestao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/avaliacaoquestao/AvaliacaoQuestao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>AvaliacaoQuestao</h1>
				<sub>Gerencimento - AvaliacaoQuestao</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$avaliacao_questao->getId()}" />
					<div class="line">
						<label class="label required" for="questao_id">questao_id</label>
						<div class="innerLine">
							<select name=questao_id class="key input pequeno">
								{foreach item=item from=$questao}
									<option value="{$item.id}" {if $item.id == $avaliacao_questao->getQuestaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="avaliacao_id">avaliacao_id</label>
						<div class="innerLine">
							<select name=avaliacao_id class="key input pequeno">
								{foreach item=item from=$avaliacao}
									<option value="{$item.id}" {if $item.id == $avaliacao_questao->getAvaliacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
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
