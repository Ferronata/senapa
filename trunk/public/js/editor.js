/**
 *
	PARAMS
		config.toolbar_Full =
		[
			['Source','-','Save','NewPage','Preview','-','Templates'],
			['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
			['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
			['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
			'/',
			['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
			['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Link','Unlink','Anchor'],
			['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
			'/',
			['Styles','Format','Font','FontSize'],
			['TextColor','BGColor'],
			['Maximize', 'ShowBlocks','-','About']
		];
 */
var root_path = '/senapa/public/js/lib/ckeditor/';
function createEditor( id, languageCode, op, w, h){
	var width_pane 	= '99%';
	var height_pane	= '200px';
	
	if(w)
		width_pane = w;
	if(h)
		height_pane = h;
	
	
	switch(op){
		case 'full':
			CKEDITOR.replace( id,
				{
					width			: width_pane+'',
					height			: height_pane+'',
					extraPlugins 	: 'uicolor',
					language 		: languageCode,
					toolbar : 
					[
						['Source','-','Save','NewPage','Preview','-','Templates'],
						['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
						['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
						['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
						'/',
						['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
						['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
						['Link','Unlink','Anchor'],
						['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
						'/',
						['Styles','Format','Font','FontSize'],
						['TextColor','BGColor'],
						['Maximize', 'ShowBlocks','-','About']
					]
				}
			);
			break;
		case 'admin':
			CKEDITOR.replace( id,
				{
					width			: width_pane+'',
					height			: height_pane+'',
					extraPlugins 	: 'uicolor',
					language 		: languageCode,
					toolbar : 
					[
						['Source','-','Save','NewPage','Preview','-','Templates'],
						['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
						['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
						['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
						'/',
						['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
						['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
						['Link','Unlink','Anchor'],
						['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
						'/',
						['Styles','Format','Font','FontSize'],
						['TextColor','BGColor'],
						['Maximize', 'ShowBlocks','-','About']
					]
				}
			);
			break;
		case 'client':
			CKEDITOR.replace( id,
				{
					width			: width_pane+'',
					height			: height_pane+'',
					extraPlugins 	: 'uicolor',
					language 		: languageCode,
					toolbar : 
					[	
						['Source','-','Preview','Cut','Copy','Paste','PasteText','-','SpellChecker', 'Scayt'],
						['Undo','Redo','-','Find','SelectAll','RemoveFormat'],
						'/',
						['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
						['NumberedList','BulletedList','-','Outdent','Indent'],
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
						['Link','Unlink','Anchor'],
						['Maximize']
					]
						
				}
			);
			break;
		case 'user':
			CKEDITOR.replace( id,
				{
					width			: width_pane+'',
					height			: height_pane+'',
					extraPlugins 	: 'uicolor',
					language 		: languageCode,
					toolbar 		: 
					[	
						['Preview','Cut','Copy','Paste','PasteText','-','SpellChecker', 'Scayt'],
						['Undo','Redo','-','Find','SelectAll','RemoveFormat'],
						'/',
						['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
						['NumberedList','BulletedList','-','Outdent','Indent'],
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
						['Link','Unlink','Anchor'],
						['Maximize']
					]
						
				}
			);
			break;
		case 'basic_text':
			CKEDITOR.replace( id,
				{
					width			: width_pane+'',
					height			: height_pane+'',
					extraPlugins 	: 'uicolor',
					language 		: languageCode,
					toolbar 		: 
					[	

						['Undo','Redo','-','Bold','Italic','Underline','-','Subscript','Superscript'],
						['NumberedList','BulletedList'],
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
						['Link','Unlink'],
						['Maximize']
					]
						
				}
			);
			break;
		default:
			CKEDITOR.replace( id,
				{
					width			: width_pane+'',
					height			: height_pane+'',
					extraPlugins 	: 'uicolor',
					language 		: languageCode,					
					filebrowserBrowseUrl : root_path+'/browser/pgrfilemanager/PGRFileManager.php',
				    filebrowserImageBrowseUrl : root_path+'/browser/pgrfilemanager/PGRFileManager.php?type=Images',
				    filebrowserFlashBrowseUrl : root_path+'/browser/pgrfilemanager/PGRFileManager.php?type=Flash',
					toolbar : 
					[
						['Source','-','Image','Flash','Cut','Copy','Paste','PasteText','-','Print', 'SpellChecker'],
						['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
						['PageBreak','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
						['NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ]
					]
				}
			);
	}
}
/*
//filebrowserImageBrowseUrl : root_path + '/ckeditor/filemanager/browser/default/browser.html?Type=Image&command=QuickUpload',
filebrowserBrowseUrl : 			root_path+'/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl : 	root_path+'/ckfinder/ckfinder.html?Type=Images',
filebrowserFlashBrowseUrl : 	root_path+'/ckfinder/ckfinder.html?Type=Flash',
filebrowserUploadUrl : 			root_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl : 	root_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
filebrowserFlashUploadUrl : 	root_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
*/
function createEditorPanel(op,id){
	var width 	= '99%';
	var height	= '200px';

	if(!id){
		var textArea = this.getObjectId('textarea');
		if(textArea.length > 0){
			for(i=0;i<textArea.length;i++){
				var tag = $(textArea[i]);
				if(tag.style.width)
					width = tag.style.width;
				else
					width = '99%';
				if(tag.style.height)
					height = tag.style.height;
				else
					height = '200px';
					
				if(CKEDITOR.instances[textArea[i]])
					CKEDITOR.remove(CKEDITOR.instances[textArea[i]]);
				this.createEditor(textArea[i], 'pt-br', op, width, height);
			}
		}
	}else{
		var tag = $(id);
		if(tag != null){
			if(tag.style.width)
				width = tag.style.width;
			if(tag.style.height)
				height = tag.style.height;
		}
		
		if(CKEDITOR.instances[id])
			CKEDITOR.remove(CKEDITOR.instances[id]);
		this.createEditor(id, 'pt-br', op, width, height);
	}
}
function getObjectId(object){
	var objectList 	= document.getElementsByTagName(object);
	var lista 		= new Array();
	var j = 0;
	for(i=0;objectList != null && i<objectList.length;i++){
		
		if(objectList[i].id){
			lista[j++] = objectList[i].id;
			
		}
	}
	return lista;
}