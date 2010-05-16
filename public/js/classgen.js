function allTables(){
	var id 		= $('form');
	var options = document.getElementById('tabelas').options;
	
	for(i=0; i<options.length; i++){
		var input = "<input type=\"hidden\" name=\"tables[]\" value=\""+options[i].value+"\" />\n";
		id.innerHTML = id.innerHTML + input;
	}
	id.submit();
}
function allViewTables(){
	var id 		= $('form');
	var input = "<input type=\"hidden\" id=\"viewTable\" name=\"viewTable\" value=\"1\" />\n";
	id.innerHTML = id.innerHTML + input;
	this.allTables();
}