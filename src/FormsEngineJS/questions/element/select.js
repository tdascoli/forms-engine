var Select = Class({ extends: Element }, {

  'public options': [],
  'public nullable': false,

  __construct: function(label, options, nullable = false, helptext = ''){
    this.super('__construct', label);
    this.type = Type.SELECT;
    this.options = options;
    this.nullable = nullable;
    if (!_.isEmpty(helptext)){
        this.helptext = helptext;
    }
  }

});
