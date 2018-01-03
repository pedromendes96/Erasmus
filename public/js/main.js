function showCities(value) {
    $.get("http://localhost:8000/cities?country=" + value, function (data) {
        $("#cities").html(data);
    });
}

function showUniversities(value) {
    $.get("http://localhost:8000/radiouniversities?city=" + value, function (data) {
        alert("Message");
        $("#universities").html(data);
    });
}

$(document).ready(function () {
    $(".newProcessButton").click(function () {
        $(".dashboardButtons").slideUp("slow");
        $(".backButton").slideDown("slow");
        $("#newProcess").slideDown("slow");
    });
    $(".backButton").click(function () {
        $(".backButton").slideUp("slow");
        $("#newProcess").slideUp("slow");
        $(".dashboardButtons").slideDown("slow");
    });


    $("#editDestinationButton").click(function () {
        $("#editDestinationOptions").slideToggle("slow");
    });
    $("#uploadButton").click(function () {
        $("#uploadOptions").slideToggle("slow");
    });
    $("#downloadButton").click(function () {
        $("#downloadOptions").slideToggle("slow");
    });
    $("#approveResultButton").click(function () {
        $("#approveResultOptions").slideToggle("slow");
    });
    $("#approveResultNo").click(function () {
        $("#approveResultOptions").slideToggle("slow");
    });
    $("#approveResultYes").click(function () {
        $("#approveResultOptions").slideToggle("slow");
        $("#approvedResult").slideToggle("slow");
    });


    $('.fileEvent').hover(
        function () {
            $(this).css({"background-color": "pink"});
        },
        function () {
            $(this).css({"background-color": "white"});
        }
    );


});