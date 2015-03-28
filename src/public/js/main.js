/**
 * main.js
 *
 * JS interactions and event handlers for the main page
 *
 * @author Dylan Gleason, dgleason8384 -at- gmail -dot- com
 */

var $weebay = window.$weebay || {};

$(document).ready(function() {

    // read the selected value from the dropdown box and set the
    // search criteria
    $('.dropdown li > a').on('click', function(e) {
        e.preventDefault();
        var category = $(this).text();
        $('.dropdown .category').text(category);
    });

    // read the search keyword from the user input and call
    // searchListings
    $('.search .btn-success').on('click', function() {
        var search = $('.search input[type="text"]').val();
        var category = $('.dropdown .category').text();
        $weebay.searchListings(search, category);
    });

    // blur button presses on mouseup
    $('.btn').mouseup(function() {
        $(this).blur();
    });
});

$weebay.searchListings = function(search, category) {

    // make an ajax request to the search method and display all of
    // the search results that are returned
    $.ajax({
        type: 'POST',
        url: '/search',
        data: { search: search, category: category },
        success: function (html) {
            // append html to jumbotron and set event listener
            var container = $('.container .jumbotron');
            container.empty();
            container.append(html);
            $('.item-name a').on('click', function(e) {
                e.preventDefault();
                var listingId = $(this).closest('.list-item').attr('data-id');
                $weebay.displayListing(listingId);
            });
        }
    });
};

$weebay.displayListing = function(listingId) {

    // make an ajax request to get the requested listing data by
    // listingId
    $.ajax({
        type: 'GET',
        url: '/listing/' + listingId,
        success: function(html) {
            var container = $('.container .jumbotron');
            container.empty();
            container.append(html);
        }
    });
};
