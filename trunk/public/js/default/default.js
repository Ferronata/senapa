var $jq = jQuery.noConflict();
var project_root = '/senapa';
/*
 * RESIZE TELA
 */
 
window.onload = function(){
	//voltarForm();
}
function tela(){
	var width 	= document.body.clientWidth;
	var height = screen.availHeight;
	
	var tag 	= document.getElementById("work");
	var menu 	= document.getElementById("menu");
	if(tag != null && menu != null){		
		var vl = (width-menu.clientWidth-90)+"px";
		tag.style.width = vl;
	}
	var middle 	= document.getElementById("middle");

	if(middle != null){
			
		var vl = (height-230)+"px";
		middle.style.height = vl;
		tag.style.height = vl;
		menu.style.height = vl;
	}
}

//window.onresize = function(){tela();}
//window.onload = function(){tela();}

/*
 * DOM
 */
var BASE_URL = location.pathname;

function gerarCookie(strCookie, strValor, lngDias)
{
    var dtmData = new Date();

    if(lngDias)
    {
        dtmData.setTime(dtmData.getTime() + (lngDias * 24 * 60 * 60 * 1000));
        var strExpires = "; expires=" + dtmData.toGMTString();
    }
    else
    {
        var strExpires = "";
    }
    document.cookie = strCookie + "=" + strValor + strExpires + "; path=/";
}

// Função para ler o cookie.
function lerCookie(strCookie)
{
    var strNomeIgual = strCookie + "=";
    var arrCookies = document.cookie.split(';');

    for(var i = 0; i < arrCookies.length; i++)
    {
        var strValorCookie = arrCookies[i];
        while(strValorCookie.charAt(0) == ' ')
        {
            strValorCookie = strValorCookie.substring(1, strValorCookie.length);
        }
        if(strValorCookie.indexOf(strNomeIgual) == 0)
        {
            return strValorCookie.substring(strNomeIgual.length, strValorCookie.length);
        }
    }
    return null;
}

// Função para excluir o cookie desejado.
function excluirCookie(strCookie)
{
    gerarCookie(strCookie, '', -1);
}

function goodBrowser(){
	var versao = navigator.appVersion;
	var pos = versao.indexOf("MSIE");

	if(pos>=0){		
		var tmp = versao.substring(pos);
		tmp = tmp.replace("MSIE","");
		tmp = tmp.substring(0,tmp.indexOf(";"));
		tmp = parseInt(this.trim(tmp));
		if(tmp<7)
			return false;
	}
	return true;
}

function transparent(div,opacity){
	try{
		div.style.filter 		= "alpha(opacity="+opacity+")";
		div.style.opacity 		= ""+(opacity/100);
		div.style.MosOpacity	= ""+(opacity/100);
		div.style.KhtmlOpacity	= ""+(opacity/100);
	}catch(Exception){}
}

function addLoadding(){
	var tmp = $('blackout');
	if(!tmp){
		var div = this.addTagId('blackout');
		if(!this.goodBrowser())
			div.style.position= 'absolute';
		else
			div.style.position	= 'fixed';
		div.style.top			= '0px';
		div.style.left			= '0px';
		div.style.width			= '100%';
		div.style.height		= '100%';
		div.style.color			= '#FFFFFF';
		div.style.zIndex		= '1000';
		div.style.background	= '#000000';
		this.transparent(div,"65");
	}
	/**/
	var inner = this.addDivId ('loadding','blackout','<img src=\''+project_root+'/public/images/loader.gif\' />');
	//var inner = this.addDivId ('loadding','blackout');
	if(!this.goodBrowser())
		inner.style.position= 'absolute';
	else
		inner.style.position= 'fixed';
	inner.style.top			= '44%';
	inner.style.left		= '44%';
	inner.style.width		= '100px';
	inner.style.height		= '20px';
	inner.style.color		= '#FFFFFF';
	inner.style.fontWeight	= '900';
	inner.style.zIndex		= '1100';
	/**/
}

function addBlackout(){
	var tmp = $('blackout');
	if(!tmp){
		var div = this.addTagId('blackout');
		if(!this.goodBrowser())
			div.style.position= 'absolute';
		else
			div.style.position	= 'fixed';
		div.style.top			= '0px';
		div.style.left			= '0px';
		div.style.width			= '100%';
		div.style.height		= '100%';
		div.style.color			= '#FFFFFF';
		div.style.zIndex		= '1000';
		div.style.background	= '#000000';
		
		this.transparent(div,"65");
		
		var inner = this.addDivId ('loadding','blackout','');
		if(!this.goodBrowser())
			inner.style.position= 'absolute';
		else
			inner.style.position= 'fixed';
		inner.style.top			= '10%';
		inner.style.left		= '10%';
		inner.style.width		= '800px';
		inner.style.height		= '60px';
		inner.style.color		= '#FFFFFF';
		inner.style.fontWeight	= '900';
		inner.style.zIndex		= '1010';
	}
}

function removeLoadding(){
	this.removeTagId('loadding');
	this.removeTagId('blackout');
}

function addTagId(id,str){
	var tag = document.getElementsByTagName("body")[0];
	if(tag!=null){
		var div = document.createElement("div");
		div.setAttribute('id',id);
	
		var corpo = "";
		if(str!=null)
			corpo = str;
			
		removeTagId(id);
		div.innerHTML = corpo;
		tag.appendChild(div);
		
		return div;
	}
	return null;
}
function removeTagId(id){
	var div = document.getElementById(id);	
	if (div != null)
		div.parentNode.removeChild(div);

	return true;
}
function addDivId (id,localTag,str,classe){
	var div = document.createElement("div");
	div.setAttribute('id',id);
	if(classe != null)
		div.setAttribute("class", classe);

	var corpo = "";
	if(str!=null)
		corpo = str;
		
	removeTagId(id);
	div.innerHTML = corpo;
	
	if(localTag!=null){
		tag = document.getElementById(localTag);
		tag.appendChild(div);
	}
	return div;
}

