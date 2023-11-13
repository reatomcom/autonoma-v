<?php namespace Aim\Rent\Models;

use Aim\Rent\Models\ProductUnit;
use Model;

/**
 * Model
 */
class Reservation extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var bool timestamps are disabled.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'aim_rent_reservations';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'product' => 'Aim\Rent\Models\Product',
        'product_unit' => 'Aim\Rent\Models\ProductUnit',
    ];


    
    /**
     *
     * @return array
     */
    public function getStatusOptions()
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
        ];
    }

    public function beforeCreate()
    {
        $this->calculateDays();
    }

    public function beforeUpdate()
    {
        $this->calculateDays();
    }

    protected function calculateDays()
{
    if ($this->start_date && $this->end_date) {
        $startDate = \Carbon\Carbon::parse($this->start_date);
        $endDate = \Carbon\Carbon::parse($this->end_date);
        $diff = $endDate->diffInDays($startDate);
        $this->days = $diff;
    }
}
}
