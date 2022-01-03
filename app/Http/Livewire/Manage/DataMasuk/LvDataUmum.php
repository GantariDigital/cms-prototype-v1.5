<?php

namespace App\Http\Livewire\Manage\DataMasuk;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Helpers\{
    CentralData,
    SectorData,
    StringGenerator,
};

class LvDataUmum extends Component
{
    private $sector_properties;
    
    protected $listeners = [
        'setPaginationAttributes' => 'setPaginationAttributes'
    ];
    public $page_attribute = [
        'title' => 'Divisi Umum',
    ];
    
    public $paginationAttributes = [
        'total_data' => 0,
        'offset' => 0,
        'limit' => 15,
        'current_page' => 1,
    ];

    public $selected_item;
    public $selected_url;
    
    public $selected_sector_id;
    public $sector_name;

    public $input_parent;
    
    public function render()
    {
        $db_pusat = Config::get("database.connections.mysql.database");
        $databases = SectorData::getAllDatabases();
        $tables = CentralData::getAllTableByDivision("Umum");
        $main_query = null;
        $total_data = 0;
        foreach ($databases as $db_key => $database) {
            foreach ($tables as $tb_key => $table) {
                $sub_query = DB::table("{$database}.{$table['table_name']} as table_origin")
                ->select("table_origin.id", "table_origin.uuid", "table_origin.sector_id", "table_origin.full_path", "table_origin.id", "table_origin.image_real_name", "table_origin.image_name" , "table_origin.tanggal", "table_origin.created_at")
                ->selectRaw("'{$table['menu_name']}' as menu, '{$table['id']}' as menu_id")
                ->leftJoin("{$db_pusat}.{$table['table_name']} as table_main", 'table_main.origin_uuid', '=', 'table_origin.uuid')
                ->whereNull('table_main.origin_uuid');
                $total_data += $sub_query->count();
                if($db_key == 0 && $tb_key == 0) {
                    $main_query = $sub_query;
                } else {
                    $main_query = $main_query->unionAll($sub_query);
                }
            }
        }
        $this->paginationAttributes['total_data'] = $total_data;
        $main_query = $main_query->when($this->paginationAttributes['offset'], function ($query, $offset)
        {
            return $query->offset($offset);
        })
        ->limit($this->paginationAttributes['limit'])->orderBy('created_at', 'DESC')->get();
        // dd($main_query);
        $data['sector_items'] = $main_query;
        return view('livewire.manage.data-masuk.lv-data-umum')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
    
    public function setPaginationAttributes($paginationAttributes)
    {
        $this->paginationAttributes = $paginationAttributes;
    }
    public function setSector($sector_id, $attributes = ['notification' => false])
    {
        $sector_properties = SectorData::getPropertiesById($sector_id);
        if($sector_properties) {
            $this->sector_properties = $sector_properties;
            return true;
        }
        if($attributes['notification']) {
            $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data, try again later."]);
        }
        return false;
    }
    
    public function setSectorId($sector_id)
    {
        $exists = $this->setSector($sector_id, ['notification' => true]);
        if($exists) {
            $this->selected_sector_id = $sector_id;
            $this->control_tabs = [
                'sector_list' => false,
                'sector_detail' => true,
            ];
        }
    }
    
    public function setItem($menu_id, $id, $sector_id)
    {
        $table = CentralData::getDivisionTableById('Umum', $menu_id);
        if(!$table) return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data"]);
        
        $modelClass = $table['model'];
        $query = $modelClass::query();
        
        $exists = $this->setSector($sector_id, ['notification' => true]);
        if ($exists) {
            Config::set('database.connections.sector_db.database', $this->sector_properties['db_name']);
            DB::purge('sector_db');
            $query = $modelClass::on('sector_db');
        }
        $item = $query->where('id', $id)->firstOrFail();
        $this->selected_item = $item->toArray();
        $this->selected_item['sector_name'] = SectorData::getNameById($item->sector_id);
        $this->selected_item['menu'] = $table['menu_name'];
        $this->selected_item['menu_id'] = $table['id'];
        
        $this->selected_url = route('files.image.sector.stream', ['path' => $item->sector_id.'/'.$item->base_path, 'name' => $item->image_name]);
    }
    
    public function downloadImage($menu_id, $sector_id)
    {
        $table = CentralData::getDivisionTableById('Umum', $menu_id);
        if(!$table) return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data"]);
        
        $modelClass = $table['model'];
        $query = $modelClass::query();
        
        $exists = $this->setSector($sector_id, ['notification' => true]);
        if ($exists) {
            Config::set('database.connections.sector_db.database', $this->sector_properties['db_name']);
            DB::purge('sector_db');
            $query = $modelClass::on('sector_db');
        }
        $item = $query->where('id', $this->selected_item['id'])->firstOrFail();
        $path = $item->sector_id.'/'.$item->base_path.$item->image_name;
        
        return Storage::disk('sector_base')->download($path, $item->image_real_name);
    }
    
    public function copyDataSector($menu_id, $id, $sector_id)
    {
        $table = CentralData::getDivisionTableById('Umum', $menu_id);
        if(!$table) return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data"]);
        
        $modelClass = $table['model'];
        $query = $modelClass::query();

        $exists = $this->setSector($sector_id, ['notification' => true]);
        if ($exists) {
            Config::set('database.connections.sector_db.database', $this->sector_properties['db_name']);
            DB::purge('sector_db');
            $item = $modelClass::on('sector_db')
            ->where('id', $id)
            ->firstOrFail();
            
            $is_accepted = $modelClass::where('origin_uuid', $item->uuid)->first();
            
            if($is_accepted) {
                return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => 'Data already accepted.']);
            }
            
            $re_item = $item->replicate();
            $re_item->setConnection('mysql');
            $re_item->origin_uuid = $re_item->uuid;
            $re_item->origin_sector_id = $re_item->sector_id;
            $re_item->sector_id = Config::get('app.sector_id');
            
            $old_path = $item->sector_id.'/'.$re_item->base_path.$re_item->image_name;
            $extension = pathinfo(Storage::disk('sector_base')->path($old_path), PATHINFO_EXTENSION);
            $new_filename = StringGenerator::fileName($extension);
            $new_path = $re_item->sector_id.'/'.$re_item->base_path.$new_filename;
            
            $re_item->image_name = $new_filename;
            $re_item->save();
            
            Storage::disk('sector_base')->copy($old_path, $new_path);
            return $this->dispatchBrowserEvent('notification:show', ['type' => 'success', 'title' => 'Success!', 'message' => 'Successfully storing data.']);
            // dd($re_item);
        }
        return;
    }
}
