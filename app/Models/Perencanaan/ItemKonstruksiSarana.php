<?php

namespace App\Models\Perencanaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;

class ItemKonstruksiSarana extends Model
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
        'konstruksi_sarana_id',
        'sector_id',
        'image_real_name', 
        'image_name', 
        'base_path', 
        'tanggal',
    ];

    public const MENU = 'Perencanaan';
    public const DIVISI = '-';
    public const BASE_PATH = 'images/perencanaan/konstruksi-sarana/';
}
