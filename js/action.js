var d = document;

Array.from( d.querySelectorAll('.edit'))
.map( button => {
	button.addEventListener('click', () =>{
		
		let aux = button.classList.value.split(" ").pop();
		button.disabled = true;
		
		let param = d.querySelector( 'div.' + aux + ' .param' );
			param.contentEditable = true;		

		let btnSave = d.createElement('button');
			btnSave.innerHTML = "Save";

		param.appendChild(btnSave);
	})
});