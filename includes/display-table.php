<?php
function generate_table($attribute=[]){
  $translation_array = array (
    0 => 
    array (
      0 => 'Bagalkote',
      1 => 'ಬಾಗಲಕೋಟೆ',
    ),
    1 => 
    array (
      0 => 'Ballari',
      1 => 'ಬಳ್ಳಾರಿ',
    ),
    2 => 
    array (
      0 => 'Belagavi',
      1 => 'ಬೆಳಗಾವಿ',
    ),
    3 => 
    array (
      0 => 'Bengaluru Rural',
      1 => 'ಬೆಂಗಳೂರು ಗ್ರಾಮಾಂತರ',
    ),
    4 => 
    array (
      0 => 'Bengaluru Urban',
      1 => 'ಬೆಂಗಳೂರು ನಗರ',
    ),
    5 => 
    array (
      0 => 'Bidar',
      1 => 'ಬೀದರ್',
    ),
    6 => 
    array (
      0 => 'Chamarajanagara',
      1 => 'ಚಾಮರಾಜನಗರ',
    ),
    7 => 
    array (
      0 => 'Chikkaballapura',
      1 => 'ಚಿಕ್ಕಬಳ್ಳಾಪುರ',
    ),
    8 => 
    array (
      0 => 'Chikkamagaluru',
      1 => 'ಚಿಕ್ಕಮಗಳೂರು',
    ),
    9 => 
    array (
      0 => 'Chitradurga',
      1 => 'ಚಿತ್ರದುರ್ಗ',
    ),
    10 => 
    array (
      0 => 'Dakshina Kannada',
      1 => 'ದಕ್ಷಿಣ ಕನ್ನಡ',
    ),
    11 => 
    array (
      0 => 'Davanagere',
      1 => 'ದಾವಣಗೆರೆ',
    ),
    12 => 
    array (
      0 => 'Dharwad',
      1 => 'ಧಾರವಾಡ',
    ),
    13 => 
    array (
      0 => 'Gadag',
      1 => 'ಗದಗ',
    ),
    14 => 
    array (
      0 => 'Hassan',
      1 => 'ಹಾಸನ',
    ),
    15 => 
    array (
      0 => 'Haveri',
      1 => 'ಹಾವೇರಿ',
    ),
    16 => 
    array (
      0 => 'Kalaburagi',
      1 => 'ಕಲಬುರಗಿ',
    ),
    17 => 
    array (
      0 => 'Kodagu',
      1 => 'ಕೊಡಗು',
    ),
    18 => 
    array (
      0 => 'Kolar',
      1 => 'ಕೋಲಾರ',
    ),
    19 => 
    array (
      0 => 'Koppal',
      1 => 'ಕೊಪ್ಪಳ',
    ),
    20 => 
    array (
      0 => 'Mandya',
      1 => 'ಮಂಡ್ಯ',
    ),
    21 => 
    array (
      0 => 'Mysuru',
      1 => 'ಮೈಸೂರು',
    ),
    22 => 
    array (
      0 => 'Other State',
      1 => 'ಹೊರರಾಜ್ಯ',
    ),
    23 => 
    array (
      0 => 'Raichur',
      1 => 'ರಾಯಚೂರು',
    ),
    24 => 
    array (
      0 => 'Ramanagara',
      1 => 'ರಾಮನಗರ',
    ),
    25 => 
    array (
      0 => 'Shivamogga',
      1 => 'ಶಿವಮೊಗ್ಗ',
    ),
    26 => 
    array (
      0 => 'Tumakuru',
      1 => 'ತುಮಕೂರು',
    ),
    27 => 
    array (
      0 => 'Udupi',
      1 => 'ಉಡುಪಿ',
    ),
    28 => 
    array (
      0 => 'Uttara Kannada',
      1 => 'ಉತ್ತರ ಕನ್ನಡ',
    ),
    29 => 
    array (
      0 => 'Vijayapura',
      1 => 'ವಿಜಯಪುರ',
    ),
    30 => 
    array (
      0 => 'Yadgir',
      1 => 'ಯಾದಗಿರಿ',
    ),
  );


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

  if(!empty($attribute))
  {
    if($attribute["kannada"]=="true")
    {
      $districtCount = 0;
      foreach ($districtData as $key => $value)
      {
        for($i=0; $i<sizeof($translation_array); $i++)
        {
          if(strtolower($key) == strtolower($translation_array[$i][0]))
          {
            // $districtData[$key] = (object) ["kannada" => $translation_array[$i][1]];
            $districtData->$key->kannada = $translation_array[$i][1];
            
          }
        }
      }
    }
  }
  

  $other_state_row="";
  foreach ($districtData as $key => $value) {
    
    $title = "";
      if(!empty($attribute))
    {
      if($attribute["kannada"]=="true")
      { 
        $title = $districtData->$key->kannada;
      }
      else
      { 
        $title = $key; 
      }
    }
    else
    { 
      $title = $key; 
    }

    if($key == "Other State")
    {
      
      $other_state_row = '<tr>
        <td>'.$title.'</td>
        <td data-number>'.number_format($value->confirmed).'</td>
        <td data-number>'.number_format($value->active).'</td>
        <td data-number>'.number_format($value->recovered).'</td>
        <td data-number>'.number_format($value->deceased).'</td>
      </tr>';
    }
    else
    {
      $district_rows .= '<tr>
        <td>'.$title.'</td>
        <td data-number>'.number_format($value->confirmed).'</td>
        <td data-number>'.number_format($value->active).'</td>
        <td data-number>'.number_format($value->recovered).'</td>
        <td data-number>'.number_format($value->deceased).'</td>
      </tr>';
    }
    
  }

  $district_rows .= $other_state_row;


  // print_r($karnataka_state_object);
  $body = [
    "query" => '{country(name: "India") {active recovered deaths updated }}',
    "variables" =>	array(),
    "operationName" =>	null
  ];
  
  
  
  // $options = [
  //   'body' => wp_json_encode($body),
  //   'headers' => [
  //     'Content-Type' => 'application/json',
  //   ]
  // ];
  // $country_data = wp_remote_post( "https://covidstat.info/graphql",$options);
  // $country_data = wp_remote_get( "https://covid-19india-api.herokuapp.com/all");
  // $country_data = wp_remote_get( "https://disease.sh/v3/covid-19/all");
  // $country_response = wp_remote_retrieve_body( $country_data);
  $country = $statewise[0];
  // $country = $country[0];
  // die();
  $updated_date = $country->lastupdatedtime;
  $date = DateTime::createFromFormat('d/m/Y H:i:s',$updated_date);
  $india_title = "";
  $karnataka_title = "";
  $district = "";
  $total_confirmed_cases="";
  $active_cases = "";
  $recovered = "";
  $totl_death = "";
  $kannada_title = "";

  if(isset($attribute["kannada"]))
  {
    if($attribute["kannada"]=="true")
    { 
      $india_title = "ಇಂಡಿಯ";
      $karnataka="ಕರ್ನಾಟಕ";
      $karnataka_title = "ಕರ್ನಾಟಕದ ಜಿಲ್ಲಾವಾರು ಕೋವಿಡ್-19 ಪ್ರಕರಣಗಳು";
      $district = "ಜಿಲ್ಲೆ";
      $total_confirmed_cases="ಒಟ್ಟು ದೃಢಪಟ್ಟ ಪ್ರಕರಣಗಳು";
      $active_cases = "ಸಕ್ರಿಯ ಪ್ರಕರಣಗಳು";
      $recovered = "ಒಟ್ಟು ಗುಣಮುಖರಾದವರು";
      $total_death = "ಒಟ್ಟು ಸಾವು";
      $kannada_title = "ಕರ್ನಾಟಕದ ಜಿಲ್ಲಾವಾರು ಕೋವಿಡ್-19 ಪ್ರಕರಣಗಳು";
    }
  }
  else
  { 
    $india_title = "India";
    $karnataka = "Karnataka";
    $karnataka_title = "District-Wise COVID-19 Cases In Karnataka";
    $district = "District";
    $total_confirmed_cases="Total Confirmed Cases";
    $active_cases = "Active Cases";
    $recovered = "Total Recovered";
    $total_death = "Total Death";
  }
 
  return '<div class="aggregate-stat">
            <div class="table-wrapper">
              <table class="aggregate-table" id="aggregate-table">
                <thead>
                  <tr>
                    <th> </th>
                    <th>'.$total_confirmed_cases.'</th>
                    <th>'.$active_cases.'</th>
                    <th>'.$recovered.'</th>
                    <th>'.$total_death.'</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="title">'.$india_title.'</td>
                    <td data-number>'.number_format(($country->confirmed)).'</td>
                    <td data-number>'.number_format($country->active).'</td>
                    <td data-number>'.number_format($country->recovered).'</td>
                    <td data-number>'.number_format($country->deaths).'</td>
                  </tr>
                  <tr>
                    <td class="title">'.$karnataka.'</td>
                    <td data-number>'.number_format($karnataka_state_object->confirmed).'</td>
                    <td data-number>'.number_format($karnataka_state_object->active).'</td>
                    <td data-number>'.number_format($karnataka_state_object->recovered).'</td>
                    <td data-number>'.number_format($karnataka_state_object->deaths).'</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <h2>'.$karnataka_title.'</h2>
          <div class="table-wrapper">
            <table id="info-table">
              <thead>
                <tr>
                    <th>'.$district.'</th>
                    <th>'.$total_confirmed_cases.'</th>
                    <th>'.$active_cases.'</th>
                    <th>'.$recovered.'</th>
                    <th>'.$total_death.'</th>
                </tr>
              </thead>
              <tbody>'
                .$district_rows.
              '</tbody>
            </table>
          </div>
          
          <p class="update-info">Accessed on '.$date->format("Y-m-d").' from <a href="https://api.covid19india.org" target="_blank">https://api.covid19india.org</a></p>
          ';
}
