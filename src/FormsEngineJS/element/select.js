var Select = Class({ extends: Element }, {

  options: [],
  nullable: false,

  __construct: function(name, options, nullable = false, helptext = ''){
    this.super('__construct', name);
    this.type = 'SELECT';
    this.options = options;
    this.nullable = nullable;
    if (!_.isEmpty(helptext)){
        this.helptext = helptext;
    }
  }

});
