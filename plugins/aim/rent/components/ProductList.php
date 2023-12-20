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
        $filters = post('filters'); //izveido post no filters ko izmanto lai store'otu values

        $rules = [
            'tips' => 'required|in:Kemperis,Masinas,Aksesuari', //parliecinas par to ka tips ir izvelets ka viena no šim opcijam
        ];

        $validator = Validator::make($filters, $rules); //izveido validatoru kas parbauda filters ar noteikumiem 'rules'
        
        if ($validator->fails()) { //ja validators netiek izpildits
            foreach ($validator->messages()->all(':message') as $message) {
                return true;
            } 
        }

        $filters = ['is_active' => true];

        // $productType = post('filters.product_type');
        // if ($productType && $productType != "") { $filters['product_type'] = $productType; } 
        $productBrand = post('filters.brand');
        if ($productBrand && $productBrand != "") { $filters['brand'] = $productBrand; } 

        $products = Product::where($filters)->get();
        

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
