$(document).ready(function(){
    $(".container").fadeIn(320);
    $("#form").slideDown();
});

$(document).ready(function(){
  $("#navbarDropdown").click(function(){
    $(".dropdown-menu").slideToggle(130);
    });
});

$(document).click(function() {
  $(".dropdown-menu").hide(); //click came from somewhere else
});

$(document).ready(function(){
    $(".alert").slideToggle(500).delay(3500).slideToggle(500);
});
