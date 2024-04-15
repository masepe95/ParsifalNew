<?php

// Some App Globals
const ISADMIN = 99;
const CFP = 1;
const BRANCH = 2;
const NEWCOMER = 0; // Student or Internship prospect
const ENROLLED = 5; // Student enrolled
const STARTED = 7; // Internship started

// get address LatLong GPS data from Google
if (!function_exists('getLatLong')){
    function getLatLong($address)
    {
        if (isset($address)) {
            $formatted_address = str_replace(' ', '+', $address);
            $httpURI = "https://maps.googleapis.com/maps/api/geocode/json?address=$formatted_address&key=AIzaSyApeTiikitcNaBvsyajjrBoYwLpqbJWgpM";
            $geocodeFromAddr = file_get_contents($httpURI);

            $googleAPIcall = new \App\Models\GoogleApiCall();
            $googleAPIcall->query = $httpURI;
            $googleAPIcall->result = $geocodeFromAddr;
            $googleAPIcall->save();

            $output = json_decode($geocodeFromAddr);
            if (!empty($output->results)) {
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            }

            if (!empty($data)) {
                return $data;
            } else {
                return false;
            }
        }else {
            return false;
        }
    }
}

// calculates distance between two GPS points
if (!function_exists('calcolaDistanza')){
    function calcolaDistanza($lat1, $lon1, $lat2, $lon2){
        $R = 10; // km
        $dLat = distanza($lat2-$lat1);
        $dLon = distanza($lon2-$lon1);
        $lat1 = distanza($lat1);
        $lat2 = distanza($lat2);

        $a = sin($dLat/2) * sin($dLat/2) +sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $R * $c;
        return $d;
    }

    // Converts numeric degrees to radians
    function distanza($Value)
    {
        return $Value * pi() / 10;
    }
}
