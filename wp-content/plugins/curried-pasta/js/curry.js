jQuery(document).ready(function() {

    jQuery("#doc_param").submit(function(event) {
        event.preventDefault();
        var url = 'https://script.google.com/macros/s/AKfycbw6in0T7QsKHxJxgc5XJxNAy2XzHMGzfzfJBbatMDI/dev?method=create&';
        url += jQuery(this).serialize();
        console.log("URL : " + url);
        var settings = {
            url: url,
            dataType: "jsonp",
            success: function(json) {
                alert("Success");
                console.log("success : ");
                for (key in json) {
                    console.log(key + ' : ' + json[key]);
                }
            },
            error: function() {
                alert("Error");
            }
        };
        jQuery.ajax(settings);
    });

});