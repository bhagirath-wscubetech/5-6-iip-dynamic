<?php

include "app/database.php";
include "app/helper.php";
$indianStates = [
    'AR' => 'Arunachal Pradesh',
    'AR' => 'Arunachal Pradesh',
    'AS' => 'Assam',
    'BR' => 'Bihar',
    'CT' => 'Chhattisgarh',
    'GA' => 'Goa',
    'GJ' => 'Gujarat',
    'HR' => 'Haryana',
    'HP' => 'Himachal Pradesh',
    'JK' => 'Jammu and Kashmir',
    'JH' => 'Jharkhand',
    'KA' => 'Karnataka',
    'KL' => 'Kerala',
    'MP' => 'Madhya Pradesh',
    'MH' => 'Maharashtra',
    'MN' => 'Manipur',
    'ML' => 'Meghalaya',
    'MZ' => 'Mizoram',
    'NL' => 'Nagaland',
    'OR' => 'Odisha',
    'PB' => 'Punjab',
    'RJ' => 'Rajasthan',
    'SK' => 'Sikkim',
    'TN' => 'Tamil Nadu',
    'TG' => 'Telangana',
    'TR' => 'Tripura',
    'UP' => 'Uttar Pradesh',
    'UT' => 'Uttarakhand',
    'WB' => 'West Bengal',
    'AN' => 'Andaman and Nicobar Islands',
    'CH' => 'Chandigarh',
    'DN' => 'Dadra and Nagar Haveli',
    'DD' => 'Daman and Diu',
    'LD' => 'Lakshadweep',
    'DL' => 'National Capital Territory of Delhi',
    'PY' => 'Puducherry'
];

foreach ($indianStates as $state) {
    try{
        $state = mysqli_escape_string($conn,$state);
        mysqli_query($conn, "INSERT INTO states SET name = '$state', country_id = 103");
    }
    catch(\Exception $err){
        p($err->getMessage());
    }
}
