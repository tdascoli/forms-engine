$( document ).ready(function() {
  // todo also empty!!!
  (function ($) {
    $.fn.serializeFormJSON = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
  })(jQuery);

  $('.forms-engine__form').submit(function( event ) {
    event.preventDefault();
    var data = $(this).serializeFormJSON();
    $.ajax({
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(data){
            alert("device control succeeded");
        },
        error: function(){
            alert("Device control failed");
        },
        processData: false,
        type: 'PUT',
        url: '/api/record/test'
    });
  });

});
