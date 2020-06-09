(function( $ ) {
	'use strict';
	
	jQuery(document).ready(function(){
		var infoTable = jQuery("#info-table");
		if(infoTable)
		{
			var allNumbers = infoTable.find("[data-number]");
			allNumbers.each((index,element) => {
				var newNumber = Number(element.innerText).toLocaleString('en-IN');
				element.innerText = newNumber;
			});
		}

		var aggregateTable = jQuery("#aggregate-table");
		if(aggregateTable)
		{
			var allNumbers = aggregateTable.find("[data-number]");
			allNumbers.each((index,element) => {
				var newNumber = Number(element.innerText).toLocaleString('en-IN');
				element.innerText = newNumber;
			});
		}
	})
	

})( jQuery );


// Number(data).toLocaleString('en-IN')