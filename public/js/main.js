
function showCities(value) {
    $.get( "http://localhost:8000/cities?country="+value, function( data ) {
        $( "#cities" ).html( data );
    });
}
function showUniversities(value) {
    $.get( "http://localhost:8000/universities?city="+value, function( data ) {
        $( "#universities" ).html( data );
    });
}

$(document).ready(function(){
    $(".newProcessButton").click(function(){
        $(".dashboardButtons").slideUp("slow");
        $(".backButton").slideDown("slow");
        $("#newProcess").slideDown("slow");
    });
    $(".backButton").click(function(){
        $(".backButton").slideUp("slow");
        $("#newProcess").slideUp("slow");
        $(".dashboardButtons").slideDown("slow");
    });


    $("#editDestinationButton").click(function(){
        $("#editDestinationOptions").slideToggle("slow");
    });
    $("#uploadButton").click(function(){
        $("#uploadOptions").slideToggle("slow");
    });
    $("#downloadButton").click(function(){
        $("#downloadOptions").slideToggle("slow");
    });




    $("p").hover(function(){
        $(this).css("background-color", "yellow");
    }, function(){
        $(this).css("background-color", "pink");
    });
});