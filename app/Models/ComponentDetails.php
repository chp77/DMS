<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentDetails extends Model
{
    use HasFactory;

    protected $table = 'component_details';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'component_id',
        'product_image',
        'price',
        'currency',
        'specification',
        'created_at',
        'updated_at',
        'is_active',
    ];
}
