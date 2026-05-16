<?php

// Copyright nexocom.ch 2022
// Json-Template https://docs.snipcart.com/v3/webhooks/shipping
//

$myfile = fopen(date('Y-m-dHis').'.txt', "w") or die("Unable to open file!");
fwrite($myfile, print_r(json_decode(file_get_contents('php://input'), true),true));
fclose($myfile);

// Check if POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (strpos(($_SERVER['HTTP_USER_AGENT']??null), 'Snipcart') !== false || $_GET['debug'] == 1)) {

    // Init vars
    $errors = 0;
    $shippingCost = 0;

    // Check if valid JSON
    if(null !== $PostData = json_decode(file_get_contents('php://input'), true)) {


        $cartItems = $PostData['content']['items'];

        $shippingAddressCountry = $PostData['content']['shippingAddress']['country'];

        $shippingZone = getZone($shippingAddressCountry);

        // Valid zone
        if($shippingZone !== false) {

            // Loop cart items
            foreach ($cartItems as $cartItem) {

                $parsedProduct = parseProduct($cartItem['id']);

                if($parsedProduct !== false) {
                    if(false !== $itemShippingCost = getShippingRate($shippingZone, $parsedProduct['productType'], $parsedProduct['productVariation'])) {
                        $shippingCost = $shippingCost + $itemShippingCost;
                    }
                    else {
                        $errors++;
                    }
                }
                else {
                    $errors++;
                }
            }
        }
        else {
            $errors++;
        }
    }
    else {
        $errors++;
    }

    if($shippingCost == false || $errors > 0) {

        $output = [
            'errors' => [[
                'key' => 'Es gab ein Problem mit der Berechnung der Versandkosten. Bitte melden Sie sich bei uns.'
            ]]
        ];
    }
    else {
        $output = [
            'rates' => [[
                'cost' => $shippingCost,
                'description' => 'Versandkosten'
            ]]
        ];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output);
}

function parseProduct($item)
{
    $itemIdParts = explode('-', $item);

    if(count($itemIdParts)) {

        if(!isValidProduct($itemIdParts[0])) {
            return false;
        }

        if($itemIdParts[0] == 'myarchivino' && !in_array($itemIdParts[3], ['kurz', 'mittel', 'hoch'])) {
            return false;
        }

        return [
            'productType' => $itemIdParts[0],
            'productVariation' => $itemIdParts[0] == 'myarchivino' ? $itemIdParts[3] : null
        ];
    }
}

function getZone($country)
{
    $shippingMappingCountryToZone = [
        'CH' => 'CH',
        'DE' => 'DE',
        'BE' => 'EU',
        'BG' => 'EU',
        'DK' => 'EU',
        'EE' => 'EU',
        'FI' => 'EU',
        'FR' => 'EU',
        'GR' => 'EU',
        'IE' => 'EU',
        'IT' => 'EU',
        'HR' => 'EU',
        'LV' => 'EU',
        'LT' => 'EU',
        'LU' => 'EU',
        'MT' => 'EU',
        'NL' => 'EU',
        'PL' => 'EU',
        'PT' => 'EU',
        'RO' => 'EU',
        'SE' => 'EU',
        'SK' => 'EU',
        'SI' => 'EU',
        'ES' => 'EU',
        'CZ' => 'EU',
        'HU' => 'EU',
        'VA' => 'EU',
        'GB' => 'EU',
        'CY' => 'EU',
        'AT' => 'EU',
    ];

    if(isset($shippingMappingCountryToZone[$country])) {
        return $shippingMappingCountryToZone[$country];
    }
    else {
        return false;
    }
}

function getShippingRate($region, $productType, $productVariation = null)
{
    $shippingCost = false;

    $shippingRates = [
        'CH' => [
            'myarchivino' => [
                'kurz'      => 9.70,
                'mittel'    => 9.70,
                'hoch'      => 21.00,
            ],
            'oblo' => 15.00,
            'expo' => 25.00
        ],
        'DE' => [
            'myarchivino' => [
                'kurz'      => 10.00,
                'mittel'    => 10.00,
                'hoch'      => 19.00,
            ],
            'oblo' => 15.00,
            'expo' => 40.00
        ],
        'EU' => [
            'myarchivino' => [
                'kurz'      => 16.00,
                'mittel'    => 21.00,
                'hoch'      => 28.00,
            ],
            'oblo' => 25.00,
            'expo' => 40.00
        ]
    ];

    // Check if valid region
    if(isset($shippingRates[$region])) {

        // check if valid variation
        if($productType == 'myarchivino') {
            if ($productVariation !== null && isset($shippingRates[$region]['myarchivino'][$productVariation])) {
                $shippingCost = $shippingRates[$region]['myarchivino'][$productVariation];
            }
        }
        elseif(isset($shippingRates[$region][$productType])) {
            $shippingCost = $shippingRates[$region][$productType];
        }
    }



    return $shippingCost;
}

function isValidProduct($product)
{
    $validProducts = [
        'myarchivino', 'oblo', 'expo'
    ];

    return in_array($product, $validProducts);
}