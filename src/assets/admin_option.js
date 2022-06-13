"use strict";
jQuery(document).ready(function( $ ){
    $( '#add-recipientEmail' ).on('click', function() {
        var row = $( '.empty-row-recipientEmail.screen-reader-text' ).clone(true);
        row.removeClass( 'empty-row-recipientEmail screen-reader-text' );
        row.insertBefore( '#repeatable-recipientEmail tbody>tr:last' );
        return false;
    });

    $( '.remove-recipientEmail' ).on('click', function() {
        console.log($(this).parents('tr')[0]);
        $(this).parents('tr')[0].remove();
        return false;
    });

});