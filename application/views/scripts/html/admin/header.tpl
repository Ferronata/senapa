<div class="border">
	<div id="top">
		<div id="logo">SENAPA - Sistema Especialista de Nivelamento e Auxílio ao Processo Avaliativo</div>
		<div id="topRight">
			<div id="topTimer">
				{date type="%W, %d de %m de %Y"}
			</div>
			{if $pessoa_fisica}
			<div id="topMenu">
				<ul>
					<li class="liHome"><span><a href="?" title="Página inicial">Home</a></span></li>
					<li class="liUser"><span><a href="javascript: openPage('pessoaEscola');" title="Dados pessoais">{$pessoa_fisica->getNome()}</a></span></li>
					<li class="liExit"><span><a href="{php}print BASE_URL;{/php}/index/sair" title="Sair do sistema">Sair</a></span></li>
				</ul>
			</div>
			{/if}
		</div>
	</div>