var Checkbox = Class({ extends: Element}, {

    'public checked': false,

    __construct: function(name, value, checked = false){
    this.super('__construct', name);
    this.type = 'CHECKBOX';
    this.value = value;
    this.checked = checked;
  }
});
