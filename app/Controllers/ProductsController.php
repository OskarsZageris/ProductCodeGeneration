<?php

namespace App\Controllers;

use App\Models\Product;
use App\View;

class ProductsController
{

    public function index(): View
    {
        $json = json_decode(file_get_contents('sample.json'), true);
        $items = $json["items"];
        return new View("Products/show.html", ["items" => $items]);
    }

    public function selected(): View
    {
        $json = json_decode(file_get_contents('sample.json'), true);
        $items = $json["items"];
        $varieties = $json["varieties"];
        $product = $_POST["product"];
        foreach ($items as $item) {
            if ($item["description"] == $product) {
                //get selected product code and varieties
                $code = $item["code"];
                $options = $item["varieties"];
            }
        }
        foreach ($varieties as $variety) {
            foreach ($options as $option) {
                if ($option == $variety["code"]) {
                    //get options and code for selected product
                    $optionsForItem[] = new Product($variety["code"], $variety["description"], $variety["options"]);
                }
            }
        }
        return new View("Products/product.html", [
            "selectOptions" => $optionsForItem,
            "product" => $product,
            "code" => $code
        ]);
    }

    public function code(): View
    {
        foreach ($_POST as $post) {
            $posts[] = $post;
        }
        $code = implode(".", array_reverse($_POST));
        //rearrange product code if needed
        return new View("Products/code.html", [
            "code" => $code
        ]);
    }
}