/*
 * FUNCOES DE AJAX
 */
 
 
function loadPage(id,url,vars){
	params = "";
	if(vars != null)
		params = vars;
	
	new Ajax.Updater(
		id, 
		url, 
		 {
			 evalScripts:true,
			 metod: 'POST',
			 parameters: params,
			 onCreate: function(response) 
			 {
				response.transport.overrideMimeType("text/html; charset=iso-8859-1");
			 },
			 insertion: Insertion.Bottom
		 }
		 
	);
}

function trim(str){
	return str.replace(/^\s+|\s+$/g,"");
}
function is_array(input){
    return typeof(input)=='object'&&(input instanceof Array);
}

function requiredInput(id,tagName){
	var flag 	= false;
	var bg 		= "#FFE1E1";
	var bg_atual= "#FFFFFF";
	
	var radio_str = false;
	var radio_aux = "";
	
	for(var i = 0; tagName && i<tagName.length; i++){
		var keys = document.getElementsByTagName(tagName[i]);
			
		for (j=0; keys && j<keys.length; j++) {
			var pos = keys[j].className.indexOf("key");
			var str = this.trim(keys[j].value);
			
			
			if(pos>=0){				
				if(keys[j].type == 'radio'){
					if(radio_aux == "")
						radio_aux = keys[j].name;
					if(keys[j].name != radio_aux){
						radio_aux = keys[j].name;
						if(!radio_str)
							flag = true;
						radio_str = false;
					}else{
						if(keys[j].checked)
							radio_str = keys[j].checked;
					}					
				}else{
					if(str == "" && (keys[j].parentNode.parentNode.style.display != "none")){
						flag = true;
						keys[j].style.background = bg;
					}else
						keys[j].style.background = bg_atual;
				}
			}
		}
	}
	if(flag){
		error('<span><font color="red">*</font> Campos obrigatórios.</span>');
		return false;
		/*
		var str = '<div class="msg" style="background:'+bg+';"><span><font color="red">*</font> Campos obrigatórios.</span></div>';
		
		try{
			this.removeTagId('campoKey');
			this.addDivId ('campoKey',id,str);
		}catch(err){}
		finally{
			return false;
		}
		*/
	}
	return true;
}
function runAction(form){	
	if(!this.valida_CPF('cpf') || !this.valida_cnpj('cnpj') || !this.valida_email('email') || !this.requiredInput('mensagem',['input','textarea']))
		return false;
	form.submit();
}

/*
 * FUNCOES DE MASCARAS
 */
var v_obj = "";
var v_fun = "";
function mascara(o,f){
    v_obj=o;
    v_fun=f;
    setTimeout("execmascara()",1);
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value);
}

function leech(v){
    v=v.replace(/o/gi,"0");
    v=v.replace(/i/gi,"1");
    v=v.replace(/z/gi,"2");
    v=v.replace(/e/gi,"3");
    v=v.replace(/a/gi,"4");
    v=v.replace(/s/gi,"5");
    v=v.replace(/t/gi,"7");
    return v;
}

function soNumeros(v){
	v = v.replace(/\D/g,"");
    return v;
}

function mascara_telefone(v){
    v=v.replace(/\D/g,"");                //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function telefone(v){
    v=v.replace(/\D/g,"");                //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function telefone2(v){
    v=v.replace(/\D/g,"");                //Remove tudo o que não é dígito
    v=v.replace(/(\d{4})(\d)/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}

function cpf_mask(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/(\d{3})(\d)/,"$1.$2");
    v=v.replace(/(\d{3})(\d)/,"$1.$2");
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
    return v;
}

function cep_mask(v){
	v = v.replace(/\D/g,"");
    v=v.replace(/^(\d{5})(\d)/,"$1-$2");
    return v;
}

function cnpj_mask(v){
    v=v.replace(/\D/g,"");                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2");             //Coloca ponto entre o segundo e o terceiro dígitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3"); //Coloca ponto entre o quinto e o sexto dígitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2");           //Coloca uma barra entre o oitavo e o nono dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2");              //Coloca um hífen depois do bloco de quatro dígitos
    return v;
}

function romanos(v){
    v=v.toUpperCase();             //Maiúsculas
    v=v.replace(/[^IVXLCDM]/g,""); //Remove tudo o que não for I, V, X, L, C, D ou M

    while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
        v=v.replace(/.$/,"");
    return v;
}

function site(v){
	v=v.replace(/^http:\/\/?/,"");
    dominio=v;
    caminho="";
    if(v.indexOf("/")>-1)
        dominio=v.split("/")[0];
        caminho=v.replace(/[^\/]*/,"");
        dominio=dominio.replace(/[^\w\.\+-:@]/g,"");
        caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"");
        caminho=caminho.replace(/([\?&])=/,"$1");
    if(caminho!="")
    	dominio=dominio.replace(/\.+$/,"");
    v="http://"+dominio+caminho;
    return v;
}

/*Função que padroniza dataHora*/
function dataHora(v){
    v=v.replace(/\D/g,""); 
    v=v.replace(/(\d{2})(\d)/,"$1/$2"); 
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{4})(\d)/,"$1 $2:");
    v=v.replace(/(\d{2})$(\d)$/,"$1:$2");
    return v;
}

/*Função que padroniza DATA*/
function data(v){
    v=v.replace(/\D/g,""); 
    v=v.replace(/(\d{2})(\d)/,"$1/$2"); 
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    
    return v;
}

