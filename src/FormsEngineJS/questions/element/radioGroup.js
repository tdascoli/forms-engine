var RadioGroup = Class({ extends: Element}, {

    'public options': [],

    __construct: function(label, options, name = undefined){
        this.super('__construct', label);
        this.type = Type.RADIO_GROUP;
        this.options = options;
        if (name !== undefined){
            this.name = name;
        }
  }
});
