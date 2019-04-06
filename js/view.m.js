const d = document;

export let View = (() => {

  return { init };

})();

function init( options ){ //TODO: Validade options
  handleNpcView();
}

function handleNpcView(){
  getNpcList({
    map :1000,
    callback : buildNpcList
  });
}

function buildNpcList( list ){
  let npcParentNode = d.querySelector('.npc-list');
  Array.from(list).map((npc) =>{
    console.log(npc);
    createNpc(npc, npcParentNode);
  });
}

function createNpc(param, parentNode){
  let npc = d.createElement('div');
  npc.classList.add('item');
  npc.setAttribute('data-id', param.id);
  npc.setAttribute('data-action', param.task0);

  let spanName = d.createElement('span');
  spanName.innerHTML = param.name;

  if(!param.isComplete)
    npc.classList.add('incomplete');

  npc.append(spanName);
  parentNode.append(npc);
}

//------
function getNpcList(obj){
  let npcs = '';
  let url = 'api/npcs.php';

  if (obj.map) url += `?map=${obj.map}`;

  fetch( url, { method : 'GET'} )
  .then(res => res.json())
  .then(data => {
    obj.callback(data);
  });
}
