
function initAutocomplete(selector) {
    var site = "nccommons";

    // @ts-ignore
    $(selector).autocomplete({
        source: function (request, response) {
            // make AJAX request to Wikipedia API
            $.ajax({
                url: "https://" + site + ".org/w/api.php",
                dataType: "jsonp",
                headers: {
                    'Api-User-Agent': "NCC2Commons/1.0 (https://NCC2Commons.toolforge.org/; tools.NCC2Commons@toolforge.org)"
                },
                data: {
                    action: "query",
                    format: "json",
                    list: "allpages",
                    apfrom: request.term
                    // list: "prefixsearch",
                    // pssearch: request.term,
                    // psnamespace: 0,
                    // cirrusUseCompletionSuggester: "yes"
                },
                success: function (data) {
                    // extract titles from API response and pass to autocomplete
                    response($.map(data.query.allpages, function (item) {
                        return item.title;
                    }));
                }
            });
        }
    });
}
