<?php namespace Aim\Rent\Components;

use Cms\Classes\ComponentBase;
use Aim\Rent\Models\Product;
use Request;

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

        $filters = ['is_active' => true];
        $input = Request::input();

        if (Request::input('has_wc', 1)) {
            $filters['has_wc'] = 1;
        }
        if (Request::input('has_shower', 1)) {
            $filters['has_shower'] = 1;
        }
        if (Request::input('has_kitchen', 1)) {
            $filters['has_kitchen'] = 1;
        }
        if (Request::input('has_ac', 1)) {
            $filters['has_ac'] = 1;
        }
        if (Request::input('has_heating', 1)) {
            $filters['has_heating'] = 1;
        }
        if (Request::input('has_tv', 1)) {
            $filters['has_tv'] = 1;
        }
        if (Request::input('has_bike_rack', 1)) {
            $filters['has_bike_rack'] = 1;
        }
        if (Request::input('has_pets_allowed', 1)) {
            $filters['has_pets_allowed'] = 1;
        }

        // $filters['has_toiler'] = true;

        // if (ir padota cena) {
        //     Ja ir cena tad bus cits products 
        //     $products = Product::where($filters)
        //         ->where('price', '>', 100) // 100 mainiigais
        //         ->where('price', '<', 300)
        //         ->get();
        // } else {
        //     Ja ne tad bus
        //     $products = Product::where($filters)
        //     ->get();
        // }
        // 
        $products = Product::where($filters)
            ->get();
        $productsCount = $products->count();

        $this->page['products'] = $products;
        $this->page['productCount'] = $productsCount;
    }
    public function onSetFilters()
    {
        $filters = post('filters');
        if (empty($filters['attr'])) {
            $products = Product::where('title', $filters['tips'])
            ->where('beds', $filters['beds'])
            ->get();
        } else {
            $products = [];
            foreach($filters['attr'] as $key => $attr){
                $addProducts = Product::where('title', $filters['tips'])
                    ->where('beds', $filters['beds'])
                    ->where($key, '1')
                    ->get()
                    ->toArray();
                $products = array_merge($products, $addProducts);
            }
        }

        return [
            '#content' => $this->renderPartial('@content',[
                'products' => $products
            ])
        ];
    }   
    
}
