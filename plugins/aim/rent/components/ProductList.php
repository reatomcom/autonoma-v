<?php namespace Aim\Rent\Components;

use Validator;
use Cms\Classes\ComponentBase;
use Aim\Rent\Models\Product;
use Session;

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
        // $input = Request::input();

        // if (Request::input('has_wc', 1)) {
        //     $filters['has_wc'] = 1;
        // }
        // if (Request::input('has_shower', 1)) {
        //     $filters['has_shower'] = 1;
        // }
        // if (Request::input('has_kitchen', 1)) {
        //     $filters['has_kitchen'] = 1;
        // }
        // if (Request::input('has_ac', 1)) {
        //     $filters['has_ac'] = 1;
        // }
        // if (Request::input('has_heating', 1)) {
        //     $filters['has_heating'] = 1;
        // }
        // if (Request::input('has_tv', 1)) {
        //     $filters['has_tv'] = 1;
        // }
        // if (Request::input('has_bike_rack', 1)) {
        //     $filters['has_bike_rack'] = 1;
        // }
        // if (Request::input('has_pets_allowed', 1)) {
        //     $filters['has_pets_allowed'] = 1;
        // }

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
        // $products = Product::where($filters)
        //     ->get();
        $products = Product::all();
        $productsCount = $products->count();

        $this->page['products'] = $products;
        $this->page['productCount'] = $productsCount;
    }
    public function onSetFilters()
    {
        // $filters = post('filters'); //izveido post no filters ko izmanto lai store'otu values

        $rules = [
            'product_type' => 'required|in:car,camper,other', //parliecinas par to ka tips ir izvelets ka viena no šim opcijam
        ];

        $validator = Validator::make(post('filters'), $rules); //izveido validatoru kas parbauda filters ar noteikumiem 'rules'
        
        if ($validator->fails()) { //ja validators netiek izpildits
            foreach ($validator->messages()->all(':message') as $message) {
                // return 
            } 
        }

        $filters = ['is_active' => true];

        $productType = post('filters.product_type');
        $productBrand = post('filters.brand');
        $productBrand = post('filters.brand');
        $productBeds = post('filters.beds');
        $filters = post('filters.attr');
        $priceFrom = input('filters.price.from');
        $priceTo = input('filters.price.to');

        $query = Product::query();

        if ($productType && $productType != "") 
        { 
            $filters['product_type'] = $productType; 
        } 

        
        if ($productBrand && $productBrand != "") { 
            $filters['brand'] = $productBrand; 
        }

        if ($productBeds && $productBeds != "") { 
            $filters['beds'] = $productBeds; 
        }
        
        if (is_array($filters) || is_object($filters)) { 
            foreach ($filters as $key => $value) {
                if ($value == 1) {
                    $query->where($key, $value);
                }
            }
        }
        
        if (!empty($priceFrom)) {
            $query->where('price_offseason_week_4', '>=', $priceFrom);
        }
        
        if (!empty($priceTo)) {
            $query->where('price_offseason_week_4', '<=', $priceTo);
        }

        $products = $query->get();
        //$products = Product::where($filters)->get();

        // where('brand',$filters['brand'])
        
        //product where products[]

        // if (empty($filters['attr'])) { //ja amenities nav izvēlēts nekas
        //     $query = Product::query();

        //     if (isset($filters['beds']) && $filters['beds'] === 'any') { //parbauda vai gultas ir set uz any
        //         $query->where('title', $filters['tips']); //izvada filtrejot pec title
        //     } else {
        //         $query->where('title', $filters['tips']); //else izvada filtrejot pec title un next if

        //         if (isset($filters['beds']) && $filters['beds'] !== 'any') { //parbauda vai gultas nav set uz any
        //             $query->where('beds', $filters['beds']); //ja nav izvada gultas
        //         }
        //     }

        //     $products = $query->get();
        // } else { //ja amenities ir izvēlēts kaut kas
        //     $products = []; //izveidots products masivs
        //     foreach ($filters['attr'] as $key => $attr) { //
        //         if (isset($filters['beds']) && $filters['beds'] !== 'any') {
        //             $selectedBeds = $filters['beds'];
        //             $addProducts = Product::where('title', $filters['tips'])
        //                 ->where('beds', $selectedBeds)
        //                 ->where($key, '1')
        //                 ->get()
        //                 ->toArray();
        //             $products = array_merge($products, $addProducts);
        //         } else {
        //             $products = [];
        //         }
        //     }
        // }

        return [
            '#content' => $this->renderPartial('@content', [
                'products' => $products
            ])
        ];
    }

    public function onResetFilters()
    {
        Session::forget('filters');

        return [
            '#content' => $this->renderPartial('@content', [
                'products' => Product::all()
            ])
        ];
    }
    
    
}
