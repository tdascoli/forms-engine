var Email = Class({ extends: Input}, {
    __construct: function(name, placeholder = '', helptext = ''){
    this.super('__construct', name, placeholder, helptext);
    this.type = 'EMAIL';
  }
});
