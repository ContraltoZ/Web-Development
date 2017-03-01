$(document).ready(function () {

    $('#img').hover(function () {
        $(this).stop().animate({ width: "330px" , height: "170px" });
    }, function () {
        $(this).stop().animate({ width: "280px" , height: "150px" });
    });

    $('#img2').hover(function () {
        $(this).stop().animate({ width: "330px", height: "170px" });
    }, function () {
        $(this).stop().animate({ width: "280px", height: "150px" });
    });


    $('#pbtn').click(function () {
        if ($(this).html()=="more")
        {
            $(this).html("up");
            $('#p2').stop().animate({ height: "150px" },400);
            $('#p2').append("<span>A key component in all of our campaigns is to give our oceans the best chance of resilience against climate change impacts. If we can keep our oceans in the healthiest and most natural state, without pressures from overfishing and pollution, then they will have increased ability to cope with these changes.<br />As part of this focus, we work to improve water quality and reduce pollution and marine debris, which entangles, chokes and smothers our marine life and habitats.<br />If you want to help ensure Australia's coasts and oceans remain healthy and free for tomorrow's generations, join us today.</span>")
        }
        else
        {
            $('#p2').stop().animate({ height: "0px" });
            $('#p2').html("");
            $(this).html("more");
        }
    });
});