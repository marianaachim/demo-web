/*
For a full tutorial, including WordPress related code, please visit: http://www.jeremyroelfs.com/smooth-scroll-for-wordpress/

Load jQuery within the context of WordPress. 
Note: This will works the same as a normal js script.
Original Code by CSS Tricks: https://css-tricks.com/snippets/jquery/smooth-scrolling/ 
*/

$(document).ready(function ($) {

    $('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});


$(function () {
    $.scrollify({
        section: ".panel",
        easing: "easeInBack",
        scrollSpeed: 1000,
        scrollbars: false,
        sectionName: false,
        setHeights: false,
        setHeights: true,
        overflowScroll: true,
        touchScroll: true,

        before: function (i) {
            var active = $(".panel.active");

            active.addClass("remove");


            //setTimeout(function() {
            $("[data-panel=" + i + "]").addClass("active");
            active.removeClass("remove active");
            //},300);

        },

        // before: function (i, panels) {
        //     var ref = panels[i].attr("data-section-name");

        //     $(".pagination a.active").removeClass("active");

        //     $(".pagination a[href=#" + ref + "]").addClass("active");

        //     /*
        // if(ref==="features") {
        //   $(".features .gallery0,.features .gallery1,.features .gallery2").addClass("moved");

        // }*/

        //     panels[i].find(".gallery0,.gallery1,.gallery2").addClass("moved");


        //     if (ref === "design") {
        //         $(".features").find(".gallery0,.gallery1,.gallery2").removeClass("moved");
        //         $(".ios7 .gallery0").css("top", 0);
        //     }
        //     if (ref === "features") {
        //         $(".ios7 .content").removeClass("moved");
        //         initialPosition();
        //     }
        //     if (ref === "ios7") {
        //         $(".ios7 .content").addClass("moved");

        //         $(".ios7 .gallery0").css("top", 0);
        //     }
        // },
        // after: function (i, panels) {
        //     var ref = panels[i].attr("data-section-name");

        //     if (ref === "home") {
        //         $(".design").find(".gallery0,.gallery1,.gallery2").removeClass("moved");
        //     }
        //     for (var j = 0; j < panels.length; j++) {
        //         if (j > i) {

        //             //panels[j].find(".moved").removeClass("moved");
        //         }
        //     }
        // },
        // afterResize: initialPosition,
        // afterRender: initialPosition
    });



    // function initialPosition() {

    //     var current = $.scrollify.current();

    //     if (current.hasClass("ios7") === false) {
    //         var height = parseInt($(".ios7").height());
    //         var f = parseInt($(".features .gallery1").height()) - 50;

    //         var top = 0 - (height * 0.4) - (height - f);
    //         $(".ios7 .gallery0").css("top", top);
    //     } else {
    //         $(".features").find(".gallery0,.gallery1,.gallery2").addClass("moved");
    //     }

    // }
});