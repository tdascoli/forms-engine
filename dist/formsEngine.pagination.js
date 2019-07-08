$('.forms-engine__form').submit(function( event ) {

  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
    term = $form.find( "input[name='s']" ).val(),
    url = $form.attr( "action" );

  // Send the data using post
  var posting = $.post( url, { s: term } );

  // Put the results in a div
  posting.done(function( data ) {
    var content = $( data ).find( "#content" );
    $( "#result" ).empty().append( content );
  });

  /*
  https://api.jquery.com/jQuery.post/
  Post to the test.php page and get content which has been returned in json format (<?php echo json_encode(array("name"=>"John","time"=>"2pm")); ?>).

$.post( "test.php", { func: "getNameAndTime" }, function( data ) {
  console.log( data.name ); // John
  console.log( data.time ); // 2pm
}, "json");
  */
});
// FormsEngine Pagination
$( document ).ready(function() {
  var sections = $('.forms-engine__page');

  // config
  $('.forms-engine__form').parsley({
    errorClass: 'is-invalid',
    successClass: 'is-valid',
    errorsWrapper: '<span class="invalid-feedback">',
    errorTemplate: '<span></span>',
    classHandler: function(ParsleyField) {
        return ParsleyField.$element.parents('.form-control');
    },
    errorsContainer: function(ParsleyField) {
        return ParsleyField.$element.parents('.form-control');
    }
  });
  // end config

  function navigateTo(index) {
    // Mark the current section with the class 'current'
    $(sections)
      .removeClass('current')
      .eq(index)
        .addClass('current');

    $(sections)
      .hide()
      .eq(index)
        .show();

    $('#back').toggle(index > 0);
    var atTheEnd = index >= $(sections).length - 1;
    $('#next').toggle(!atTheEnd);
    $('#submit').toggle(atTheEnd);
  }

  function curIndex() {
    return $(sections).index($(sections).filter('.current'));
  }

  $('#next').click(function(){
    $('.forms-engine__form').parsley().whenValidate({
      group: 'block-' + curIndex()
    }).done(function() {
      navigateTo(curIndex() + 1);
    });
  });

  $('#back').click(function(){
    navigateTo(curIndex() - 1);
  });

  $(sections).each(function(index, section) {
    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
  });
  navigateTo(0);
});
