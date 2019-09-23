jQuery(function($) {
    $(".clickable-row").css("cursor","pointer").click(function() {
        window.location = $(this).data("href");
    });
});
