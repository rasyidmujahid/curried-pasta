jQuery(document).ready(function() {

    jQuery("#doc_param").submit(function(event) {
        event.preventDefault();
        var url = 'https://script.google.com/macros/s/AKfycbw6in0T7QsKHxJxgc5XJxNAy2XzHMGzfzfJBbatMDI/dev?method=create&';
        url += jQuery(this).serialize();
        console.log("URL : " + url);

        css_load(true);

        jQuery("#curry-button-submit").addClass("pure-button-disabled");
        jQuery("#curry-button-submit").attr('disabled', 'disabled');

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
                alert("Success");
                console.log("success : ");
                console.log(json);

                jQuery("#curry-embedded-doc").src = json.embed + "?embedded=true";

                var ahref_pdf = '<a id="curry-link-pdf" href="' + json.pdf + '" class="pure-button">PDF</a>';
                var button_cetak_pdf = '<a id="curry-button-cetak" class="pure-button" onclick="cetak()">Cetak</a>';
                jQuery("#curry-button").append(ahref_pdf);
                jQuery("#curry-button").append(button_cetak_pdf);

                jQuery("#curry-button-cetak").click(function() {
                    alert("cetak");
                    jQuery("#curry-embedded-doc").focus();
                    jQuery("#curry-embedded-doc").contentWindow.print();
                });

                jQuery("#curry-button-submit").removeClass("pure-button-disabled");
                jQuery("#curry-button-submit").removeAttr('disabled');
                css_load(false);
            },
            error: function() {
                alert("Error");
                jQuery("#curry-button-submit").removeClass("pure-button-disabled");
                jQuery("#curry-button-submit").removeAttr('disabled');
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

    function print_pdf(argument) {
        var pdf = new PdfUtil(PDF_URL);
        pdf.display(document.getElementById('placeholder'));

        document.getElementById('printBtn').onclick = function() {
            pdf.print();
        }
    }

    function PdfUtil(url) {

        var iframe;

        var __construct = function(url) {
            iframe = getContentIframe(url);
        }

        var getContentIframe = function(url) {
            var iframe = document.createElement('iframe');
            iframe.src = url;
            return iframe;
        }

        this.display = function(parentDomElement) {
            parentDomElement.appendChild(iframe);
        }

        this.print = function() {
            try {
                iframe.contentWindow.print();
            } catch (e) {
                throw new Error("Printing failed.");
            }
        }

        __construct(url);
    }

});