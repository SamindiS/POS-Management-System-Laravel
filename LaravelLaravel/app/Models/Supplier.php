<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Supplier extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'suppliers';
    
    protected $fillable = [
        'supplier_name',
        'contact_person',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'phone',
        'email',
        'website',
        'tax_id',
        'notes',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];
    
    protected $auditInclude = [
        'supplier_name',
        'contact_person',
        'email',
        'phone',
        'is_active'
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public static function countries()
    {
        return [
            'US' => 'United States',
            'CA' => 'Canada',
            'UK' => 'United Kingdom',
            'AU' => 'Australia',
            'DE' => 'Germany',
            'FR' => 'France',
            'JP' => 'Japan',
            'IN' => 'India'
        ];
    }
    
    public function getFullAddressAttribute()
    {
        $addressParts = [
            $this->address,
            $this->city,
            $this->state,
            $this->zip_code,
            $this->countries()[$this->country] ?? $this->country
        ];
        
        return implode(', ', array_filter($addressParts));
    }
}