/*Função que padroniza HORA*/
function hora(v){
    v=v.replace(/\D/g,""); 
    v=v.replace(/(\d{2})(\d)/,"$1:$2");
    return v;
}

/*Função que padroniza valor monétario*/
function monetario(v){
    v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
    v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
    v=v.replace(/(\d)(\d{2})$/,"$1.$2"); //Coloca ponto antes dos 2 últimos digitos
    return v;
}

/*Função que padroniza double*/
function double(v){
    v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
    v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
    v=v.replace(/(\d)(\d{2})$/,"$1.$2"); //Coloca ponto antes dos 2 últimos digitos
    return v;
}

/**
 * VALIDA CPF
 */

function valida_CPF(id) {
	var tag = $(id);
	if(tag){
		var CPF = tag.value; // Recebe o valor digitado no campo
		CPF = CPF.replace(/\D/g,""); // Só números
		var msg = '<span>CPF inválido.</span>';
		if(CPF.length == 0)
			return true;
		if(CPF.length != 11 || 
				CPF == "00000000000" || 
				CPF == "11111111111" || 
				CPF == "22222222222" || 
				CPF == "33333333333" || 
				CPF == "44444444444" || 
				CPF == "55555555555" || 
				CPF == "66666666666" || 
				CPF == "77777777777" || 
				CPF == "88888888888" || 
				CPF == "99999999999"){
			alert(msg);
			tag.value = '';
			tag.focus();
			return false;
		}else{
			// Aqui começa a checagem do CPF
			var POSICAO, I, SOMA, DV, DV_INFORMADO;
			var DIGITO = new Array(10);
			DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado
			
			// Desemembra o número do CPF na array DIGITO
			for (I=0; I<=8; I++)
				DIGITO[I] = CPF.substr( I, 1);
			
			// Calcula o valor do 10º dígito da verificação
			POSICAO = 10;
			SOMA = 0;
			for (I=0; I<=8; I++) {
				SOMA = SOMA + DIGITO[I] * POSICAO;
			    POSICAO = POSICAO - 1;
			}
			DIGITO[9] = SOMA % 11;
			if (DIGITO[9] < 2)
				DIGITO[9] = 0;
			else
				DIGITO[9] = 11 - DIGITO[9];
			
			// Calcula o valor do 11º dígito da verificação
			POSICAO = 11;
			SOMA = 0;
			for (I=0; I<=9; I++) {
				SOMA = SOMA + DIGITO[I] * POSICAO;
				POSICAO = POSICAO - 1;
			}
			DIGITO[10] = SOMA % 11;
			if (DIGITO[10] < 2)
				DIGITO[10] = 0;
			else
				DIGITO[10] = 11 - DIGITO[10];
			
			// Verifica se os valores dos dígitos verificadores conferem
			DV = DIGITO[9] * 10 + DIGITO[10];
			if (DV != DV_INFORMADO) {
				alert(msg);
				tag.value = '';
				tag.focus();
				return false;
			}
		}
	}
	return true;
}

/**
 * VALIDA E-MAIL
 */
