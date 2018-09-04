
$(document).ready(function(){

  $("#search").autocomplete({
    minLength:3,
    autoFocus:true,
    source:BASE_URL + 'getdata'
  });
});

String.prototype.permalink = function () {
  console.log(this.toString());
  return this.toString().trim().toLowerCase().replace(new RegExp(' ', 'g'), '-');
};
$('.dest').on('focusout', function () {
  var value = $(this).val().permalink();
  $('.target').val(value);
});
$('.add-cart-btn').on('click', function () {
  var pid = $(this).data('id');
  var curl = $(this).data('curl');
  $.ajax({
    url: BASE_URL + 'shop/add-to-cart',
    type: 'GET',
    dataType: 'html',
    data: {pid: pid, curl: curl},
    success: function (res) {

      location.reload();
    }
  });

  
});

$('.message').delay(4000).slideUp();
$('.incr-btn').on('click', function () {
  $.ajax({
    url: BASE_URL + 'shop/update-cart',
    type: 'GET',
    dataType: 'html',
    data: {pid: $(this).data('id'), op: $(this).data('op')},
    success: function (res) {
      location.reload();
    }
  });
});
$('.subfile').on('change', function () {
  if ($(this).get(0).files.length != 0) {
    $('#btn-file').text('file chosen');
  }
});
$('.article').summernote({
  height: 300,
  callbacks: {
    onImageUpload: function (image) {
      var temp = 0;
      var sizeKB = image[0]['size'] / 1000;
      if (sizeKB > 200) {
        alert("Please select less than 200kb image");
        temp = 1;
      }
      if (temp == 0) {
        var file = image[0];

        var reader = new FileReader();

        reader.onloadend = function () {

          var image = $('<img>').attr('src', reader.result);

          $('.article').summernote("insertNode", image[0]);

        }

        reader.readAsDataURL(file);

      }
    }
  }
});

$('.stock_up').on('click', function () {
  if ($.isNumeric($(this).data('id')) && $(this).data('id').length != 0) {
    $.ajax({
      url: BASE_URL + 'cms/stock/update',
      type: 'GET',
      dataType: 'html',
      data: {pid: $(this).data('id'), op: $(this).data('op')},
      success: function (res) {
        location.reload();
      }
    });
  }
});

$('#fpost').on('input',function(){
  var input = $(this);
  var is_filled = input.val();
  if(is_filled){
    input.removeClass("invalid").addClass("valid");
  }
  else{
    input.removeClass("valid").addClass("invalid");
  }
});

$('#fidpost').on('click',(event)=>{
    
  var error_free = false;
    if(!$('#fpost').val()){
      $('#errposr').addClass('error').text('*feedback must be filled ');
    }
    else{
      $('#errposr').removeClass('error');
      error_free = true;
    }
  
  if(!error_free){
    event.preventDefault();
  }
});


