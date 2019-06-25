// todo js-model or not? or knockout models...
var Element = function(){
  /** @var string */
  this.id;

  /** @var string */
  this.name;

  /** @var string */
  this.label;

  /** @var FieldType */
  this.type;

  /** @var string */
  this.placeholder;

  /** @var string */
  this.helptext;

  /** @var string */
  this.value;

  /** @var boolean */
  this.required;

  /** @var array */
  this.inputmask;

  /** @var array */
  this.style;

  /** @var array */
  this.attributes;

  /** @var boolean */
  this.readonly;

  /** @var boolean */
  this.disabled;
};

var Select = function(){
  /** @var array */
  this.options;
};