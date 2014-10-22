jQuery(document).ready(function($) {
    /* ===========================================================================
    Fade out update notification
    ============================================================================== */
    $('.fade').click(function (){
        $(this).fadeOut('slow');
    });

    /* ===========================================================================
	Delay fade in of form
	============================================================================== */
    $('form.form-options').delay(600).slideDown(900);

    /* ===========================================================================
	Assign .wps-panel-active class to the first section link and the first section content
	============================================================================== */
    $('#theme-options-panel-nav li a:first').addClass('active');
    $('#theme-options-panel-content .theme-options-panel-section:first').addClass('active').css('display', 'block');

    /* ===========================================================================
	Handle the section change when a section link is clicked
	============================================================================== */
    $('#theme-options-panel-nav li a').click(function(e) {

        /*  Prevent default behaviour
		============================================================================== */
        e.preventDefault();

        /*  Get the section id
		============================================================================== */
        var section_id = $(this).attr('href');

        /*  Active class control
		============================================================================== */
        $('#theme-options-panel-nav .active').removeClass('active');
        $(this).addClass('active');

        /*  Add .wps-panel-active class to the new section content and remove it from the previous one
		============================================================================== */
        $('#theme-options-panel-content .theme-options-panel-section' + section_id).siblings('.active').removeClass('active').fadeOut(600, function() {
            $('#theme-options-panel-content .theme-options-panel-section' + section_id).addClass('active').fadeIn(600);
        });
    });

    /*    Highlight label when input is focused
	============================================================================== */
    $(".form-options :input, .form-options textarea").focus(function() {
        $("label[for='" + this.id + "']").addClass("labelfocus");
    }).blur(function() {
        $("label").removeClass("labelfocus");
    });

    var custom_uploader;

    /*    Mobile dropdown nav
    ============================================================================== */
    $(".mobile-select").click(function () {
        $(".mobile-select").toggleClass("active");
        $("#theme-options-panel-nav ul").slideToggle();
    });

    /*	Enquire
    ============================================================================== */
    enquire.register("screen and (max-width: 600px)", function() {
        $('#theme-options-panel-nav li').click(function(d) {
	        $(".mobile-select").removeClass("active");
	        $("#theme-options-panel-nav ul").slideUp();
	    });
    }).register("screen and (min-width: 601px)", function() {
    	$('#theme-options-panel-nav li').unbind('click');
    	$("#theme-options-panel-nav ul").attr('style', '');
    })

    /*	Wordpress media uploader
    ============================================================================== */
    $("button#upload_image_button").click(function(e) {

        e.preventDefault();

        field = $(this).attr("class");
        fieldClass = $(this).prev("input").attr("class");

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $("input[class='" + fieldClass + "']").val(attachment.url);
        });

        //Open the uploader dialog
        custom_uploader.open();

    });

});
