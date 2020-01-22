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

$(document).ready(function(){
    $(document).on('click', '.edit_data', function() {
        var id_druzyna = $(this).attr("id");
        var url_bezp = $(this).attr("url");
        var url = url_bezp;
        //alert(url_bezp);
        $.when(
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response){
                    res=response;
                    success=true;
                },
                error:function(){
                    //handle error
                },
            })).then(function(){
                if(success){
                    $("#myModal").html(res).modal("show");
                }
        });
    });
});
