<?php

/**
 * @param $jsonIds string Ids - where key id and value is label (o|1)
 * @return array Get all ids that should be associated with the product
 */
function getAttachedItems($jsonIds)
{
    $collection = collect( json_decode($jsonIds) ); // ids collection

    return $collection
        ->map('intval') // new array with numeric keys
        ->filter() // items where value not zero
        ->keys()   // get all items by key
        ->toArray(); // transform to array
}