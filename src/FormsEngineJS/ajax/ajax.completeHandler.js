// ajax.completeHandler.js
const form = document.getElementsByClassName('forms-engine__form');

form.onsubmit = function(event){
  event.preventDefault;

  var data = $(this).formJSON();
  var url = this.getAttribute('action');
};
