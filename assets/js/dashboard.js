function loaderInit() {
$('#loadSwitchDiv').removeClass('bg-camp').addClass('bg-secondary text-white');
$('#loadSwitch').removeClass('fe fe-layout').addClass('far fa-spinner-third fa-spin');
}

$("#alertSlide").fadeTo(2000, 500).slideUp(500, function(){
$(this).slideUp(500);
});

$("#alertSlideSlow").fadeTo(2000, 1000).slideUp(1000, function(){
$(this).slideUp(1000);
});

$("#copy-to-clipboard").on("click", function(){
$(this).html('<i class="fe fe-check mr-2"></i> Copied to clipboard!');
setTimeout(function(){ $(this).html('<i class="fe fe-copy mr-2"></i> Copy Code'); }, 2000);
});

$("#copy-page-clipboard").on("click", function(){
$(this).html('<i class="fe fe-check mr-2"></i> Copied!');
setTimeout(function(){ $(this).html('<i class="fe fe-copy mr-2"></i> Copy URL'); }, 2000);
});

if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}

let clipboard = new Clipboard('.copy-to-clipboard, .copy-page-clipboard');

$("form").submit('click', function () {
    let submit = $(this).find('[type="submit"]');
    if(!$(submit).hasClass('btn-loading')) {
        $(submit).addClass('btn-loading');
        $(submit).addClass('disabled');
    }
});
