<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use App\Jobs\SendEmailNotifJob;
trait MultiTenantModelTrait {
    
    public static function bootMultiTenantModelTrait() {

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->sector_id = Config::get('app.sector_id'); 
            $model->base_path = $model::BASE_PATH; 
            $model->full_path = $model::BASE_PATH . $model->image_name; 

            $details = (object) [
                'menu' => $model::MENU,
                'divisi' => $model::DIVISI,
                'path' => $model->base_path,
                'image_name' => $model->image_real_name,
                'file_name' => $model->image_name,
            ];
          
            dispatch(new SendEmailNotifJob($details));
        });

    }

}