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


  if ($('.forms-engine__form').length > 0 &&
      $('.forms-engine__form').attr('method')!=='post'){
    $('.forms-engine__message').hide();
    $('.forms-engine__exception').hide();

    $('.forms-engine__form').submit(function(event) {
        $('.forms-engine__exception').hide();

        event.preventDefault();
        var data = $(this).formJSON();
        var url = $(this).attr('action');
        /* https://stackoverflow.com/questions/16689496/cross-domain-ajax-request-basic-authentication */
        $.ajax({
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: onSuccess,
            error: onError,
            processData: false,
            username: 'test',
            password: 'test',
            type: 'PUT',
            url: url
        });
    });
  }

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
