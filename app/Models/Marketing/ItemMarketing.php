<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;

class ItemMarketing extends Model
{
    use HasFactory, MultiTenantModelTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'origin_uuid',
        'full_path',
        'origin_sector_id',
        'marketing_id',
        'sector_id',
        'image_real_name', 
        'image_name', 
        'base_path', 
        'tanggal',
    ];

    public const MENU = 'Pelaksanaan';
    public const DIVISI = 'Marketing';
    public const BASE_PATH = 'images/marketing/item-marketing/';
}
