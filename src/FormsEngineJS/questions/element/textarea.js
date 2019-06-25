var Textarea = Class({ extends: Input}, {
    __construct: function(label, placeholder = '', helptext = ''){
    this.super('__construct', label, placeholder, helptext);
    this.type = Type.TEXTAREA;
  }
});
