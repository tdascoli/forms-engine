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

  $('.forms-engine__message').hide();
  $('.forms-engine__exception').hide();

  $('.forms-engine__form').submit(function(event) {
    event.preventDefault();
    var data = $(this).serializeFormJSON();
    var url = $(this).attr("action");

    $.ajax({
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: onSuccess(),
        error: onError(),
        processData: false,
        type: 'PUT',
        url: url
    });
  });

  function onSuccess(){
    $('.forms-engine__form').hide();
    $('.forms-engine__message').show();
  }

  function onError(){
    $('.forms-engine__exception').show();
  }

});
