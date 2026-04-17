<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Поля, которые можно массово заполнять.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Связь "один ко многим" с моделью Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}