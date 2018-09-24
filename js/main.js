var d = document;
var modal = d.querySelector('.modal');

var closeModal 	= () => { modal.classList.toggle('hide', true) };
var openModal 	= () => { modal.classList.toggle('hide', false) };
var closeEvent 	= new Event('closeModal');

modal.addEventListener('closeModal', () => {
	Array.from(d.querySelectorAll('.content')).map(el => {
		modal.removeChild( el );

	});
});

// Array.from( d.querySelectorAll('.task') )
// 	.map( el => el.addEventListener('click', () => {
// 			let url = 'taskview.php?task=' + el.innerText;
// 			// console.log(url, el);
// 			fetch( url )
// 			.then( response => {
// 				if (response.ok){
// 					response.json().then(json => {
// 						// console.log(json.test)
// 						let div = d.createElement('div');
// 						div.classList.add('content');
// 						div.innerHTML = json.test;//---
// 						modal.appendChild(div);
// 					});
// 				}

// 			})
// 			.catch(err => { console.log(err) });

// 			openModal();

// 	}) );

d.querySelector('.modal > .close').addEventListener('click', () => {
	modal.dispatchEvent(closeEvent);
	closeModal();
});
