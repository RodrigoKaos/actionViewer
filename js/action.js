var d = document;
var oriParam = {};


Array.from( d.querySelectorAll('.edit'))
.map( btnEdit => {
	btnEdit.addEventListener('click', () => {

		let aux = btnEdit.classList.value.split(" ").pop();
		btnEdit.disabled = true;
		
		let param = d.querySelector( 'div.' + aux + ' .param' );
			param.contentEditable = true;
		
		oriParam[aux] = param.innerHTML;

		let btnSave = d.createElement('button');
			btnSave.innerHTML = "Save";
			btnSave.onclick = saveAction;

		param.appendChild(btnSave);
	})
});

var saveAction = () => {
	let btnSave = d.querySelector('.param button');
		btnSave.disabled = true;
		console.log(oriParam);
		//compare texts
}