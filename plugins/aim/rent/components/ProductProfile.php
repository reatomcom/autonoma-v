<?php namespace Aim\Rent\Components;
use Aim\Rent\Models\Product;
use Cms\Classes\ComponentBase;
use Carbon\Carbon;

/**
* ProductProfile Component
*
* @link https://docs.octobercms.com/3.x/extend/cms-components.html
*/
class ProductProfile extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'ProductProfile Component',
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
        $productId = $this->param('id');
        $product = Product::find($productId);
        $this->page['product'] = $product;
    }
}
