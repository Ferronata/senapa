
	<input type="hidden" id="idAluno" name="idAluno" value="{$usuario->getId()}" />
	
	<div id="avaliacoes">
		{foreach item=item from=$avaliacoes}
		    {$item->toString()}
		{foreachelse}
			<div class="divAvaliacao">
				<div class="divTitleAvaliacao">
					<div>
						<h1 class="h1Avaliacao">Nenhuma Avaliação Disponível</h1>
					</div>
				</div>
			</div>
		{/foreach}
	</div>