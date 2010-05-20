<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>SENAPA</title>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" href="{php}print BASE_URL;{/php}/public/images/favicon.ico">

<link rel="stylesheet" type="text/css" href="{php}print BASE_URL;{/php}/public/js/lib/jqModal/css/default.css" />
<link rel="stylesheet" type="text/css" href="{php}print BASE_URL;{/php}/public/css/admin/default.css" />
<link rel="stylesheet" type="text/css" href="{php}print BASE_URL;{/php}/public/css/admin/menu.css" />

<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/lib/overlib-4.2.1/overlib.js" charset="ISO-8859-1"></script>
<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/lib/prototype-1.6.0.3.js" charset="ISO-8859-1"></script>
<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/lib/jquery-1.3.2.min.js" charset="ISO-8859-1"></script>
<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/lib/jqModal/jqModal.js" charset="ISO-8859-1"></script>

<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/admin/Objeto.js" charset="ISO-8859-1"></script>
<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/admin/default.js" charset="ISO-8859-1"></script>

</head>
<html>
<div class="jqmAlert" id="alert" style="display:none;">
	<div class="jqmAlertWindow">
		<div class="jqmAlertTitle clearfix">
			<a href="#" class="jqmClose"><em>Fechar</em></a>
			<h1>Alerta</h1>
		</div>
		<div class="jqmAlertContent"></div>
		<div class="jqmInputBt">
			<input type="submit" value="Ok" />
		</div>
	</div>
</div>
<div class="jqmMessage" id="message" style="display:none;">
	<div class="jqmMessageWindow">
		<div class="jqmMessageTitle clearfix">
			<a href="#" class="jqmClose"><em>Fechar</em></a>
			<h1>Mensagem</h1>
		</div>
		<div class="jqmMessageContent"></div>
		<div class="jqmInputBt">
			<input type="submit" value="Ok" />
		</div>
	</div>
</div>
<div class="jqmError" id="error" style="display:none;">
	<div class="jqmErrorWindow">
		<div class="jqmErrorTitle clearfix">
			<a href="#" class="jqmClose"><em>Fechar</em></a>
			<h1>Erro</h1>
		</div>
		<div class="jqmErrorContent"></div>
		<input type="submit" value="Ok" />
	</div>
</div>
<div class="jqmConfirm" id="confirm" style="display:none;">
	<div class="jqmConfirmWindow">
		<div class="jqmConfirmTitle clearfix">
			<a href="#" class="jqmClose"><em>Fechar</em></a>
			<h1>Confirmação</h1>
		</div>
		<div class="jqmConfirmContent">
			<p class="jqmConfirmMsg"></p>
		</div>
		<input type="submit" value="Não" />
		<input type="submit" value="Sim" />
	</div>
</div>
<div style="display: none;">
	<img src="{php}print BASE_URL;{/php}/public/images/loader.gif" />
	<img src="{php}print BASE_URL;{/php}/public/images/mini-loader.gif" />
</div>