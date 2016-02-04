(function($) {
    $.fn.crosshairs = function(options) {
        // Set default settings
        var settings = $.extend({
            rowClass: "rowHighlight",
            columnClass: "columnHighlight"
        }, options);
		

        // Loop over each table passed in
        return this.each(function() {
             $(this).find('td').bind('mouseover mouseleave', function (e) {
				    var index = this.cellIndex;					    
				
				    if (e.type == "mouseover") {
				        $(this).parent().addClass(settings.rowClass);
				        $(this).parents('table').find('tr').each(function () {
				            $(this).find('td').eq(index).addClass(settings.columnClass);
				        });
				    } else {
				        $(this).parent().removeClass(settings.rowClass);
				        $(this).parents('table').find('tr').each(function () {
				            $(this).find('td').eq(index).removeClass(settings.columnClass);
				        });
				    }
				});
        });
    };
}(jQuery));
