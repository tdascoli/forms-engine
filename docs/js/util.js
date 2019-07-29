function Element(selector){

}

// factory to create a new parent
function e(selector) {
  var element = undefined;
  const regex = /(,|\.|#|\s)/g;

  if (selector.match(regex)==1){
    if (selector.startsWith('#')){
      this.element = document.getElementById(selector);
    }
    else if (selector.startsWith('.')){
      this.element = document.getElementsByClassName(selector);
    }
  }
  else {
    this.element = document.querySelectorAll(selector);
  }

  var proto = Element.prototype;
  var properties = {
      selector: {writable: true, configurable: true, value: selector || ''},
      element: {writable: true, configurable: true, value: this.element}
  };
  var object = Object.create(proto,properties);
  return object;
}

Element.prototype = {
  hide: function(){
    console.log('hide',this);
    //this.element.style.display='none';
  },
  show: function(){
    console.log('show',this);
    //this.element.style.display='';
  }
};

var test = e('#defaultForm');

console.log(test);

test.hide();

test.show();
