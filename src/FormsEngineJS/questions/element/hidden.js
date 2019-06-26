var Hidden = Class({ extends: Input}, {
    __construct: function(id){
    this.setId(id, true);
    this.type = Type.HIDDEN;
  }
});
