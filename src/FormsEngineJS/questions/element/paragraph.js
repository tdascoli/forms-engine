var Paragraph = Class({ extends: Element}, {

  'public title': '',
  'public description': '',

    __construct: function(title = '', description = ''){
    this.type = Type.PARAGRAPH;
    if (!_.isEmpty(title)){
        this.title = title;
    }
    if (!_.isEmpty(description)){
        this.description = description;
    }
  }
});
