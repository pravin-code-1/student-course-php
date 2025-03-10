$(document).ready(function (){
  // Show the popup when the button is clicked
  $(document).on('click','.popup-trigger', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
      type: 'GET',
      url: '/Student/controller/Controller.php',
      data: { id: id },
      dataType: 'json',
      success: function(data) {
        $('#showModal').modal('show'); 
        $('#coursename').text(data.name);
        $('#coursediscri').text(data.discription);
      }
    });
  });

  // Close the popup when the close button is clicked
  $('#close-popup').on('click', function() {
    $('#popup-box').fadeOut();
  });
});