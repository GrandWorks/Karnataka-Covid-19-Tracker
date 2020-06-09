jQuery(document).ready(function(){
	if(jQuery("#info-table"))
	{
		jQuery('#info-table').DataTable({
			ordering: true,
			paging: false,
			searching:false,
			info:false,
			"scrollX": true,
			"columns": [
				{ "data": "District" },
				{ "data": "Total Confirmed Cases", render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				}},
				{ "data": "Active Cases",render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				} },
				{ "data": "Total Recovered", render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				} },
				{ "data": "Total Death", render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				} },
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
			// "scrollX": true,
			"columns": [
				{ "data": " " },
				{ "data": "Total Confirmed Cases",render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				} },
				{ "data": "Active Cases",render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				} },
				{ "data": "Total Recovered",render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				} },
				{ "data": "Total Death", render: function(data,type,row){
					return Number(data).toLocaleString('en-IN');
				} },
			]
		});
	}
	
})