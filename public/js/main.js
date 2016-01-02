$(document).ready(function() { 
	"Use Strict";

    // The "Delete this Ad" button
    $(".deleter").click(function() {
        var adid = $(this).data("id");
        var adtitle = $(this).data("name");
        if (confirm("Are you sure you want to delete this ad: " + adtitle + "?")) {
            $("#delete-ad").val(adid);
            $("#addelete").submit();
        }
    });

    // The "Delete Profile" button
    $("#deleteprofile").click(function() {
        var profileid = $(this).data("id");
        var profilename = $(this).data("name");
        if (confirm("Are you sure you want to delete your profile, " +profilename + "?")) {
            $("#delete-id").val(profileid);
            $("#deletion").submit();
        }
    });

    $("#box").click(function() {
        $("#icon").animate({
            left: "+=50px"
        }, 200).animate({
            left: "-=100px"
        }, 200).animate({
            left: "+=50px"
        }, 200).animate({
            top: "-=50px"
        }, 200).animate({
            top: "+=130px"
        }, 200).animate({
            top: "-=80px"
        }, 200);
    });
    
    $('input[name=clickcategory]').change(function(){
        $('form').submit();
    });

    $('.fa-bars').click(function(){
        $('.secondarynav').slideToggle();
    });
    
});