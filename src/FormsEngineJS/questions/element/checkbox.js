var Checkbox = Class({ extends: Element}, {

    'public checked': false,

    __construct: function(label, value, checked = false){
    this.super('__construct', label);
    this.type = Type.CHECKBOX;
    this.value = value;
    this.checked = checked;
  }
});
