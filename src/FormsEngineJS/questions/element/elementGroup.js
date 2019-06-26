var ElementGroup = Class({

  'public type': '',
  'public elements': [],

  __construct: function(elements) {
    this.elements = elements;
  },

  setId: function(id, isName = false){
    this.id = _.camelCase(id);
    if (isName){
      this.setName(id);
    }
  }

});
