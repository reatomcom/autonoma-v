<?php namespace Aim\Rent\Models;

use Model;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var bool timestamps are disabled.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    // public $implement = [
    //     \RainLab\Translate\Behaviors\TranslatableModel::class
    // ];

    // public $translatable = ['title', 'description'];

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'aim_rent_products';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $jsonable = ['videos'];

    /**
     *
     * @return array
     */
    public function getEngineTypeOptions()
    {
        return [
            'diesel' => 'Diesel',
            'gasoline' => 'Gasoline',
            'hybrid' => 'Hybrid',
        ];
    }
    
    public function getGearboxTypeOptions()
    {
        return [
            'manual' => 'Manual',
            'automatic' => 'Automatic',

        ];
    }
    public $attachMany = [
        'images' => \System\Models\File::class
    ];
}