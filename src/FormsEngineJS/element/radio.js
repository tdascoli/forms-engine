var Radio = Class({ extends: Element}, {

    checked: false,

    __construct: function(name, value, name, checked = false){
    this.super('__construct', name);
    this.type = 'RADIO';
    this.value = value;
    this.name = name;
    this.checked = checked;
  }
});
