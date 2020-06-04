jQuery(document).ready(function(){
	if(jQuery("#info-table"))
	{
		jQuery('#info-table').DataTable({
			ordering: true,
			paging: false,
			searching:false,
			info:false,
			"columns": [
				{ "data": "District" },
				{ "data": "Total Confirmed Cases" },
				{ "data": "Active Cases" },
				{ "data": "Total Recovered" },
				{ "data": "Total Death" },
			]
		});
	}
	if(jQuery("#aggregate-table"))
	{
		jQuery('#aggregate-table').DataTable({
			ordering: false,
			searching:false,
			paging: false,
			info:false,
			"columns": [
				{ "data": "District" },
				{ "data": "Total Confirmed Cases" },
				{ "data": "Active Cases" },
				{ "data": "Total Recovered" },
				{ "data": "Total Death" },
			]
		});
	}
	
})