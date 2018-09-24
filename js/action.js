const d = document;
let paramData = {};

Array.from( d.querySelectorAll('.edit')).map( btnEdit => {
	btnEdit.addEventListener( 'click', handleEditAction );
});

function handleEditAction(){

	let actionSelector = this.classList.value.split(' ').pop();
	let param = d.querySelector( 'div.' + actionSelector + ' .param' );
	let btnSave = createSaveBtn( actionSelector, () => {
		this.disabled = false;
		param.contentEditable = false;
		handleSaveAction( actionSelector );
		btnSave.parentNode.removeChild( btnSave );
	});

	if( paramData[actionSelector] == undefined ) //FIXME: Keep old parameter
		paramData[actionSelector] = { 'original' : param.innerHTML };

	param.addEventListener( 'input', handleMaxLength );

	this.disabled = true;
	param.contentEditable = true;
	this.after(btnSave);
}

function handleMaxLength(){

	if( this.nextSibling != d.querySelector('.length') ){
		let lengthSpan = d.createElement('span');
		lengthSpan.classList.add('length');
		lengthSpan.innerHTML = this.innerHTML.length;
		this.after(lengthSpan);
	}

	if( d.querySelector('.length') != null )
			d.querySelector('.length').innerHTML = this.innerHTML.length;

	if( !validateMaxLength( this.innerHTML.length )){
		this.classList.add('error');
		d.querySelector('.length').classList.add('error');
		d.querySelector('.length').classList.add('bold');
		d.querySelector('.length').innerHTML = 'Param must be less than 127 characters...';
	}else{
		this.classList.remove('error');
		d.querySelector('.length').classList.remove('error');
		d.querySelector('.length').classList.remove('bold');
	}
}

function createSaveBtn( actionClass, onClick ){

	let button = d.createElement('button');
		button.classList.add( 'save' );
		button.classList.add( actionClass );
		button.innerHTML = "Save";
		button.onclick = onClick;

	return button;
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

function validateMaxLength( str ){

	let paramMaxLenght = 127;
	return str < paramMaxLenght;
}

function handleSaveAction( actionSelector ){

	let btnSave = d.querySelector( '.save.' + actionSelector );
	btnSave.disabled = true;

	//------
	let paramNew = d.querySelector( '.' + actionSelector + ' .param').innerHTML;

	if( paramNew == paramData[actionSelector].original ){
		console.log("Param wasn't modified...");
		return;
	}

	if( !validateMaxLength( paramNew.length )){
		console.log('Param max length should be less than 127 characters...');
		return;
	}

	paramData[actionSelector].new = fixParam( paramNew );

	saveAction( actionSelector, paramData[actionSelector].new );
	btnSave.disabled = false;
}

function saveAction( action, param ){ //TODO: Refactor

	if( confirm('Are you sure?') ){

		let url = 'saveaction.php';
		let data = "id=" + action + "&param=" + param;

		fetch( url, {
			method	: 'POST',
			body 	: data,
			headers : { 'Content-Type' : 'application/x-www-form-urlencoded' }
		})
		.then( res => res.text() )
		.then( msg => {
			console.log( msg );
		});
	}
}
