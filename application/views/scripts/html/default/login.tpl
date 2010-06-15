{include file='html/admin/header.tpl'}
<div id="middle">
	<center>
		<div id="divLogin">
			<div id="top" style="height: 40px;">
				<span style="font-size: 16px; font-weight: 900; color: #666666; margin: 10px 4px; float: left;">.: LOGIN :.</span>
			</div>
			<form id="form" name="form" method="post" action="{php}print BASE_URL;{/php}/">
				<input id="action" name="action" type="hidden" value="login" />
				<div style="height: 210px;">
					<div style="margin: 30px 30px">
						<div style="display: block; height: 60px;">
							<span class="usuario">Usuário</span>
							<input id="senapaUser" name="senapaUser" class="loginInput" type="text" value="" />
						</div>
						<div style="display: block; height: 60px;">
							<span class="senha">Senha</span>
							<input id="senapaPassword" name="senapaPassword" class="loginInput" type="password" value="" />
						</div>
						{if $msg}
						<div style="margin:0;padding:0; color:red; font-weight: 900; text-align: center; width: 100%; height: 15px">
							{$msg}
						</div>
						{/if}
					</div>
					<hr />
					<div>
						<input type="submit" value="Acessar">
					</div>
				</div>
			</form>			
			<div id="bottom" style="height: 20px;">
				
			</div>
		</div>
	</center>
</div>
{include file='html/admin/footer.tpl'}