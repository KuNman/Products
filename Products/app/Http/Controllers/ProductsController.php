<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Collective\Html\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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

        $date = Carbon::now();
        $year = $date->year;
        $month = $date->month;
        if($month < 10) {
            $month = 0 . $month;
        }
        $day = $date->day;
        if($day < 10) {
            $day = 0 . $day;
        }
        $hour = $date->hour;
        if($hour < 10) {
            $hour = 0 . $hour;
        }
        $minutes = $date->minute;
        if($minutes < 10) {
            $minutes = 0 . $minutes;
        }
        $seconds = $date->second;
        if($seconds < 10) {
            $seconds = 0 . $seconds;
        }
        $dateValue = $year . '-' . $month . '-' . $day . 'T' . $hour . ':' . $minutes . ':' . $seconds;

        $pricesNamesArray = self::getPricesNames();

        if ($pricesNamesArray != null && $dateValue != null) {
            return view('zadanie', ['add' => true, 'date' => $dateValue, 'pricesnames' => $pricesNamesArray]);
        }

        return false;

    }

    private static function getPricesNames() {

        if($prices_names = DB::table('Pricelist')->select('price_name')->distinct()->get()) {
            foreach ($prices_names as $price_name) {
                $pricesNamesArray[] = $price_name->price_name;
            }
            return $pricesNamesArray;
        }
    }

    public function addItemToDB() {

        if(self::validateName($_POST["name"]) &&
            self::validateDesc($_POST["description"]) &&
            self::validatePrice($_POST["price"]) &&
            self::validatePriceName($_POST["price_name"])) {

            $insert_product = DB::table('Products')->insert(
                ['name' => $_POST["name"], 'description' => $_POST["description"], 'created' => $_POST["date"]]
            );

            $id = DB::table('Products')->select('id')->orderBy('id', 'desc')->first();

            $insert_price = DB::table('Pricelist')->insert(
                ['price_name' => $_POST["price_name"], 'product_id' => $id->id, 'price' => $_POST["price"]]
            );

            if ($insert_product && $insert_price) {
                return 'saved';
            }
        }
        return 'missing data';
    }

    private static function validateName($name) {

        if(strlen($name) >= 3 && strlen($name) <= 15) {
            return true;
        }
        return false;
    }

    private static function validateDesc($desc) {

        if(strlen($desc) <= 255) {
            return true;
        }
        return false;
    }

    private static function validatePrice($price) {

        $price = floatval($price);

        if(is_numeric($price) && $price >= 0.01) {
            return true;
        }
        return false;
    }

    private static function validatePriceName($price_name) {

        if(strlen($price_name) >= 1 && strlen($price_name) <= 10) {
            return true;
        }
        return false;
    }

    public function getDetails() {

        if (self::validateName($_POST["name"])) {
            $description = DB::table('Products')->select('description')->where('name', $_POST["name"])->get();
            $date = DB::table('Products')->select('created')->where('name', $_POST["name"])->get();

            $id = DB::table('Products')->select('id')->where('name', $_POST["name"])->get();

            if ($price_normal = DB::table('Pricelist')->select('price')->where('product_id', $id[0]->id)->where('price_name', 'normal')->first()) {
                $price_normal = $price_normal->price;
            }

            if ($price_hot = DB::table('Pricelist')->select('price')->where('product_id', $id[0]->id)->where('price_name', 'hot')->first()) {
                $price_hot = $price_hot->price;
            }

            if ($price_sale = DB::table('Pricelist')->select('price')->where('product_id', $id[0]->id)->where('price_name', 'sale')->first()) {
                $price_sale = $price_sale->price;
            }

            if ($update = DB::table('Products')->select('modified')->where('name', $_POST["name"])->first()){
                $update = $update->modified;
            }


            if ($description && $date || $price_normal || $price_hot || $price_sale || $update) {
                return [$description, $date, $price_normal, $price_hot, $price_sale, $update];
            }
            return 'error';
        }
    }

    public function deleteProduct() {

        if (self::validateName($_POST["name"])) {
            if (DB::table('Products')->where('name', $_POST["name"])->delete()) {
                return 'deleted';
            }
        }
    }

    public function updateProduct() {

        if (self::validateName($_POST["name_old"]) &&
            self::validateName($_POST["name"]) &&
            self::validateDesc($_POST["description"])) {
            if (DB::table('Products')->where('name', $_POST["name_old"])->update([
                'name' => $_POST["name"], 'description' => $_POST["description"], 'modified' => Carbon::now()])) {
                    return 'saved';
            }
            return 'error';
        }
    }

}