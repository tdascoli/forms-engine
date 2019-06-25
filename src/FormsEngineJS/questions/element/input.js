var Input = Class({ extends: Element}, {
    __construct: function(name, placeholder = '', helptext = ''){
    this.super('__construct', name);
    if (!_.isEmpty(placeholder)){
        this.placeholder = placeholder;
    }
    if (!_.isEmpty(helptext)){
        this.helptext = helptext;
    }
  }
});
