<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use App\Models\{
    User,
    Keuangan\JurnalHarian,
    Marketing\ItemMarketing,
};
use App\Helpers\RolesData;
use Spatie\Permission\Models\Role;

class FileStorageController extends Controller
{
    public function imageStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');
        
        if (Storage::disk('sector_disk')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_disk')->path($base_path.$filename);
            $type = File::mimeType($path);
            return response()
            ->file($path, array('Content-Type' =>$type));
            
        }
        
        abort(404);
    }

    public function imageSectorStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');

        if (Storage::disk('sector_base')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_base')->path($base_path.$filename);
            $type = File::mimeType($path);
            return response()
            ->file($path, array('Content-Type' =>$type));
            
        }
        
        abort(404);
    }
    
    public function pdfStream(Request $request)
    {
        $base_path = urldecode($request->query('path'));
        $filename = $request->query('name');
        
        if (Storage::disk('sector_disk')->exists($base_path.$filename)) {
            
            $path = Storage::disk('sector_disk')->path($base_path.$filename);
            $type = File::mimeType($path);
            return response()
            ->file($path, array('Content-Type' =>$type));
            
        }
        
        abort(404);
    }

    public function tester()
    {
        $datas = Role::all()->map(function ($value, $key)
        {
            return [ 'name' => $value->name, 'permissions' => $value->permissions->pluck('name')->toArray() ];
        });
        dd($datas);
        $details = (object) [
            'divisi' => 'Keuangan',
            'menu' => 'Pelaksanaan',
        ];
        $users = User::with('roles')->whereHas(
            'roles', function ($query) use($details)
            {
                $query->where(function ($query) use($details)
                {
                    $query->where(['name' => "Divisi {$details->divisi} [VIEW ONLY]", 'guard_name' => 'web']);
                })->orWhere(function ($query) use($details)
                {
                    $query->where(['name' => "Menu {$details->menu} [VIEW ONLY]", 'guard_name' => 'web']);
                })->orWhere(function ($query)
                {
                    $query->where(['name' => "Menu All[VIEW ONLY]", 'guard_name' => 'web']);
                });
            }
        )->get();
        dd($users);
        $details = (object) [
            'divisi' => "Keuangan",
            'path' => "images/keuangan/jurnal-harian/",
            'image_name' => "JURNAL - JULI 2021 - 2.jpg",
            'file_name' => "J03T3FSNbFO7AGhmKL4zOHJyXRGPwKu5mI7rsGCBHte0I.jpg",
        ];
        $details->pathToImage = Storage::disk('sector_disk')->path($details->path.$details->file_name);
        dump(public_path());
        dump(public_path() . '/' . $details->pathToImage);
        dd(env('SECTOR_PUBLIC_PATH') . '/' . $details->pathToImage);
        return view('layouts.mail.notification-mail')
        ->with(['data' => $details]);
    }
}
