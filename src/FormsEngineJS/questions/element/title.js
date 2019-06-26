var Title = Class({ extends: Paragraph}, {
    __construct: function(title, description = ''){
    this.super('__construct', title, description);
    this.type = Type.TITLE;
  }
});
