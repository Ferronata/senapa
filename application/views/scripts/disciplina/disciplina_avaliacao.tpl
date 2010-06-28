{literal}
<script type="text/javascript">
function pesquisa(tag){
	var op = eval(tag.value);
	switch(op){
		case {/literal}{$object->ENUM('QUESTAO')}{literal}:
			var tmp1 = $('conteudoAvaliacao');
			var tmp2 = $('conteudoQuestao');

			tmp1.style.display = "none";
			tmp2.style.display = "block";
			
			break;
		case {/literal}{$object->ENUM('AVALIACAO')}{literal}:
			var tmp1 = $('conteudoAvaliacao');
			var tmp2 = $('conteudoQuestao');

			tmp1.style.display = "block";
			tmp2.style.display = "none";
			
			break;
	}
}
</script>
{/literal}
		<div class="content">
				<div class="line">
					<div class="innerLine">
						<div style="width: 30%; float:left; border-right: 1px solid #666666;">
							<label class="label" for="tpPesqusia">Tipo de Pesquisa</label>
							<select id="tpPesqusia" name="tpPesqusia" onchange="pesquisa(this)">
								<option value="{$object->ENUM('QUESTAO')}">Questões</option>
								<option value="{$object->ENUM('AVALIACAO')}">Avaliações</option>
							</select>
						</div>
						<div style="width: 68%; float:right;">
							<label class="label">Nível</label>
						{foreach item=item from=$niveis}
							<label><input type="checkbox" name="lista_niveis[]" {if $item->isExiste()} checked="checked" {/if} value="{$item->getNivel()}" />{$item->getNivel()}</label>
						{/foreach}
						</div>
					</div>
				</div>
				
				<div class="line">
					<label class="label required" for="Disciplina">Disciplinas</label>
					<div class="innerLine">
						<select id="Disciplina" name=Disciplina class="key input medio" onchange="rerenderCheckDiscAssunto($('form'),this,$('values'))">
							<option value="">Selecione</option>
							{foreach item=item from=$disciplinas}
								<option value="{$item.id}" {if $disciplina->getId() == $item.id} selected="selected" {/if}>{$item.nome}</option>
							{/foreach}
						</select>
					</div>
				</div>
				<hr />
				<div class="divDatagridObjects">
					<table class="datagridObjects" id="values">
						<thead>
							<tr class="gridTitle">
								<td style="width: 18px;">&nbsp;</td>
								<td class="left">Assuntos</td>
							</tr>
						</thead>
						<tbody>
							{foreach item=item from=$assuntos}
							    <tr>
							    	<td style="width: 18px;"><input type="checkbox" name="lista_assuntos[]" value="{$item->getId()}" {if $item->isExiste()} checked="checked" {/if} /></td>
							    	<td class="left">{$item->getNome()}</td>
							    </tr>
							{/foreach}
						</tbody>					
					</table>
				</div>
				<hr />
				
				<div id="conteudoAvaliacao" style="display: none;">
					
				</div>
				<div id="conteudoQuestao" style="display: block;">
					<div class="line">
						<div class="innerLine">
							<input type="button" value="Buscar" onclick="findQuestions($('form'),$('questoes'))" />
						</div>
					</div>
					
					<p />
					<p />
					
					<div class="divDatagridObjectsCadastro">
						<table class="datagridObjects" id="listaQuestoesCadastro">
							<thead>
								<tr class="gridTitle">
									<td style="width: 18px;">&nbsp;</td>
									<td class="left">Questões Cadastradas</td>
								</tr>
							</thead>
							<tbody>
								{foreach item=item from=$listaQuestao->getListaQuestao()}
									{assign var=str value=$item->toString()}
								    <tr>
								    	<td style="width: 18px;"><input type="checkbox" name="lista_questoes[]" value="{$item->getId()}" checked="checked" /></td>
								    	<td class="left"><span><a href="javascript: viewQuestion($('mQuestions{$item->getId()}'))" title="Expandir">{$item->getResumo(150)}</a></span><span id="mQuestions{$item->getId()}" style="display:none">{$str}</span></td>
								    </tr>
								{/foreach}
							</tbody>
						</table>
					</div>
					
					<hr />
					{* {popup sticky=false closetext="X" caption="Detalhes" text="Assuntos" padx=5 padx=5} *}
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="listaQuestoes">
							<thead>
								<tr class="gridTitle">
									<td style="width: 18px;">&nbsp;</td>
									<td style="width: 18px;">&nbsp;</td>
									<td class="left">Questões Disponíveis</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
		</div>