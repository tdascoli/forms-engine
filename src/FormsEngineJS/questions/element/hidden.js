var Hidden = Class({ extends: Input}, {
    __construct: function(id,value = ''){
    this.setId(id, true);
    this.type = Type.HIDDEN;
    if (!_.isEmpty(value)){
        this.value = value;
    }
  }
});
