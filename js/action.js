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
			}

		param.after(btnSave);
	})
});

function saveAction( action ){
	// console.log(action);
	let btnSave = d.querySelector( '.save.' + action );
	// console.log(btnSave.classList.value);
		btnSave.disabled = true;
	let	aux = btnSave.parentNode.classList.value.split(" ").pop();

		paramData[aux].new = btnSave.previousElementSibling.innerHTML;

		//compare texts
		if( ! confirm('Are you sure?') ){
			console.log('No');
			btnSave.disabled = false;
			//RESET PARAM?

		}else{
			//verify param is empty
			let url = 'saveaction.php?id=' + aux + '&param=' + paramData[aux].new;//CHANGE TO POST
			fetch( url )
			.then( res => res.text() )
			.then( msg => {
				console.log( msg );
				btnSave.disabled = false;
			})
		}
}