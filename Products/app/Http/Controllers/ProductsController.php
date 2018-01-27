<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    public function createAllProductsView() {

        $names = self::getName();

        if($names != null) {
            return view('zadanie', ['names' => $names]);

        }

        return false;


    }

//    get all products names or specified by id
    private static function getName($id = false) {

        if ($id == false) {
            if($names = DB::table('Products')->select('name')->get()) {
                foreach ($names as $name) {
                    $namesArray[] = $name->name;
                }
                return $namesArray;
            }
        }

        if (is_int($id)) {
            echo 'int';
        }

        return false;
    }

    public function addNewProduct() {

        return view('zadanie', ['add' => true]);

    }

    private static function addToDB() {

        return true;
    }

}