{*
 * AlunoAvaliacao => View de manipulação de dados da classe 'AlunoAvaliacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
{literal}
<style type="text/css">

.alunoAvaliacaoHeader{
	border-bottom: 1px solid #666666;
}

.navegation{
	margin: 0;
	padding: 0;
	width: 100%;
	height: 40px;
	display: block;
}
.alunoAvaliacaoQuestions, .alunoAvaliacaoTimer{
	margin: 0;
	padding: 0;
	
	margin-top: 5px;
	
	width: 40%;
	height: 30px;
	color: #666666;
	font-style: italic;
}
.alunoAvaliacaoQuestions span, .alunoAvaliacaoTimer span{
	font-weight: 900;
	color: #333333;
}

.alunoAvaliacaoQuestions{
	float: left;
}
.alunoAvaliacaoTimer{
	text-align: right;
	float: right;
}

.alunoAvaliacaoFooter{
	border-top: 1px solid #666666;
}

.question{
	
}
.reply{
	margin-top: 10px;
	background: #F5F5F5 !important;
}

.controller{
	margin: 0;
	padding: 0;
	width: 91%;
	height: 40px;
	display: block;
}
.buttonLeft, .buttonRight{
	margin: 0;
	padding: 0;
	width: 32px;
	height: 32px;
}
.buttonLeft{
	float: left;
	background: #FCFCFC;
}
.buttonRight{
	float: right;
	background: #FCFCFC;
}
</style>

<script type="text/javascript">

hora 	= 0;
minuto 	= 0;
segundo = 0;

function timer(){
	var tmp = $('timer');
	if(tmp){
		segundo += 1;
		if(segundo == 60){
	    	segundo = 0;
	    	minuto += 1;
	    }
	    if(minuto == 60){
	        minuto = 0;
	        hora += 1;
	    }
	
	    var hh = hora;
	    var mm = minuto;
	    var ss = segundo;
	
	    if(hora < 10)
	        hh = "0"+hh;
	    if(minuto < 10)
	        mm = "0"+mm;
	    if(segundo < 10)
	        ss = "0"+ss;
		
	    horaImprimivel = " "+hh + ":" + mm + ":" + ss;
    
    	tmp.innerHTML = horaImprimivel;
	}
    setTimeout("timer()",1000);
}

timer();

</script>
{/literal}
<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/alunoavaliacao/AlunoAvaliacao', 'form', 'save');" onsubmit="return(runAction(this))">
				<div class="alunoAvaliacaoHeader">
					<h1 class="h1AlunoAvaliacao">Matemática - 1ª Avaliação</h1>
					<div class="navegation">
						<span class="alunoAvaliacaoQuestions"><span>Questão:</span> 2 / 8</span>
						<span class="alunoAvaliacaoTimer"><span>Tempo:</span><label id="timer"> 00:00:00</label></span>
					</div>
				</div>
				<div class="alunoAvaliacaoBody innerBody">
					<div class="controller">
						<span class="buttonLeft"><input type="button" class="back" value="Anterior" /></span>
						<span class="buttonRight"><input type="button" class="next" value="Próxima" /></span>
					</div>
					<div class="question content">
						O surgimento da figura da Ema no céu, ao leste, no anoitecer, na segunda quinzena de junho, indica o início do inverno para os índios do sul do Brasil e o começo da estação seca para os do norte. É limitada pelas constelações de Escorpião e do Cruzeiro do Sul, ou Cut'uxu. Segundo o mito guarani, o Cut?uxu segura a cabeça da ave para garantir a vida na Terra, porque, se ela se soltar, beberá toda a água do nosso planeta. Os tupisguaranis utilizam o Cut'uxu para se orientar e determinar a duração das noites e as estações do ano. Assinale a opção correta a respeito da linguagem empregada no texto acima.
					</div>
					<div class="reply content">
						<div class="line">
								<ul class="popupAlternativas">
									<li><label><input type="radio" name="resposta" />Teste 1</label></li>
									<li><label><input type="radio" name="resposta" />Teste 2</label></li>
									<li><label><input type="radio" name="resposta" />Teste 3</label></li>
									<li><label><input type="radio" name="resposta" />Teste 4</label></li>
									<li><label><input type="radio" name="resposta" />Teste 5</label></li>
								</ul>
						</div>
					</div>
				</div>
				<div class="alunoAvaliacaoFooter">
					<div class="controller" style="margin-top: 10px;">
						<span class="buttonLeft"><input type="button" class="back" value="Anterior" /></span>
						<span class="buttonRight"><input type="button" class="next" value="Próxima" /></span>
					</div>
				</div>
			</form>
		</div>
	</div>
</center>