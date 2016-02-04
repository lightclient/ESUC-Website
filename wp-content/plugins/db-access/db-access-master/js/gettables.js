/*Get the names of each table in db; populate a dropdown. Get the selected table's 
data. Use it to render an HTML table; with pagination, sortable, highlightable,
filterable, printable, exportable, and with ability to remove one or more
columns (from the HTML table not the mySQL table).
Optional feature: Modify the contents of a cell and save the change to the database.
*/
jQuery(function(){
	
	//setup filter on tablesorter to use regexp '^'	
	jQuery.tablesorter.filter.types.start = function( filter, iFilter, exact, iExact ) {
  if ( /^\^/.test( iFilter ) ) {
    return iExact.indexOf( iFilter.substring(1) ) === 0;
  }
  return null;
};

// search for a match at the end of a string
// "a$" matches "Llama" but not "aardvark"
jQuery.tablesorter.filter.types.end = function( filter, iFilter, exact, iExact ) {
  if ( /\$$/.test( iFilter ) ) {
    var fl = iFilter.length - 1,
      f = iFilter.substring(0, fl),
      el = iExact.length;
    return iExact.lastIndexOf(f) + fl === el;
  }
  return null;
};

//dbaSettings = settings sent from the server; contains plugin directory path, file name for export
//file and the widgets selected by the user to be active - these go in widgetArr to be passed as
//arguments to tablesorter 

var plugindir = dbaSettings.plugindir; 
//set the plugindir and export_file to null; prevents pushing them to widgetArr
dbaSettings.plugindir = '';
var exportFile = dbaSettings.export_file;
dbaSettings.export_file = '';
 
 //widgetArr holds the names of widgets selected by the user in the stettings page to be active
	var widgetArr = [];	
		jQuery.each( dbaSettings, function(key, value){			
		if ( value ) widgetArr.push(key);				
		} );
					  
	//PHP script uses SHOW TABLES to get the names of each of the tables in the database
	var dataObj = { 'action' : 'tables_action' };
	jQuery.getJSON( ajaxurl, dataObj , function( data ) {		
	var items = ['<option value="">&mdash; Choose a Table &mdash;</option>'];	
	for( var i in data )//get each key/value pair (object) out of the JSON object passed from the server
    {	
  jQuery.each( data[i], function( key, value ) {
    items.push( "'<option class='" + key + "'>" + value + "</option>" );
  });
	}//for loop
	 jQuery( '<select/>', {
    'class': 'tables',
    html: items.join( '' )
  }).appendTo( 'div.wrap' );
  
  //get the selected database table and display the rows in an HTML table 
  //but first remove old table and widget elements 
    jQuery( ' select.tables ' ).on( 'change', function(e){	  
	  jQuery('table').remove();
	  jQuery('.prntBtn').remove();
	  jQuery( 'div #pager' ).remove();
	  jQuery('.exportBtn').remove();
	  jQuery( 'div.columnSelectorWrapper' ).remove();
	  
	  var csLabel = dbaSettings.columnSelector ? 'Column Selector' : '';	  
	  jQuery( 'div.wrap' )
	  .append( '<div class="columnSelectorWrapper"><label class="columnSelectorButton" for="colSelect1"></label><div id="columnSelector" class="columnSelector"></div></div>' );
	  jQuery( '.columnSelectorButton' ).html( csLabel );
		  	  
	  var selected = { 'action' : 'showtables_action', 
	  'tablename' : e.target.value };
	jQuery.getJSON( ajaxurl, selected, function( data ) {		
	var txt = '<thead>';	
	txt += '<tr>';	
	jQuery.each( data[0], function( key, value ){
		txt += '<th>' + key + '</th>';		
		});
		txt += '</tr>';
		txt += '</thead>';				
	for( var i in data )//get each key/value pair (object) out of the JSON object passed from the server and create a td
    {
	var items = [];
  jQuery.each( data[i], function( key, value ) {	  	  	
    items.push( '<td><textarea>'  + value + '</textarea></td>' );//ie disallows editing of cells, wrap the value in a <textarea> inside the <td>	
	      });
    txt += '<tr>' + items.join( '' ) + '</tr>'; 
	}//for loop		
			
	jQuery( '<table/>' )
	.html( txt )
	.addClass( 'widefat tablesorter tbl' )
	.attr( 'id', 'myTable' )
	.appendTo( 'div.wrap' )
	.tablesorter(   { widgets: widgetArr, widgetOptions : {
      // target the column selector markup
      columnSelector_container : jQuery( '#columnSelector' ),
      // column status, true = display, false = hide
      // disable = do not display on list
//     columnSelector_columns : {
//       0: 'disable' /* set to disabled; not allowed to unselect it */
//	},
      // remember selected columns (requires $.tablesorter.storage)
      columnSelector_saveColumns: true,
      // container layout
      columnSelector_layout : '<label><input type="checkbox">{name}</label>',
      // data attribute containing column name to use in the selector container
      columnSelector_name  : 'data-selector-name',
      /* Responsive Media Query settings */
      // enable/disable mediaquery breakpoints
      columnSelector_mediaquery: true,
      // toggle checkbox name
      columnSelector_mediaqueryName: 'All ',
      // breakpoints checkbox initial setting
      columnSelector_mediaqueryState: true,
      // responsive table hides columns with priority 1-6 at these breakpoints
      // see http://view.jquerymobile.com/1.3.2/dist/demos/widgets/table-column-toggle/#Applyingapresetbreakpoint
      // *** set to false to disable ***
      columnSelector_breakpoints : [ '20em', '30em', '40em', '50em', '60em', '70em' ],
      // data attribute containing column priority
      // duplicates how jQuery mobile uses priorities:
      // http://view.jquerymobile.com/1.3.2/dist/demos/widgets/table-column-toggle/
      columnSelector_priority : 'data-priority',
	  output_delivery : 'd',  //download
	  output_saveFileName : exportFile || 'myTable.csv',
	  editable_autoAccept : false,
	  editable_columns : (function (){ //an iife, tablesorter expects an expression not a function
	 var colArr = [];	  
	  jQuery( 'th' ).each( function( index ){		 
		   colArr.push( index );		   
		  });
		  
		  //don't allow edit of 1st column - preserve the primary key/id
		  colArr.shift();
		  		   return colArr;	   
	  }()),	  
	  	  
	  //this is just a hook into the editable widget so we can take the new content of the cell
	  //and get its 1st sybling as the key to the sql data row	  
	  editable_validate : function( text, orig, $this ){
		  	  $this = $this.parent();     //since we wrapped textareas into each cell to appease ie,		   
		  							 	 //we need to get the parent (td)
			var data = { 'action' : 'update_cell_action',			  
			  table : selected.tablename,
			  keyname : jQuery( 'th' ).eq(0).text(),
			  key : $this.siblings().eq( 0 ).text(),
			  col : jQuery('th').eq( $this.index()).text(),
			  text : text
			  };			  
			  jQuery.post( ajaxurl, data,
			  
			  //dialog popup to inform user of success. But only for 5 seconds.
			  function(){				  
				  jQuery( '<div/>', { 'id' : 'inptTxt' } ).text( 'The text has been added to the database' )
				  .dialog( { height: 70 } );
				  var timeout = setTimeout(function() {
     			  jQuery( '#inptTxt' ).dialog( 'close' );
				  }, 5000);
				  }			  
			   );
			   jQuery( 'div#inptTxt' ).remove();
			  return (text);
		  }
    }//end editable_validate	
	 });//end object passed to tablesorter	 
	 
	/*The table is now loaded and has sortability*/
	
if (dbaSettings.print)
{
	jQuery( 'div.columnSelectorWrapper' ).append( '<input type="button" class="prntBtn" value="Print">' );	
	 jQuery('.prntBtn').on('click', function(){	  
	  jQuery('#myTable').trigger(jQuery.tablesorter.printTable.event);
	   });
}
	
	if ( dbaSettings.crosshairs ){
	jQuery( '.tbl' ).crosshairs();	}
	
	
if (dbaSettings.pagination)
{
	jQuery( '.wrap' ).append( '<div id="pager" class="pager"></div>' );	
	jQuery( '<img/>', { 'class' : 'first', 'src' : plugindir + '/includes/tablesorter/addons/pager/icons/first.png' } )
	.appendTo( 'div.pager' );
	jQuery( '<img/>', { 'class' : 'prev', 'src' : plugindir + '/includes/tablesorter/addons/pager/icons/prev.png' } )
	.appendTo( 'div.pager' );	
	jQuery( '<span/>', { 'class' : 'pagedisplay' } )
	.appendTo( 'div.pager' );	
	jQuery( '<img/>', { 'class' : 'next', 'src' : plugindir + '/includes/tablesorter/addons/pager/icons/next.png' } )
	.appendTo( 'div.pager' );
	jQuery( '<img/>', { 'class' : 'last', 'src' : plugindir + '/includes/tablesorter/addons/pager/icons/last.png' } )
	.appendTo( 'div.pager' );
		
	var sels = []; //options for the page length dropdown
	for ( var i = 1; i < 5; i++ )
	{
		sels.push( "'<option value='" + i*10 +"' >" + i*10 + "</option>" );
		}	
		 jQuery( '<select/>', {
    'class': 'pagesize',
    html: sels.join( '' )
  }).appendTo( 'div.pager' );	
	        //setup pagination here
	jQuery( '#myTable' ).tablesorterPager({ container: jQuery(".pager")});
	/*End of pagination	*/
}
	
	jQuery( 'div.columnSelectorWrapper' ).append( '<input type="button" class="exportBtn" value="Export">' );
	jQuery('.exportBtn').on('click', function(){	  
	jQuery( '#myTable' ).trigger( 'outputTable' );  
	   });				
	jQuery( '[value=""]', e.target ).remove(); //remove option with "Choose a Table" from the dropdown
				}); 		
		});  
	});//success callback
});