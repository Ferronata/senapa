{*
 * FinalizarAvaliacao => View de manipulação de dados da classe 'FinalizarAvaliacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
 
{assign var=questoes value=$avaliacao->getListaQuestoes()}

{capture name=controller}
	<input type="submit" class="button save" {if $usuario->getPapelId() != $usuario->ENUM('P_PROFESSOR')} disabled="disabled" {/if} value="Finalizar" />
{/capture}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="">				
				<div id="aba1" class="content">
					<h1 style="border:none; margin: 0; padding: 0; background: none;">Nivelamento - {$avaliacao->getNome()}</h1>
				
					<div>
						<div class="line">
							<label class="label">Disciplina</label>
							<div class="innerLine">
								{assign var=disciplina value=$avaliacao->getDisciplina()}
								{$disciplina->getNome()}
							</div>
						</div>
						<div class="line">
							<label class="label">Avaliação</label>
							<div class="innerLine">
								{$avaliacao->getNome()}
							</div>
						</div>
						<div class="line">
							<label class="label">Disponibilização</label>
							<table class="datagridObjects" id="values">
								<thead>
									<tr class="gridTitle">
										<td style="width: 40px">Registro</td>
										<td class="left">Data</td>
										<td class="left">Horário</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Início</td>
										<td>{html_data values=$avaliacao->getDataInicio()}</td>
										<td>{$avaliacao->getHoraIniccio()}</td>
									</tr>
									<tr>
										<td>Fim</td>
										<td>{html_data values=$avaliacao->getDataFim()}</td>
										<td>{$avaliacao->getHoraFim()}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="line">
							<label class="label">Tempo de Resolução</label>
							<div class="innerLine">
								<table class="datagridObjects" id="values">
									<thead>
										<tr class="gridTitle">
											<td style="text-align: left; padding: 0 2px; width: 80px">Dados</td>
											<td class="left">Média Aritimética (&mu;)</td>
											<td class="left">Desvio Padrao (&sigma;)</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="left">Tempo</td>
											<td class="left">{$avaliacao->getMediaAritimetica()}</td>
											<td class="left">{$avaliacao->getDesvioPadraoResoluao()}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<p />
						<hr />
						<div class="line">
							<div class="innerLine">
								<table class="datagridObjects" id="nivelAvaliacao">
									<thead>
										<tr class="gridTitle">
											<td style="text-align: left; padding: 0 2px; width: 260px">Avaliação</td>
											<td style="padding: 0 2px; width: 40px">Nível Atual</td>
											<td class="left">Nivelamento Gerado Pelo Sistema</td>
										</tr>
									</thead>
									<tbody>
										{assign var=avaliacaoNivel value=$avaliacao->getNivel()}
										<tr>
											<td class="left">{$avaliacao->getNome()}</td>
											<td>{$avaliacaoNivel->getNivel()}</td>
											<td class="left"><input type="text" class="left input pequeno" />{if $avaliacaoNivel->getNivel() == $system.nivel}<span class="ok_16"></span>{/if}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<p />
						<div class="line">
							<div class="innerLine" class="questions">
								<table class="datagridObjects" id="nivelAvaliacao">
									<thead>
										<tr class="gridTitle">
											<td style="text-align: left; padding: 0 2px; width: 260px">Questão</td>
											<td style="padding: 0 2px; width: 40px">Nível Atual</td>
											<td class="left">Nivelamento Gerado Pelo Sistema</td>
										</tr>
									</thead>
									<tbody>
										{foreach item=item from=$questoes->getListaQuestao()}
											{assign var=questaoNivel value=$item->getNivelQuestao()}
										    <tr>
												<td class="left"><a href="javascript: viewQuestion($('question{$item->getId()}'))" title="Expandir">{$item->getResumo()}</a></td>
												<td>{$questaoNivel->getNivel()}</td>
												<td class="left"><input type="text" class="left input pequeno" /><span class="ok_16"></span></td>
											</tr>
											<tr>
												<td class="left" colspan="3">
													<div id="question{$item->getId()}" style="display: none;">
														{$item->toSimpleString()}
													</div>
												</td>
											</tr>
										{/foreach}
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<p />
					<div>
						{$smarty.capture.controller}
					</div>
				</div>
			</form>
		</div>
	</div>
</center>