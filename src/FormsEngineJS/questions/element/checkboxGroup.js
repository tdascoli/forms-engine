var CheckboxGroup = Class({ extends: Element}, {

    'public options': [],

    __construct: function(label, options){
        this.super('__construct', label);
        this.type = Type.CHECKBOX_GROUP;
        this.options = options;
  }
});
