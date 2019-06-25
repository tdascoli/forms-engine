var Input = Class({ extends: Element}, {
    __construct: function(label, placeholder = '', helptext = ''){
    this.super('__construct', label);
    if (!_.isEmpty(placeholder)){
        this.placeholder = placeholder;
    }
    if (!_.isEmpty(helptext)){
        this.helptext = helptext;
    }
  }
});
