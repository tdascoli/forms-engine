// js renderer
var template = twig({
    data: 'The {{ baked_good }} is a lie.'
});

console.log(
    template.render({baked_good: 'cupcake'})
);
// outputs: "The cupcake is a lie."

var Renderer = Class({

    twig: 'Twig Class???',
    pages:[],
    formTitle:'',
    loader:'Loader Class',

    __construct: function(){

  }
});