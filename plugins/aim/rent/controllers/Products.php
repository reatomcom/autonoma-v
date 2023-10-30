<?php namespace Aim\Rent\Controllers;

use Backend;
use BackendAuth;
use BackendMenu;
use Redirect;
use Backend\Classes\Controller;
use aim\rent\models\Product;
use aim\rent\models\ProductUnit;

class Products extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Aim.Rent', 'main-menu-item', 'side-menu-item');
    }


    public function onCreateUnit($id)
    {
        if (!BackendAuth::getUser()) {
            return Redirect::to(Backend::url('backend/auth/signin'));
        }

        $product = Product::find($id);
        if (!$product) {
            // Flash...
            return Redirect::to(Backend::url('aim/rent/products'));
        }

        $productUnit = new ProductUnit();
        $productUnit->product_id = $product->id;
        $productUnit->title = $product->title;
        $productUnit->brand = $product->brand;
        $productUnit->model = $product->model;
        $productUnit->year = $product->year;
        $productUnit->beds = $product->beds;
        $productUnit->is_active = $product->is_active;
        $productUnit->description = $product->description;
        $productUnit->slug = $product->slug;
        $productUnit->has_wc = $product->has_wc;
        $productUnit->has_kitchen = $product->has_kitchen;
        $productUnit->has_shower = $product->has_shower;
        $productUnit->has_tv = $product->has_tv;
        $productUnit->has_heating = $product->has_heating;
        $productUnit->has_ac = $product->has_ac;
        $productUnit->has_pets_allowed = $product->has_pets_allowed;
        $productUnit->has_bike_rack = $product->has_bike_rack;
        $productUnit->engine_type = $product->engine_type;
        $productUnit->engine_power = $product->engine_power;
        $productUnit->engine_size = $product->engine_size;
        $productUnit->gearbox_shifts = $product->gearbox_shifts;
        $productUnit->gearbox_type = $product->gearbox_type;
        $productUnit->save();

        return Redirect::to(Backend::url('aim/rent/productunits/update/'.$productUnit->id));

    }

}
