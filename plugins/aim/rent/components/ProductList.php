<?php namespace Aim\Rent\Components;

use Cms\Classes\ComponentBase;
use Aim\Rent\Models\Product;

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
        $this->page['images'] = \File::allFiles('/home/adrians/sites/autonoma-v/storage/app/media/');
    }
    
    public function countProducts()
    {
        return Product::count();
    }


}
