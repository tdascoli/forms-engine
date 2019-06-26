var Typeahead = Class({ extends: Text}, {

    'public options': [],

    __construct: function(label, options, placeholder = '', helptext = ''){
    this.super('__construct', label, placeholder, helptext);
    this.type = Type.TYPEAHEAD;
    this.options = options;
  }
});
