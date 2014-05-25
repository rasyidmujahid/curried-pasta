jQuery(document).ready(function() {

    jQuery("#doc_param").submit(function(event) {
        event.preventDefault();
        var url = 'https://script.google.com/macros/s/AKfycbwwYoxBOohaKW36y8uX6YvdE7GpkaYJL3aICBAU_aP57PI1oiE/exec?method=create&';
        url += jQuery(this).serialize();
        // console.log("URL : " + url);

        css_load(true);

        // jQuery("#curry-button-submit").remove();
        jQuery("#curry-button-submit").addClass("pure-button-disabled");
        jQuery("#curry-button-submit").attr('disabled', 'disabled');
        jQuery("#curry-button-submit").text("Loading..");

        var download_link = jQuery("#curry-link-pdf");
        var cetak_button = jQuery("#curry-button-cetak");
        if (download_link.length > 0 || cetak_button.length > 0) {
            jQuery("#curry-link-pdf").remove();
            jQuery("#curry-button-cetak").remove();
        }

        var settings = {
            url: url,
            dataType: "jsonp",
            success: function(json) {
                console.log("success : ");
                console.log(json);

                var ahref_pdf = '<a id="curry-link-pdf" class="pure-button pure-button-primary">Download PDF</a>';
                // var button_cetak_pdf = '<a id="curry-button-cetak" class="pure-button pure-button-primary">Cetak</a>';
                jQuery("#curry-button").append(ahref_pdf);
                // jQuery("#curry-button").append(button_cetak_pdf);

                jQuery("#curry-link-pdf").click(function() {
                    window.open(json.pdf);
                });

                jQuery("#curry-button-cetak").click(function() {
                    jQuery("#curry-embedded-doc")[0].focus();
                    jQuery("#curry-embedded-doc")[0].contentWindow.print();

                    // var cetak_window = window.open(json.embed);
                });

                jQuery("#curry-button-submit").remove();
                // jQuery("#curry-button-submit").removeClass("pure-button-disabled");
                // jQuery("#curry-button-submit").removeAttr('disabled');
                css_load(false);
            },
            error: function() {
                alert("Error");
                jQuery("#curry-button-submit").remove();
                // jQuery("#curry-button-submit").removeClass("pure-button-disabled");
                // jQuery("#curry-button-submit").removeAttr('disabled');
                css_load(false);
            }
        };
        jQuery.ajax(settings);


    });

    function css_load(enabled) {
        var load =
            '<div id="facebookG">' +
            '<div id="blockG_1" class="facebook_blockG"></div>' +
            '<div id="blockG_2" class="facebook_blockG"></div>' +
            '<div id="blockG_3" class="facebook_blockG"></div>' +
            '</div>';
        if (enabled) {
            if (jQuery("#facebookG").length == 0) {
                jQuery("#curry-button").prepend(load);
            }
        } else {
            jQuery("#facebookG").remove();
        }
    }

    function cetak() {
        alert("cetak");
        jQuery("#curry-embedded-doc").focus();
        jQuery("#curry-embedded-doc").contentWindow.print();
    }

});