<?php

namespace App\Services\Http;

use App\Product;

class ProductService
{
    public function createProduct($data)
    {
        $product = new Product();

        $data['categories'] = $this->filtrateData($data['categories']);
        $data['images'] = $this->filtrateData($data['categories']);
        $data['brands'] = $this->filtrateData($data['categories']);
        $data['amount'] = intval($data['amount']);
        $data['active'] = $data['active'] == 'on' ? 1 : 0;

        $product->fill($data);
        $product->name = $data['product_name'];

        if(isset($data['brands'][0]) && !empty($data['brands'])) {
            $product->brands()->associate($data['brands'][0]);
        }
        else {
            $product->brand_id = null;
        }

        $product->save();

        if($data['tags']) $product->tag(explode(',', $data['tags']) );
        $product->categories()->sync($data['categories']);
        $product->images()->sync($data['images']);

    }

    // kill this
    private function filtrateData($json)
    {
        $array = (array)json_decode($json);
        $array = array_map(function($e){return (int)$e;},$array);
        return array_keys(array_filter($array,function($e){return $e === 1;}));
    }
}