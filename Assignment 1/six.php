<?php

if(isset($_POST["country"])){
    // Capture selected country
    $country = $_POST["country"];
     
    // Define country and city array
    $countryArr = array(
                    "usa" => array("New Yourk", "Los Angeles", "California", 'Florida', 'alaska'),
                    "india" => array('Ahemdabad', 'Vapi', "Mumbai", "New Delhi", "Bangalore"),
                    "uk" => array("London", "Manchester", "Liverpool, 'Southhampton", 'chelsea'),
                    'china' => array('Zhejiang', 'Guangdong', 'Henan', 'Hebei', 'Guizhou'),
                    'Australia' => array('Tasmania', 'Queensland', 'New South Wales', 'Victoria', 'Western Australia', 'South Australia')
                );
     
    // Display city dropdown based on country name
    if($country !== 'Select'){
        echo "<label>City:</label>";
        echo "<select>";
        foreach($countryArr[$country] as $value){
            echo "<option>". $value . "</option>";
        }
        echo "</select>";
    } 
}

?>