<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Plots
 * @package App
 * @property string $cadastral_number
 * @property string $address
 * @property double $price
 * @property double $area
 */
class Plots extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'cadastral_number',
        'address',
        'price',
        'area',
    ];
}
