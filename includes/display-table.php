<?php
function generate_table(){
  $response = wp_remote_get( 'https://api.covid19india.org/state_district_wise.json' );

  $data = wp_remote_retrieve_body( $response );
  
  $districtData = json_decode($data)->Karnataka->districtData;
  
  
  $get_data = wp_remote_get( 'https://api.covid19india.org/data.json' );
  $statewise_data =  wp_remote_retrieve_body( $get_data );
  $statewise = json_decode($statewise_data)->statewise;
  $karnataka_state_object = array();
  $district_rows = "";
  
  // Retrive data for karnataka
  for($i=0; $i<sizeof($statewise); $i++)
  {
    if($statewise[$i]->statecode == "KA")
    {
      $karnataka_state_object = $statewise[$i];
    }
  }
  
  foreach ($districtData as $key => $value) {
    $district_rows .= '<tr>
        <td>'.$key.'</td>
        <td data-number>'.number_format($value->confirmed).'</td>
        <td data-number>'.number_format($value->active).'</td>
        <td data-number>'.number_format($value->recovered).'</td>
        <td data-number>'.number_format($value->deceased).'</td>
    </tr>';
  }


  // print_r($karnataka_state_object);
  $body = [
    "query" => '{country(name: "India") {active recovered deaths updated }}',
    "variables" =>	array(),
    "operationName" =>	null
  ];
  
  
  
  $options = [
    'body' => wp_json_encode($body),
    'headers' => [
      'Content-Type' => 'application/json',
    ]
  ];
  $country_data = wp_remote_post( "https://covidstat.info/graphql",$options);
  $country_response = wp_remote_retrieve_body( $country_data);
  $country = json_decode($country_response)->data->country;
  $updated_date = date("F j, Y [h:i a]", substr($country->updated, 0, 10));
 
  return '<div class="aggregate-stat">
            <div class="table-wrapper">
              <table class="aggregate-table" id="aggregate-table">
                <thead>
                  <tr>
                    <th> </th>
                    <th>Total Confirmed Cases</th>
                    <th>Active Cases</th>
                    <th>Total Recovered</th>
                    <th>Total Death</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="title">India</td>
                    <td data-number>'.number_format(($country->active + $country->recovered + $country->deaths)).'</td>
                    <td data-number>'.number_format($country->active).'</td>
                    <td data-number>'.number_format($country->recovered).'</td>
                    <td data-number>'.number_format($country->deaths).'</td>
                  </tr>
                  <tr>
                    <td class="title">'.$karnataka_state_object->state.'</td>
                    <td data-number>'.number_format($karnataka_state_object->confirmed).'</td>
                    <td data-number>'.number_format($karnataka_state_object->active).'</td>
                    <td data-number>'.number_format($karnataka_state_object->recovered).'</td>
                    <td data-number>'.number_format($karnataka_state_object->deaths).'</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <h2>District-Wise COVID-19 Cases In Karnataka</h2>
          <div class="table-wrapper">
            <table id="info-table">
              <thead>
                <tr>
                    <th>District</th>
                    <th>Total Confirmed Cases</th>
                    <th>Active Cases</th>
                    <th>Total Recovered</th>
                    <th>Total Death</th>
                </tr>
              </thead>
              <tbody>'
                .$district_rows.
              '</tbody>
            </table>
          </div>
          
          <p class="update-info">Updated: '.$updated_date.'. Source: <a href="https://api.covid19india.org" target="_blank">India Data</a>, <a href="https://api.covid19india.org" target="_blank" >Karnataka District Data</a></p>
          ';
}