/*
var reEmail1 = /^[\w!#$%&'*+\/=?^`{|}~-]+(\.[\w!#$%&'*+\/=?^`{|}~-]+)*@(([\w-]+\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
var reEmail2 = /^[\w-]+(\.[\w-]+)*@(([\w-]{2,63}\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
var reEmail3 = /^[\w-]+(\.[\w-]+)*@(([A-Za-z\d][A-Za-z\d-]{0,61}[A-Za-z\d]\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
var reEmail = reEmail3;
*/
function valida_email(id){
	
	var exp_mail = /^[\w-]+(\.[\w-]+)*@(([A-Za-z\d][A-Za-z\d-]{0,61}[A-Za-z\d]\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
	eval("reEmail = exp_mail");
	
	var tag = $(id);
	if(tag && this.trim(tag.value)){
		var msg = '<span>E-mail inválido.</span>';
		var mail = tag.value;
		if (!reEmail.test(mail)) {
			alert(msg);
			tag.value = '';
			tag.focus();			
			return false;
		}
	}
	return true;
}

/**
 * VALIDA CNPJ
 */
function valida_cnpj(id){
	var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
	var tag	= $(id);
	var msg = '<span>CNPJ inválido.</span>';
	if(tag){
		var cnpj = tag.value;
		cnpj = cnpj.replace(/\D/g,""); // Só números
		
		digitos_iguais = 1;
		for (i = 0; i < cnpj.length - 1; i++)
			if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
		    	  digitos_iguais = 0;
		    	  break;
			}
		if (cnpj.length != 14 || digitos_iguais){
			alert(msg);
			tag.value = '';
			tag.focus();
			return false;
		}else{
			tamanho = cnpj.length - 2
			numeros = cnpj.substring(0,tamanho);
			digitos = cnpj.substring(tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--){
				soma += numeros.charAt(tamanho - i) * pos--;
	            if (pos < 2)
	            	pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(0)){
				alert(msg);
				tag.value = '';
				tag.focus();
				return false;
			}
			tamanho = tamanho + 1;
			numeros = cnpj.substring(0,tamanho);
			soma = 0;
			pos = tamanho - 7;
			for (i = tamanho; i >= 1; i--){
				soma += numeros.charAt(tamanho - i) * pos--;
				if (pos < 2)
					pos = 9;
			}
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
			if (resultado != digitos.charAt(1)){
				alert(msg);
				tag.value = '';
				tag.focus();
				return false;
			}
		}
	}
	return true;
}

function openPage(page,method_,params_){
	if(page){
		var url 	= project_root+"/"+page;
		
		this.gerarCookie('url', page, 1);
		
		var params 	= "";
		if(params_)
			params = params_;
		if(!method_)
			method_ = "POST";
		
		new Ajax.Updater(
				'work',
				url, 
				{
					evalScripts:true,
					onLoading: function(response){
						addLoadding();
					},
					onComplete: function(response){
						removeLoadding();
					},
					parameters: params,
					method: method_,
					encoding: 'ISO-8859-1',
					evalJS: true
				}
			);
	}
	try{
		window.scrollTo(0,0);
	}catch(err){}
}

function openPopup(page,name,width,height){
	var w = 550;
	var h = 600;
	if(width)
		w = width; 
	if(height)
		h = height;
	
	window.open(page,name,"location=0,toolbar=0,status=1,scrollbars=1, width="+w+"px,height="+h+"px");
}

function enviarForm(page, form_id, bt_id){
	var form	= $(form_id);
	var bt		= $(bt_id);
	if(bt){
		botao = bt_id;
		bt.disabled = true;
	}
	
	var params = form.serialize();
	//new Ajax.Request(page, {parameters: params, encoding: 'UTF-8', onComplete:enviarFormBack});
	new Ajax.Request(
			page, 
			{
				evalScripts:true,
				parameters: params, 
				metod: 'POST', 
				onLoading: function(response){
					addLoadding();
				},			
				onComplete:enviarFormBack,				
				encoding: 'ISO-8859-1'
				/*
	            onCreate: function(response) {
					response.transport.overrideMimeType("text/html;charset=ISO-8859-1");
				}
				*/
			}
		);
}
function enviarFormBack(e, a){
	this.removeLoadding();
	
	res = eval('(' + e.responseText + ')');

	if(res['msg'] == 'ok'){
		if(res['display'])
			this.addMensage('ok', res['display']);
		else
			this.addMensage('ok', 'Operação realizada com sucesso!');
	}
	else{
		if(res['display'])
			this.addMensage('err', res['display']);
		else
			this.addMensage('err', 'Não foi possivel executar a operação, por favor verifique os dados!');
	}
	if(res['url'])
		this.openPage(res['url']);
	else{
		var bt = $(botao);
		if(bt)
			bt.disabled = false;
	}
}

function enviarFormAvaliacao(page, form_id){
	var form	= $(form_id);
	
	var params = form.serialize();
	params += "&action="+page;
	new Ajax.Request(
			project_root+"/alunoavaliacao", 
			{
				evalScripts:true,
				parameters: params, 
				metod: 'POST', 
				onLoading: function(response){
					addLoadding();
				},			
				onComplete:enviarFormAvaliacaoBack,				
				encoding: 'ISO-8859-1'
			}
		);
}
function enviarFormAvaliacaoBack(e, a){
	this.removeLoadding();
	
	res = eval('(' + e.responseText + ')');

	/*
	if(res['url'])
		this.openPage(res['url']);
	*/
	alert(project_root+"/"+res['url']);
	if(res['msg'] == 'error'){
		if(res['display'])
			this.addMensage('err', res['display']);
		else
			this.addMensage('err', 'Não foi possivel executar a operação, por favor verifique os dados!');
	}
	if(res['url'])
		location.href = project_root+"/"+res['url'];
}

function enviarFeedbackAvaliacaoAlunoForm(page, form_id){
	var form	= $(form_id);
	
	var params = form.serialize();
	new Ajax.Request(
			project_root+"/FeedbackAvaliacaoAluno/"+page, 
			{
				evalScripts:true,
				parameters: params, 
				metod: 'POST', 
				onLoading: function(response){
					addLoadding();
				},			
				onComplete:enviarFeedbackAvaliacaoAlunoBack,				
				encoding: 'ISO-8859-1'
			}
		);
}
function enviarFeedbackAvaliacaoAlunoBack(e, a){
	this.removeLoadding();
	res = eval('(' + e.responseText + ')');
	if(res['msg'] == 'error'){
		if(res['display'])
			this.addMensage('err', res['display']);
		else
			this.addMensage('err', 'Não foi possivel executar a operação, por favor verifique os dados!');
	}
	if(res['url'])
		location.href = project_root+"/FeedbackAvaliacaoAluno/"+res['url'];
}


function voltarForm(){
	var str = this.lerCookie('url');
	if(str)
		this.openPage(str);
	else
		location='?';
}

var root_path = project_root+"/public";

function aba(tag,id){
	var parent 	= tag.parentNode;
	var root	= parent.parentNode;
	if(parent && root){
		var filhos = root.childNodes;
		for(i=0;i<filhos.length;i++){
			filhos[i].style.background = 'url("'+root_path+'/images/admin/aba.jpg") repeat-x';
			filhos[i].setAttribute('className','aba');
			try{
				$('aba'+(i+1)).style.display = "none";
			}catch(err){}
		}
		parent.style.background = 'url("'+root_path+'/images/admin/aba_selected.jpg") repeat-x';
		parent.setAttribute('className','aba selected');
		try{
			$(id).style.display = "block";
		}catch(err){}
	}
}

function miniLoad(div,id){
	try{
		if(div){
			var option = document.createElement("div");
			option.setAttribute('id',id);
			option.innerHTML = "<img src=\""+project_root+"/public/images/mini-loader.gif\" />";
			
			div.appendChild(option);
		}
	}catch(Exception){}
}
function removeMiniLoad(div,id){
	try{
		if(div && $(id))
			div.removeChild($(id));
	}catch(Exception){}
}

function rerender(tag,lista, order, retorno){
	var page 	= project_root+"/function/render";
	
	this.miniLoad(tag.parentNode,'miniload');
	
	myname = new Array();
	tagname	= tag;
	
	for(i = 0; i<lista.length; i++){
	
		myname[i] = lista[i].name;
		
		var params 	= "Object=" + myname + "&RelationName=" + tag.name + "&RelationValue=" + tag.value;
		if(order)
			params += "&Order=" + order;
		if(retorno)
			params += "&Params=" + retorno;
		
		//alert(params);
		new Ajax.Request(
				page, 
				{
					evalScripts:true,
					parameters: params, 
					metod: 'POST', 
					onComplete:rerenderBack,				
					encoding: 'ISO-8859-1'
				}
			);
	}
}

function rerenderBack(e, a){
	
	this.removeMiniLoad(tagname.parentNode,'miniload');
	
	res = eval('(' + e.responseText + ')');
	
	if(res['msg'])
		this.addMensage('err', res['display']);
	else{
		var object = $(myname[0]);
		object.disabled = false;
		var aux	= 0;
		
		for(i = object.length-1; i>=0; i--)
			object.remove(i);

		for(i = 0; i<res.length;i++){
			var option = document.createElement("option");
			option.innerHTML = res[i]['html'];
			if(res[i]['value']>0)
				option.setAttribute('value',res[i]['value']);
			
			object.appendChild(option);
		}
		
		for(j = 1; j<myname.length; j++){
			for(i = myname.length-1; i>=1; i--)
				$(myname[j]).remove(i);
			$(myname[j]).disabled = true;
		}
	}
}


function rerenderObject(file,page,tag,column){
	var url 	= project_root+"/admin/";
	
	tagname	= tag;
	var tmp_vl = this.trim(tag.value);
	if(tmp_vl == "")
		alert("Não foi possível efetuar a busca. Campo vazio.");
	else{
		var params 	= "Column=" + column + "&Value=" + tag.value + "&File="+file;
		
		var flag = true;
		switch(column){
			case 'cpf':
				flag = this.valida_CPF('cpf');
				break;
		}
		
		if(flag){
			if(page){
				var url 	= project_root+"/admin/"+page;
				
				new Ajax.Updater(
						'work',
						url, 
						{
							parameters: params,
							method: 'POST',
							encoding: 'ISO-8859-1',
							onLoadding: function(response){
									this.miniLoad(tag.parentNode,'miniload');
								},
							onComplete:rerenderObjectBack,
							evalJS: true
						}
					);
			}
			try{
				window.scrollTo(0,0);
			}catch(err){}
		}
	}
	/*
	
	new Ajax.Request(
			page, 
			{
				evalScripts:true,
				parameters: params, 
				metod: 'POST', 			
				onComplete:rerenderObjectBack,				
				encoding: 'ISO-8859-1'
			}
		);
	*/
}

function rerenderObjectBack(e, a){
	
	this.removeMiniLoad(tagname.parentNode,'miniload');
	
	res = eval('(' + e.responseText + ')');

	if(res['msg']){
		if(res['msg'] == 'ok')
			this.addMensage('ok', res['display']);
		else
			this.addMensage('err', res['display']);
	}
}

function rerenderDiscAssunto(tag,lista){
	var page 	= project_root+"/function/renderDisciplinaAssunto";
	
	this.miniLoad(tag.parentNode,'miniload');
	
	myname = new Array();
	tagname	= tag;
	
	for(i = 0; i<lista.length; i++){
	
		myname[i] = lista[i].name;
		
		var params 	= "RelationValue=" + tag.value;

		new Ajax.Request(
				page, 
				{
					evalScripts:true,
					parameters: params, 
					metod: 'POST', 
					onComplete:rerenderDiscAssuntoBack,				
					encoding: 'ISO-8859-1'
				}
			);
	}
}

function rerenderDiscAssuntoBack(e, a){
	
	this.removeMiniLoad(tagname.parentNode,'miniload');
	
	res = eval('(' + e.responseText + ')');
	
	if(res['msg'])
		this.addMensage('err', res['display']);
	else{
		var object = $(myname[0]);
		object.disabled = false;
		var aux	= 0;
		
		for(i = object.length-1; i>=0; i--)
			object.remove(i);

		for(i = 0; i<res.length;i++){
			var option = document.createElement("option");
			option.innerHTML = res[i]['html'];
			if(res[i]['value']>0)
				option.setAttribute('value',res[i]['value']);
			
			object.appendChild(option);
		}
		
		for(j = 1; j<myname.length; j++){
			for(i = myname.length-1; i>=1; i--)
				$(myname[j]).remove(i);
			$(myname[j]).disabled = true;
		}
	}
}


function rerenderCheckDiscAssunto(tag,table){
	var page 	= project_root+"/function/renderCheckDisciplinaAssunto";
	
	this.miniLoad(tag.parentNode,'miniload');
	
	myname = table;
	tagname	= tag;

	var params 	= "RelationValue=" + tag.value +"&FindTo="+$('tpPesqusia').value;
	alert(params);
	new Ajax.Request(
			page, 
			{
				evalScripts:true,
				parameters: params, 
				metod: 'POST', 
				onComplete:rerenderCheckDiscAssuntoBack,				
				encoding: 'ISO-8859-1'
			}
		);
}

function rerenderCheckDiscAssuntoBack(e, a){
	
	this.removeMiniLoad(tagname.parentNode,'miniload');
	
	res = eval('(' + e.responseText + ')');
	
	if(res['msg'])
		this.addMensage('err', res['display']);
	else{
		var object = myname;
		
		var lista = object.getElementsByTagName('tBody');
		
		for(i=0;i<lista.length;i++){
			tmp = lista[i].parentNode;
			tmp.removeChild(lista[i]);
		}
		tBody = document.createElement("tbody");
		object.appendChild(tBody);

		for(i = 0; i<res.length;i++){
			
			var tr = document.createElement("tr");
			tr.setAttribute("class", "lineComponent");
			
			var td = document.createElement("td");
			td.setAttribute('class','center tdCheckRadio');
			
			var checkbox = document.createElement("input");
			checkbox.setAttribute("type", "checkbox");
			checkbox.setAttribute("name", "lista_assuntos[]");
			checkbox.setAttribute('value',res[i]['value']);
			
			td.appendChild(checkbox);
			tr.appendChild(td);
			
			td = document.createElement("td");
			td.setAttribute('class','left');
			td.innerHTML = res[i]['html'];
			
			tr.appendChild(td);			
			
			tBody.appendChild(tr);
		}
	}
}

function rerenderHistoricoAvaliacaoAluno(tag,id){
	
	var value = "";
	try{
		value = eval(tag.value);
	}catch(Exception){}
	
	if(tag && value){
		var page 	= project_root+"/function/renderHistoricoAvaliacaoAluno";
		
		this.miniLoad(tag.parentNode,'miniload');
		
		myname = id;
		tagname	= tag;
	
		var params 	= "RelationValue=" + tag.value;
		new Ajax.Request(
				page, 
				{
					evalScripts:true,
					parameters: params, 
					metod: 'POST', 
					onComplete:rerenderAvaliacaoAlunoBack,				
					encoding: 'ISO-8859-1'
				}
			);
	}
}
function rerenderAvaliacaoAluno(tag,id){
	
	var value = "";
	try{
		value = eval(tag.value);
	}catch(Exception){}
	
	if(tag && value){
		var page 	= project_root+"/function/renderAvaliacaoAluno";
		
		this.miniLoad(tag.parentNode,'miniload');
		
		myname = id;
		tagname	= tag;
	
		var params 	= "RelationValue=" + tag.value;

		new Ajax.Request(
				page, 
				{
					evalScripts:true,
					parameters: params, 
					metod: 'POST', 
					onComplete:rerenderAvaliacaoAlunoBack,				
					encoding: 'ISO-8859-1'
				}
			);
	}
}

function rerenderAvaliacaoAlunoBack(e, a){
	
	this.removeMiniLoad(tagname.parentNode,'miniload');
	
	res = eval('(' + e.responseText + ')');
	
	if(res['msg'])
		this.addMensage('err', res['display']);
	else{
		var object = myname;

		var child = object.childNodes;
		for(i = 0; i < child.length; i++)
			object.removeChild(child[i]);
		
		var div = document.createElement("div");
		for(i = 0; i<res.length;i++){			
			var innerDiv = document.createElement("div");			
			innerDiv.innerHTML = res[i]['html'];			
			div.appendChild(innerDiv);
		}
		if(!res.length){
			var str = '	<div class="divAvaliacao">';
			str += '		<div class="divTitleAvaliacao">';
			str += '			<div>';
			str += '				<h1 class="h1Avaliacao">Nenhuma Avaliação Disponível</h1>';
			str += '			</div>';
			str += '		</div>';
			str += '	</div>';
			
			var innerDiv = document.createElement("div");			
			innerDiv.innerHTML = str;			
			div.appendChild(innerDiv);
		}
		
		object.appendChild(div);
	}
}

function findQuestions(tag,table){
	var page 	= project_root+"/function/findQuestions";
	
	listaQuestao = $('listaQuestoes');
	this.miniLoad(listaQuestao.parentNode,'miniload');
	
	myname = listaQuestao;
	tagname	= listaQuestao;
	
	var params 	= tag.serialize();
	new Ajax.Request(
			page, 
			{
				evalScripts:true,
				parameters: params, 
				metod: 'POST', 
				onComplete:findQuestionsBack,				
				encoding: 'ISO-8859-1'
			}
		);
}

function findQuestionsBack(e, a){
	
	this.removeMiniLoad(tagname.parentNode,'miniload');
		
	res = eval('(' + e.responseText + ')');
	
	if(res['msg'])
		this.addMensage('err', res['display']);
	else{
		var object = myname;
		
		var lista = object.getElementsByTagName('tBody');
		
		for(i=0;i<lista.length;i++){
			tmp = lista[i].parentNode;
			tmp.removeChild(lista[i]);
		}
		tBody = document.createElement("tbody");
		object.appendChild(tBody);

		for(i = 0; i<res.length;i++){

			var tr = document.createElement("tr");
			tr.setAttribute("class", "lineComponent");

			var td = document.createElement("td");
			td.setAttribute('class','center tdCheckRadio');

			var checkbox = document.createElement("input");
			checkbox.setAttribute("type", "checkbox");
			checkbox.setAttribute("name", "lista_questoes[]");
			checkbox.setAttribute('value',res[i]['id']);

			td.appendChild(checkbox);
			tr.appendChild(td);

			td = document.createElement("td");
			td.setAttribute('class','left');
			td.innerHTML = "";			
			tr.appendChild(td);		

			var alternativas = res[i]['alternativas'];
			var str = "<h1 class=\\'h1Questoes\\'>"+res[i]['html']+"</h1><hr />";
			str += "<h2 class=\\'h2Questoes\\'>Alternativas</h2>";
			if(!alternativas.length)
				str += "<span class=\\'semAlternativas\\'>Não possui alternativas cadastradas</span>";
			else{
				str += "<ul class=\\'popupAlternativas\\'>";
				for(var j=0;j<alternativas.length;j++){
					if(alternativas[j]['id'] == res[i]['resposta'])
						str += "<li class=\\'popupAlternativaResposta\\'>"+alternativas[j]['descricao']+"</li>";
					else
						str += '<li>'+alternativas[j]['descricao']+'</li>';
				}
			}
			
			str += '</ul>';
			
			str += '<hr \>';
			str += "<h2 class=\\'h2Questoes\\'>Descricao da Resposta</h2>";
			str += "<span class=\\'descricaoResposta\\'>"+res[i]['descricao_resposta']+"</span>";
				
			var popup = 'onmouseover=\"return overlib(\''+str+'\',STICKY,WIDTH,400,CLOSETEXT,\'X\',CAPTION,\'Detalhes\',SNAPX,5,SNAPY,5);\" onmouseout=\"nd();\"';

			td = document.createElement("td");
			td.setAttribute('class','left');
			td.innerHTML = '<span class="questions" '+popup+'>'+res[i]['resume']+'</span>';			
			tr.appendChild(td);

			tBody.appendChild(tr);
		}
	}
}


function listRender(tag,lista){
	var page 	= project_root+"/function/listRender";
	
	this.miniLoad(tag.parentNode,'miniload');
	
	rId = new Array();
	tagname	= tag;
	var params = "";
	
	for(i = 0; i<lista.length; i++){
		rId[i]	= lista[i].id;
		rName	= rId;
		rOrder 	= "";
		
		if(lista[i]['name'])
			rName	= lista[i].name;
		if(lista[i]['order'])
			rOrder	= lista[i].order;
		
		params 	+= "ObjectName[]=" + rName + "&ObjectOrder[]=" + rOrder +"&";
	}
	
	if(params){
		params += "RelationName=" + tag.name + "&RelationValue=" + tag.value;
		
		new Ajax.Request(
				page, 
				{
					evalScripts:true,
					parameters: params, 
					metod: 'POST', 
					onComplete:listRenderBack,				
					encoding: 'ISO-8859-1'
				}
			);
	}
}

function listRenderBack(e, a){
	
	this.removeMiniLoad(tagname.parentNode,'miniload');

	res = eval('(' + e.responseText + ')');
	
	if(res['msg'])
		this.addMensage('err', res['display']);
	else{
		for(j = 0; j < rId.length; j++){
			var object = $(rId[j]);
			object.disabled = false;
			
			for(i = object.length-1; i>=0; i--)
				object.remove(i);
	
			for(i = 0; i<res.length;i++){
				if(res[i]['id'] == rId[j]){
					var option = document.createElement("option");
					option.innerHTML = res[i]['html'];
					if(res[i]['value']>0)
						option.setAttribute('value',res[i]['value']);
					
					object.appendChild(option);
				}
			}
			/*
			for(k = 1; k<rId.length; k++){
				for(l = rId.length-1; l>=1; l--)
					$(rId[k]).remove(l);
			}
			*/
		}
	}
}

function addComponentText(tag,inputComponent,contador){
	if(tag && inputComponent){
		var str = "";
		
		var option = document.createElement("tr");
		option.innerHTML = str;
		option.setAttribute('class','lineComponent');
		
		var contadorId = 0;
		try{
			contadorId = eval(contador.value);
			contadorId = contadorId-1;
		}catch(Exception){ contadorId = -1;}
		
		contador.value = contadorId;
	

		var value = this.trim(inputComponent.value);
		var txt = value;
		if(txt){
							
			var td = document.createElement("td");
			td.setAttribute('class','left');

			var input = document.createElement("input");
			input.setAttribute('type','hidden');
			input.setAttribute('name','lista_'+inputComponent.id+'[]');
			input.setAttribute('value',value);
			
			td.appendChild(input);
			td.innerHTML += txt;
			option.appendChild(td);
			
			inputComponent.value = "";
			
			var td = document.createElement("td");
			td.innerHTML = '<input type="button" class="bt_remove" onclick="removeDefaultComponent(this)" value="remover" />';
			option.appendChild(td);
			
			var tbody = document.createElement("tbody");
			tbody.appendChild(option);
			tag.appendChild(tbody);
		}
	}	
}

function addComponentRadio(tag,lista,contador){
	if(tag && lista){
		var str = "";
		
		var option = document.createElement("tr");
		option.innerHTML = str;
		option.setAttribute('class','lineComponent');
		
		var contadorId = 0;
		try{
			contadorId = eval(contador.value);
			contadorId = contadorId-1;
		}catch(Exception){ contadorId = -1;}
		
		contador.value = contadorId;
		
		var flag = false;
		
		for(i = 0; i<lista.length; i++){
			var value = this.trim(lista[i].value);
			var txt = value;
			if(txt){
				flag = true;
				if(lista[i].innerHTML.indexOf('<option') >= 0){
					txt = lista[i].options[lista[i].selectedIndex].text;
					lista[i].selectedIndex = 0;
				}
				
				var td = document.createElement("td");
				td.setAttribute('class','left');

				var input = document.createElement("input");
				input.setAttribute('type','hidden');
				input.setAttribute('name','lista_'+lista[i].name+'[]');
				input.setAttribute('value',value);
				
				//td.innerHTML  = '<input type="hidden" name="lista_'+lista[i].name+'[]" value="'+value+'" />';
				td.appendChild(input);
				td.innerHTML += txt;
				option.appendChild(td);
				
				var td2 = document.createElement("td");
				td2.innerHTML  = '<input type="radio" name="lista_radio" value="'+contadorId+'" />';
				option.appendChild(td2);
				
				lista[i].value = "";
			}
		}
		if(flag){
			var td = document.createElement("td");
			td.innerHTML = '<input type="button" class="bt_remove" onclick="removeCheckboxComponent(this)" value="remover" />';
			option.appendChild(td);
			
			
			if(!tag.tBody){
				var tbody = document.createElement("tbody");
				tbody.appendChild(option);
				tag.appendChild(tbody);
			}else
				tag.tBody.appendChild(option);
		}
	}	
}
function addComponent(tag,lista){
	if(tag && lista){
		var str = "";
		
		var option = document.createElement("tr");
		option.innerHTML = str;
		option.setAttribute('class','lineComponent');
		
		for(i = 0; i<lista.length; i++){
			var value = lista[i].value;
			var txt = value;
			if(lista[i].innerHTML.indexOf('<option') >= 0){
				txt = lista[i].options[lista[i].selectedIndex].text;
				lista[i].selectedIndex = 0;
			}
			
			var td = document.createElement("td");
			td.setAttribute('class', 'left');
			
			td.innerHTML  = '<input type="hidden" name="lista_'+lista[i].name+'[]" value="'+value+'" />';
			td.innerHTML += txt;
			option.appendChild(td);
			lista[i].value = "";
		}
		var td = document.createElement("td");
		td.innerHTML = '<input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" />';
		option.appendChild(td);
		
		
		if(!tag.tBody){
			var tbody = document.createElement("tbody");
			tbody.appendChild(option);
			tag.appendChild(tbody);
		}else
			tag.tBody.appendChild(option);
	}	
}
function removeComponent(tag){
	if(tag){
		var node = tag.parentNode.parentNode.parentNode;
		if(node)
			node.deleteRow(0);
	}
}
function removeCheckboxComponent(tag){
	if(tag){
		var tr = tag.parentNode.parentNode;
		var node = tag.parentNode.parentNode.parentNode;
				
		if(node)
			node.removeChild(tr);
	}
}
function removeDefaultComponent(tag){
	if(tag){
		var tr = tag.parentNode.parentNode;
		var node = tag.parentNode.parentNode.parentNode;
				
		if(node)
			node.removeChild(tr);
	}
}

function addMensage(tp,msg){
	switch(tp){
		case "ok":
			sucesso(msg);
			break;
		case "alert":
			alert(msg);
			break;
		case "err":
			error(msg);
			break;
		default:
			message(msg);		
	}
}

var $jq = jQuery.noConflict();

$jq('document').ready(function(){
	$jq('#alert').jqm({
		overlay: 60,
		overlayClass: 'overlay',
		modal: true,
		trigger: false
	});
	$jq('#confirm').jqm({
		overlay: 60,
		overlayClass: 'overlay',
		modal: true,
		trigger: false
	});
	$jq('#error').jqm({
		overlay: 60,
		overlayClass: 'overlay',
		modal: true,
		trigger: false
	});
	$jq('#message').jqm({
		overlay: 60,
		overlayClass: 'overlay',
		modal: true,
		trigger: false
	});
});
/*
function alert(msg){

	$jq('#alert')
		.jqmShow()
		.find('div.jqmAlertContent')
		.html("<img src='"+root_path+"/js/lib/jqModal/images/msg_alert_64.gif' /><spna>" +msg+ "</span>")
		.end()
		.find(':submit:visible')
		.click(function(){
			$jq('#alert').jqmHide();
		});
}
*/
function confirm(msg,callback){
	$jq('#confirm')
		.jqmShow()
		.find('div.jqmConfirmContent')
		.html("<img src='"+root_path+"/js/lib/jqModal/images/msg_message_64.gif' /><spna>" +msg+ "</span>")
		.end()
		.find(':submit:visible')
		.click(function(){
			if(this.value == 'Sim'){
				(typeof callback == 'string')?window.location.href = callback:callback;
			}
			$jq('#confirm').jqmHide();
		});
}

function error(msg){

	$jq('#error')
		.jqmShow()
		.find('div.jqmErrorContent')
		.html("<img src='"+root_path+"/js/lib/jqModal/images/msg_err_64.gif' /><spna>" +msg+ "</span>")
		.end()
		.find(':submit:visible')
		.click(function(){
			$jq('#error').jqmHide();
		});
}
function message(msg){

	$jq('#message')
		.jqmShow()
		.find('div.jqmMessageContent')
		.html("<img src='"+root_path+"/js/lib/jqModal/images/msg_message_64.gif' /><spna>" +msg+ "</span>")
		.end()
		.find(':submit:visible')
		.click(function(){
			$jq('#message').jqmHide();
		});
}
function sucesso(msg){

	$jq('#message')
		.jqmShow()
		.find('div.jqmMessageContent')
		.html("<img src='"+root_path+"/js/lib/jqModal/images/msg_ok_64.gif' /><spna>" +msg+ "</span>")
		.end()
		.find(':submit:visible')
		.click(function(){
			$jq('#message').jqmHide();
		});
}

/*
 * MENU VERTICAL - STATUS
 */
function toggleSubMenu(node) {	
	var menu = node.parentNode.parentNode;
	
	if (menu.getAttribute("class") == "submenu openned")
		menu.setAttribute("class", "submenu closed");
	else
		menu.setAttribute("class", "submenu openned");
}

/*
 * JQUERY
 */

/*
 * MENU VERTICAL - EFEITO
 */

/*
 * jQuery.noConflict() eliminia o conflito com o prototype utilizado pelo RichFaces
 * Subistitui o coringa em comum '$' por '$j'
 * 
 */
$j = jQuery.noConflict();
$j(
   function() {
	// Evento de clique do elemento: .submenu_bar > a
	$j('.submenu .submenu_bar > a').click(function() {
		// Expande ou retrai o elemento .sub-menu dentro do elemento pai (.content_men)
		$j('ul.sub-menu', $j(this).parent()).slideToggle('fast', function() {
			// Depois de expandir ou retrair, troca a classe 'aberto' do <a> clicado   
			$j(this).parent().toggleClass('aberto');
			});
			toggleSubMenu(this);
			return false;
		});
	}
);