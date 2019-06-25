var Radio = Class({ extends: Element}, {

    'public checked': false,

    __construct: function(label, value, name, checked = false){
    this.super('__construct', label);
    this.type = Type.RADIO;
    this.value = value;
    this.name = name;
    this.checked = checked;
  }
});
