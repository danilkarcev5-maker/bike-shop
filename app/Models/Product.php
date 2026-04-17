<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Поля, которые можно массово заполнять.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
    ];

    /**
     * Связь "многие к одному" с моделью Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}