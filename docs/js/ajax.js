$( document ).ready(function() {
  (function ($) {
    $.fn.formJSON = function () {
        var o = {};
        var a = this.find(':input');
        $.each(a, function () {
          if (this.type !== 'button' &&
              this.type !== 'submit' &&
              this.type !== 'reset'){
            if (!o[this.name]) {
              if (this.type!=='radio' &&
                  this.type!=='checkbox'){
                  o[this.name] = this.value || '';
              }
              else {
                if ($(this).is(":checked")){
                  o[this.name] = this.value;
                }
                else {
                  o[this.name] = '';
                }
              }
            }
          }
        });
        return o;
    };
  })(jQuery);

  $('.forms-engine__message').hide();
  $('.forms-engine__exception').hide();

  $('.forms-engine__form').submit(function(event) {
    event.preventDefault();
    var data = $(this).formJSON();
    var url = $(this).attr("action");

    $.ajax({
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: onSuccess,
        error: onError,
        processData: false,
        type: 'PUT',
        url: url
    });
  });

  function onSuccess(){
    $('.forms-engine__form').hide();
    $('.forms-engine__message').show();
    $('.forms-engine__message').toggleClass('d-none');
  }

  function onError(){
    $('.forms-engine__exception').show();
    $('.forms-engine__exception').toggleClass('d-none');
  }

});
