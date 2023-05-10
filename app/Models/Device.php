<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'token',
        'user_id',
        'group_id',
        'name',
        'tags',
        'serial_number',
        'modal_brand',
        'os',
        'os_version',
        'firware_version',
        'is_active',
        'is_online',
        'created_at',
        'updated_at'
    ];
}
