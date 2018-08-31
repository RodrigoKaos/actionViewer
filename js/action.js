var d = document;
var paramData = {};


Array.from( d.querySelectorAll('.edit'))
.map( btnEdit => {
	
	btnEdit.addEventListener('click', () => {

		let aux = btnEdit.classList.value.split(" ").pop();		
		let param = d.querySelector( 'div.' + aux + ' .param' );			
		let btnSave = createSaveBtn( aux, () => {
			saveAction( aux );
			btnEdit.disabled = false;
			param.contentEditable = false;
			button.parentNode.removeChild( btnSave );
		});

		paramData[aux] = { "original" : param.innerHTML };
		btnEdit.disabled = true;
		param.contentEditable = true;
		param.after(btnSave);
	})
});

function saveAction( action ){ //REFACTOR

	let btnSave = d.querySelector( '.save.' + action );
	let	aux = btnSave.parentNode.classList.value.split(" ").pop();
	btnSave.disabled = true;	
	
	//verify param is empty
	//compare texts
	//NEW PARAM === ORIGINAL PARAM???
	let newParam = btnSave.previousElementSibling.innerHTML;
	newParam = fixParam( newParam );
	paramData[aux].new = newParam;
	
	let maxParamLenght = 127;	
	if( paramData[aux].new.length > maxParamLenght ){ //FIX

		let str = paramData[aux].new.substring( maxParamLenght );
		paramData[aux].new = paramData[aux].new.substring( 0, maxParamLenght );
		console.log( paramData[aux].new.length, str.length );
		alert( "Add this string to the next action: " + str );
		return false;
	}

	if( confirm('Are you sure?') ){

		let url = 'saveaction.php';
		let data = "id=" + aux + "&param=" + paramData[aux].new; 
		
		fetch( url, {
			method : 'POST',
			body :  data,
			headers : { 'Content-Type' : 'application/x-www-form-urlencoded' }
		})
		.then( res => res.text() )
		.then( msg => {
			console.log( msg );
			btnSave.disabled = false;
		})
		
	}

	console.log('No');
	btnSave.disabled = false;
	//RESET PARAM
}

function isTranslated(){
	return d.querySelector('.translated-ltr') !== null;
}

function fixTranslation( str ){
	str = str.replace( /<font style="vertical-align: inherit;">/g, '');
	str = str.replace( /<\/font>/g, '');
	return str;
}

function fixParam( str ){
	if( isTranslated() ) str = fixTranslation( str );
	str = str.replace( /&nbsp;/g, '');
	str = str.replace( /'/g, '');
	return str;
}

function createSaveBtn( actionClass, onClick ){

	let button = d.createElement('button');
		button.classList.add( 'save' );
		button.classList.add( actionClass );
		button.innerHTML = "Save";
		button.onclick = onClick;

	return button;
}