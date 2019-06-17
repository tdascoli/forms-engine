// FormsEngine Pagination
$( document ).ready(function() {
  var pagination = {
    page: $('form.forms-engine__form').data('page'),
    pagesize: $('form.forms-engine__form').data('pagesize')
  }

  // initially render pages
  render();

  function render(){
    console.log(pagination.page, pagination.pagesize);
    if (pagination.page === pagination.pagesize){
      $('#next').hide();
      $('#submit').show();
      if (pagination.pagesize === 1){
        $('#back').hide();
      }
      else {
        $('#back').show();
      }
    }
    else if (pagination.page === 1){
      $('#next').show();
      $('#back').hide();
      $('#submit').hide();
    }
    else {
      $('#next').show();
      $('#back').show();
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

  //watcher
  watch(pagination, 'page', function(){
    render();
  });
});
