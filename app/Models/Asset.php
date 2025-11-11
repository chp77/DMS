<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'type',
        'customer_order_number',
        'serial_number',
        'mac_address',
        'brand',
        'model',
        'qa_video_url',
        'manufacture_date',
        'warranty_period',
        'warranty_started_date',
        'warranty_expiry_date',
        'remarks',
        'item_name',
        'customer_id',
        'user_id',
        'component_ids',
        'is_csv_import',
        'sku',
        'created_at',
        'updated_at',
        'is_active',
    ];
}
