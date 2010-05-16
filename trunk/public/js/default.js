var $jq = jQuery.noConflict();

/*
 * DOM
 */
var BASE_URL = location.pathname;

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
			 parameters: params,/*
			 onCreate: function(response) {
				 	response.transport.overrideMimeType("text/html; charset=iso-8859-1");
			},*/
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
	if(tag){
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