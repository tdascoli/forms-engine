var Element = Class({

  id: '',
  name: '',
  label: '',
  type: '',
  placeholder: '',
  helptext: '',
  value: '',
  required: false,
  inputmask: [],
  style: [],
  attributes: [],
  readonly: false,
  disabled: false,

  __construct: function(label) {
    this.setId(label);
    this.setName(label);
    this.label = label;
  },

  setId: function(id, isName = false){
    this.id = _.camelCase(id);
    if (isName){
      this.setName(id);
    }
  },

  setName: function(name){
      this.name = _.camelCase(name);
  },

  isRequired: function(){
    this.required = true;
  },

  isDisabled: function(){
    this.disabled = true;
  },

  isReadonly: function(){
    this.readonly = true;
  },

  addStyle: function(style){
    this.style.push(style);
  },

  attr: function(attr, value){
    this.attributes.push({'attr':attr,'value':value});
  }

});
