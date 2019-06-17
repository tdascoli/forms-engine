// FormsEngine Pagination
$( document ).ready(function() {
  var pagination = {
    page: $('form.forms-engine__form').data('page'),
    pagesize: $('form.forms-engine__form').data('pagesize')
  }

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
});
