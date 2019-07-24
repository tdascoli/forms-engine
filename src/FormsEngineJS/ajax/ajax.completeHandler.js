// ajax.completeHandler.js
function formJSON(form) {
    var o = {};
    for (var i = 0; i < form.length; i++) {
      var element = form[i];
      if (element.name &&
          allowedInputElements.includes(element.tagName.toLowerCase())){
        if (!o[element.name]) {
          if (element.type!=='radio' &&
              element.type!=='checkbox'){
              o[element.name] = element.value || '';
          }
          else {
            o[element.name] = (element.checked) ? element.value : '';
          }
        }
      }
    };
    return o;
};

var submit = function(event){
  event.preventDefault();
  var data = formJSON(this.elements);
  var url = this.getAttribute('action');

  console.log(url, JSON.stringify(data));

  fetch(url, {
    method: 'put',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .catch(error => console.log('error is', error));
};

var testsubmit = function(){
  var data = formJSON(form.elements);
  var url = form.getAttribute('action');

  console.log(url, data);
};

const form = document.getElementsByClassName('forms-engine__form').item(0);
const allowedInputElements = ['input','textarea','select'];

form.onsubmit = submit;
