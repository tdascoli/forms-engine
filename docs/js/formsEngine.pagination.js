// FormsEngine Pagination
$( document ).ready(function() {
  var sections = $('.forms-engine__page');

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
  /*
  var pagination = {
    page: $('form.forms-engine__form').data('page'),
    pagesize: $('form.forms-engine__form').data('pagesize')
  };

  // initially render pages
  render();

  function render(){
    $('#next').show();
    $('#back').show();
    $('#submit').show();

    if (pagination.page === pagination.pagesize){
      $('#next').hide();
      if (pagination.pagesize === 1){
        $('#back').hide();
      }
    }
    else if (pagination.page === 1){
      $('#back').hide();
      $('#submit').hide();
    }

    $('fieldset.forms-engine__page').each(function(){
      if ($(this).data('page')!==pagination.page){
        $(this).hide();
      }
      else {
        $(this).show();
      }
    });
  }

  $('#next').click(function(){
    var next = pagination.page + 1;
    pagination.page = next;
  });

  $('#back').click(function(){
    var back = pagination.page - 1;
    pagination.page = back;
  });

  $('.to--page').click(function(){
    pagination.page = $(this).data('page');
  });

  //watcher
  watch(pagination, 'page', function(){
    render();
  });
  */
});
