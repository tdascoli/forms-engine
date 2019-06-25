var Radio = Class({ extends: Element}, {

    'public checked': false,

    __construct: function(name, value, name, checked = false){
    this.super('__construct', name);
    this.type = Type.RADIO;
    this.value = value;
    this.name = name;
    this.checked = checked;
  }
});
