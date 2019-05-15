
// https://datatables.net/examples/api/row_details.html

/* formatting function for row details - modify as you need */
function format () {
    return '<p>test</p>';
}
 
$( document ).ready( function () {
    var table = $('#table_id').DataTable( {
    	"columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "username" },
            { "data": "tools" }
        ],
        "order": [[ 1, "asc" ]],
    	"paging": false,
        "stateSave": false, // status der Tabelle bei neuladen speichern
        "info": false // paging Informationen ausblenden
    } );
     
    // add event listener for opening and closing details
    $( '#table_id tbody' ).on( 'click', 'td.details-control', function () {
        var tr = $( this ).closest( 'tr' );
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // this row is already open - close it
            row.child.hide();
            tr.removeClass( 'shown' );
        }
        else {
            // open this row
            row.child( format() ).show();
            tr.addClass( 'shown' );
        }
    } );
} );
