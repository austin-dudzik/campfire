$("[contenteditable=true]").keypress((e) => {
    return e.which !== 13;
});

function update(jscolor) {
    $(".accentApply, .lw-active").css("background", "#" + jscolor);
}

$("#titleFiller").on("keyup", function () {
    $('#titleTextarea').val($(this).text());
});

$("#subtitleFiller").on("keyup", function () {
    $('#subtitleTextarea').val($(this).text());
});

$("#tyTitleFiller").on("keyup", function () {
    $('#tyTitleTextarea').val($(this).text());
});

$("#tySubtitleFiller").on("keyup", function () {
    $('#tySubtitleTextarea').val($(this).text());
});

$("#emojiToggle").on("change", () => {
    $("#emojiContainer").toggle();
});

$("#buttonDefault").addClass("btn-dark text-white");
$("#thank-you").hide();

$("#buttonDefault").on("click", () => {
    $("#default").show();
    $("#thank-you").hide();
    $("#buttonDefault").addClass("btn-dark text-white");
    $("#buttonThankyou").removeClass("btn-dark text-white");
});

$("#buttonThankyou").on("click", () => {
    $("#default").hide();
    $("#thank-you").show();
    $("#buttonThankyou").addClass("btn-dark text-white");
    $("#buttonDefault").removeClass("btn-dark text-white");
});

    $("#editorForm").on("submit", (e) => {

        e.preventDefault();

        $.ajax({
            url: "../../../functions/pages/editor.php",
            method: "POST",
            data: $('form').serialize(),
            success: () => {
                $("#saveBtn").removeClass("btn-loading disabled");

                $("#response").html('<div id="alertSlide" class="alert bg-success text-white text-center rounded-0"><i class="far fa-check mr-3"></i> Success, your changes have been saved.</div>')

                $("#alertSlide").fadeTo(2000, 500).slideUp(500, () => {
                    $("#alertSlide").slideUp(500);
                });
            },
            fail: (jqXHR, textStatus, errorThrown) => {
                console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                );
            }
        })

    });