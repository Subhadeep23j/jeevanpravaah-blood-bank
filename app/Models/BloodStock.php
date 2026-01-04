<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_type',
        'units_available',
        'units_reserved',
        'last_updated_at',
    ];

    protected $casts = [
        'last_updated_at' => 'datetime',
    ];

    /**
     * Get the available units (total - reserved)
     */
    public function getActualAvailableAttribute(): int
    {
        return max(0, $this->units_available - $this->units_reserved);
    }

    /**
     * Get stock status label
     */
    public function getStockStatusAttribute(): string
    {
        $available = $this->actual_available;

        if ($available <= 0) {
            return 'out_of_stock';
        } elseif ($available <= 5) {
            return 'critical';
        } elseif ($available <= 15) {
            return 'low';
        } else {
            return 'available';
        }
    }

    /**
     * Get all blood stocks as a keyed collection
     */
    public static function getAllStocks(): array
    {
        return self::all()->mapWithKeys(function ($stock) {
            return [$stock->blood_type => [
                'units' => $stock->actual_available,
                'status' => $stock->stock_status,
            ]];
        })->toArray();
    }
}
