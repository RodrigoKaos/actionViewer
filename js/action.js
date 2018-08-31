var d = document;
var paramData = {};


Array.from( d.querySelectorAll('.edit'))
.map( btnEdit => {
	
	btnEdit.addEventListener('click', () => {

		let aux = btnEdit.classList.value.split(" ").pop();
		btnEdit.disabled = true;
		
		let param = d.querySelector( 'div.' + aux + ' .param' );
			param.contentEditable = true;
		
		paramData[aux] = { "original" : param.innerHTML };

		let btnSave = d.createElement('button');
			btnSave.classList.add( 'save' );
			btnSave.classList.add( aux );
			btnSave.innerHTML = "Save";
			btnSave.onclick = () => {
				saveAction( aux );
				btnEdit.disabled = false;
				param.contentEditable = false;
			}

		param.after(btnSave);
	})
});

function saveAction( action ){ //REFACTOR
	// console.log(action);
	let btnSave = d.querySelector( '.save.' + action );
	// console.log(btnSave.classList.value);
		btnSave.disabled = true;
	let	aux = btnSave.parentNode.classList.value.split(" ").pop();

		paramData[aux].new = btnSave.previousElementSibling.innerHTML;

		if( isTranslated() ){
			paramData[aux].new = fixTranslation( paramData[aux].new );
		}

		paramData[aux].new = paramData[aux].new.replace( /&nbsp;/g, '');

		//compare texts
		if( ! confirm('Are you sure?') ){
			console.log('No');
			btnSave.disabled = false;
			//RESET PARAM?

		}else{
			//verify param is empty
			paramLenght = 127;
			if( paramData[aux].new.length > paramLenght ){ //FIX
				
				let str = paramData[aux].new.substring( paramLenght );
				paramData[aux].new = paramData[aux].new.substring( 0, paramLenght );
				console.log( paramData[aux].new.length, str.length );
				alert( "Add this string to the next action: " + str );
				// alert('the text must have less than 127 characters');
			}else{
				
				let url = 'saveaction.php';
				let data = "id=" + aux + "&param=" + paramData[aux].new; 
				
				fetch( url, {
					method : 'POST',
					body :  data,
					headers : { 'Content-Type' : 'application/x-www-form-urlencoded' }
				} )
				.then( res => res.text() )
				.then( msg => {
					console.log( msg );
					btnSave.disabled = false;
				})
			}
		}
}

function isTranslated(){
	return d.querySelector('.translated-ltr') !== null;
}

function fixTranslation( str ){
	str = str.replace( /<font style="vertical-align: inherit;">/g, '');
	str = str.replace( /<\/font>/g, '');
	return str;
}