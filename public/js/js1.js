var $popClose = $(".closebtn");
var $popOverlay = $(".popup-overlay");
var $popWindow = $(".popWindow");

$('#modal_1').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })


$('#modal_2').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })
  
  // Close Pop-Up after clicking on the button "Close"
  $popClose.on("click", function() {
    $popOverlay.fadeOut();
    $popWindow.fadeOut();
  });
 
