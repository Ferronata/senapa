{*
 * DisciplinaAssunto => View de manipulação de dados da classe 'DisciplinaAssunto'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/disciplinaassunto/DisciplinaAssunto', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>DisciplinaAssunto</h1>
				<sub>Gerencimento - DisciplinaAssunto</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$disciplina_assunto->getId()}" />
					<div class="line">
						<label class="label required" for="disciplina_id">disciplina_id</label>
						<div class="innerLine">
							<select name=disciplina_id class="key input pequeno">
								{foreach item=item from=$disciplina}
									<option value="{$item.id}" {if $item.id == $disciplina_assunto->getDisciplinaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="assunto_id">assunto_id</label>
						<div class="innerLine">
							<select name=assunto_id class="key input pequeno">
								{foreach item=item from=$assunto}
									<option value="{$item.id}" {if $item.id == $disciplina_assunto->getAssuntoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_atribuicao">data_atribuicao</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_atribuicao" name="data_atribuicao" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$disciplina_assunto->getDataAtribuicao()}" />
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
