<?php namespace Aim\Rent\Components;

use Cms\Classes\ComponentBase;
use Aim\Rent\Models\Product;

/**
 * LandingCom Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class LandingCom extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'LandingCom Component',
            'description' => 'No description provided yet...'
        ];
    }

    
    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function countProducts()
    {
        return Product::count();
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        //$this->page['products'] = Product::all();
        $this->page['productCount'] = $this->countProducts();
        $this->page['images'] = \File::allFiles(getcwd().'/storage/app/media/');
        $products_p = Product::where('is_promoted', true)->get();
        $this->page['promotedProducts'] = $products_p;
    }
}
