<?php

function cmp($a, $b) {
    return strcmp($a->state, $b->state);
}

function india_table($attribute=[])
{
    $get_data = wp_remote_get( 'https://api.covid19india.org/data.json',array(
        'timeout' => 120,
    ) );
    $data_array = wp_remote_retrieve_body( $get_data );
    $data = json_decode($data_array)->statewise;
    
    $updated_date = $data[0]->lastupdatedtime;
    $date = DateTime::createFromFormat('d/m/Y H:i:s',$updated_date);

    $language="english";
    $is_top_20 = false;

    if(!empty($attribute))
    {
        if($attribute["show_top_20"]=="true")
        {
            $is_top_20 = true;
        }
    }

    if($is_top_20==false)
    {
        usort($data, "cmp");
    }


    $coulmns = array(
        array("english"=>"State", "kannada"=>""),
        array("english"=>"Total Confirmed Cases", "kannada"=>""),
        array("english"=>"Active Cases", "kannada"=>""),
        array("english"=>"Total Recovered", "kannada"=>""),
        array("english"=>"Total Death", "kannada"=>""),
    );

    $generated_columns = "";

    for($i=0; $i<sizeof($coulmns); $i++)
    {
        $generated_columns = $generated_columns . '<th>' .$coulmns[$i][$language]. '</th>';
    }

    $generated_row = "";
    $row_count=0;
    foreach ($data as $key => $value) {
        if($is_top_20 && $row_count==21)
        {
            break;
        }
        if($value->statecode !="TT")
        {
            if($value->statecode != "UN")
            {
                $generated_row .= '<tr>
                <td>'.$value->state.'</td>
                <td data-number>'.number_format($value->confirmed).'</td>
                <td data-number>'.number_format($value->active).'</td>
                <td data-number>'.number_format($value->recovered).'</td>
                <td data-number>'.number_format($value->deaths).'</td>
                </tr>';
            }
            
        }
        ++$row_count;
    }

    $table = '
    <div class="aggregate-stat">
        <div class="table-wrapper">
            <table class="info-table">
                <thead> 
                    <tr>
                '
                    .$generated_columns.
                '
                    </tr>
                </thead>
                <tbody>
                '
                .$generated_row.
                '
                </tbody>
            </table>
        </div>
    </div>
    <p class="update-info">Accessed on '.$date->format("Y-m-d").' from <a href="https://api.covid19india.org" target="_blank">https://api.covid19india.org</a></p>
    ';
    return $table;
}