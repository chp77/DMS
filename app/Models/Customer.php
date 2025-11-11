<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'company_name',
        'company_address',
        'country',
        'contact_number',
        'reseller_name',
        'user_id',
        'created_at',
        'updated_at',
        'is_active',
        'is_suspended',
    ];
}
