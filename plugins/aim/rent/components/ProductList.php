<?php namespace Aim\Rent\Components;

use Cms\Classes\ComponentBase;
use Aim\Rent\Models\Product;
// use Carbon\Carbon;

/**
* ProductList Component
*
* @link https://docs.octobercms.com/3.x/extend/cms-components.html
*/
class ProductList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'ProductList Component',
            'description' => 'No description provided yet...'
        ];
    }
    
    /**
    * @link https://docs.octobercms.com/3.x/element/inspector-types.html
    */
    public function defineProperties()
    {
        return [];
    }
    
    public function onRun()
    {
        $this->page['products'] = Product::all();
        $this->page['productCount'] = $this->countProducts();
        $this->page['images'] = \File::allFiles(getcwd().'/storage/app/media/');
        
        // foreach ($this->page['products'] as $product) {
        //     $seasonFromDay = Carbon::createFromFormat('d', $product->season_from_day);
        //     $offseason_to_day = $seasonFromDay->addDay()->format('d');
        
        //     // Add the offseason_to_day to the product
        //     $product->offseason_to_day = $offseason_to_day;
        // }
        
        // foreach ($this->page['products'] as $product) {
        //     $seasonFromDate = Carbon::createFromFormat('d-m', $product->season_from_day . '-' . $product->season_from_month);
        //     $offseasonFromDate = $seasonFromDate->addDay();
        
        //     $seasonToDate = Carbon::createFromFormat('d-m', $product->season_to_day . '-' . $product->season_to_month);
        //     $offseasonToDate = $seasonToDate->addDay();
        
        //     // Add the offseason_from_day, offseason_from_month, offseason_to_day, offseason_to_month to the product
        //     $product->offseason_from_day = $offseasonFromDate->format('d');
        //     $product->offseason_from_month = $offseasonFromDate->format('m');
        //     $product->offseason_to_day = $offseasonToDate->format('d');
        //     $product->offseason_to_month = $offseasonToDate->format('m');
        // }
    }
    
    public function countProducts()
    {
        return Product::count();
    }


}
