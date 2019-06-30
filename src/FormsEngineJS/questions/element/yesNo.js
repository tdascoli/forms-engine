var YesNo = Class({ extends: ElementGroup}, {

  'public yesno': [],
  'public name': '',
  'public booleans': false,

  'private yesnoBooleans': { 'Yes': true,'No': false },
  'private yesnoStrings': { 'Yes': 'Ja','No': 'Nein' },

    __construct: function(name, booleans){
    this.type = Type.YESNO;
    this.name = name;
    this.booleans = booleans;
    var values = this.yesnoStrings;
    if (this.booleans){
      values = this.yesnoBooleans;
    }
    this.yesno=new Array(
      new Radio('Ja', values.Yes, this.name),
      new Radio('Nein', values.No, this.name)
    );
  }
});
