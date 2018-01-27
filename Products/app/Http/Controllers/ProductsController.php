<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    public function createAllProductsView() {

        if($names = DB::table('Products')->select('name')->get()) {
            foreach ($names as $name) {
                $namesArray[] = $name->name;
            }
        }

        self::getName();

    }

    private static function getName($id = false) {

        if ($id == false) {
            echo 'aaa';
        }
    }
}