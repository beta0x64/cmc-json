<?php
include('simple_html_dom.php');

// This is the source of our data below
$html = file_get_html('http://coinmarketcap.com/');

// This variable is where we will store all of the coins.
$list_of_coins = array();

for ($i = 1; $i <= 100; $i++) {
    // We are parsing the table rows from 1 to 100
    // Here we get the $i'th "tr" element in the table
    $step = $html->find('tr', $i);

    // We get the properties of the table row for this coin in plaintext
    $name = $step->find('a', 0)->plaintext;
    $cap = $step->find('td', 2)->plaintext;
    $price = $step->find('a', 1)->plaintext;
    $supply = $step->find('td', 4)->plaintext;
    $volume = $step->find('td', 5)->plaintext;
    $change = $step->find('td', 6)->plaintext;

    // We build an array data structure using the parsed table row
    $arr = array(
        'name' => $name, 
        'market_cap' => $cap, 
        'price' => $price, 
        'supply' => $supply, 
        'volume' => $volume, 
        'change' => $change
    );
    
    // We push this data structure onto a list of coins array
    array_push($list_of_coins, $arr);
}

// Displaying this with some pretty_print
echo json_encode($list_of_coins, JSON_PRETTY_PRINT);
?>
