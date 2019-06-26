var Option = Class({

  'public options': [],

  __construct: function() {

  },

  add: function(label, value, selected = false){
    this.options.push(this.create(label, value, selected));
  },

  all: function(){
    return this.options;
  },

  'public static create': function(label, value, selected = false){
    var selectedValue='';
    if (selected){
      selectedValue='selected';
    }
    return {
      value: value,
      label: label,
      selected: selectedValue
    }
  }

});
