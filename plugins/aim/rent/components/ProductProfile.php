<?php namespace Aim\Rent\Components;
use Aim\Rent\Models\Product;
use Cms\Classes\ComponentBase;

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
        // dd($this->param('car'));
        $productId = $this->param('id'); // replace 'id' with the actual parameter name
        $this->page['product'] = Product::find($productId);
    }
}
