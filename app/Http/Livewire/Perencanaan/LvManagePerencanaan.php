<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\{
    StringGenerator,
    MainData,
    SectorData,
};

class LvManagePerencanaan extends Component
{
    use WithFileUploads;
    
    protected $listeners = [
        'evSetInputTanggal' => 'setInputTanggal',
    ];
    private $menu = [
        'properties' => [],
    ];
    
    public $page_attribute = [
        'title' => '',
        'type' => '',
    ];
    public $slug_name;
    public $sub_menu_name;
    
    public $page_permission = [
        'add' => '',
        'delete' => '',
    ];
    
    public $control_tabs = [
        'list' => true,
        'detail' => false,
        'sector_list' => true,
        'sector_detail' => false,
    ];
    
    public $parent_id;
    public $selected_list;
    public $file_image;
    public $input_tanggal;
    public $iteration;
    
    public $items;
    public $selected_item_group = [];
    public $selected_item_sector_group = [];
    public $selected_group_name;
    public $selected_item;
    public $selected_url;
    
    public $option_lists = [];
    public $wilayah;
    public $selected_sector_id;
    public $sector_name;
    
    public function mount($menu, $sub_menu = null) {
        $this->slug_name = $menu;
        $properties = MainData::getMenuTable("Perencanaan", $this->slug_name);
        if (empty($properties)) {
            // abort(404);
            dd('empty');
        }
        
        $this->menu['properties'] = $properties;
        
        $this->page_attribute['title'] = $properties->menu_name;
        $this->page_attribute['type'] = $properties->type;
        
        if($sub_menu) {
            $parent = $properties->model::query()
            ->where('slug_name', $sub_menu)
            ->firstOrFail();
            $this->parent_id = $parent->id;
            $this->sub_menu_name = $parent->name;
            $this->page_permission['add'] = "{$properties->child_permission} add";
            $this->page_permission['delete'] = "{$properties->child_permission} delete";
        } else {
            $this->page_permission['add'] = "{$properties->slug_name} add";
            $this->page_permission['delete'] = "{$properties->slug_name} delete";
        } 
        if($properties->type == 'list') {
            $this->selected_list = $properties->first_slug_list;
        }
        $this->wilayah = SectorData::getAllNames();
    }
    
    public function hydrate()
    {
        $this->menu['properties'] = MainData::getMenuTable("Perencanaan", $this->slug_name);
    }
    
    public function render()
    {
        $data = [];
        if($this->menu['properties']->type == 'main') {
            $modelClass = $this->menu['properties']->model;
            $items = $modelClass::query()
            ->select('*')
            ->selectRaw('DATE_FORMAT(tanggal, "%M %Y") as date, IFNULL(origin_sector_id, "ID-PST") as origin_sector_id')
            ->orderBy('tanggal', 'ASC')
            ->get()
            ->groupBy('date');
        }
        
        elseif($this->menu['properties']->type == 'parent') {
            $modelClass = $this->menu['properties']->child_model;
            $items = $modelClass::query()
            ->select('*')
            ->selectRaw('DATE_FORMAT(tanggal, "%M %Y") as date, IFNULL(origin_sector_id, "ID-PST") as origin_sector_id')
            ->where($this->menu['properties']->parent_key, $this->parent_id)
            ->orderBy('tanggal', 'ASC')
            ->get()
            ->groupBy('date');
        }
        
        elseif ($this->menu['properties']->type == 'list') {
            $main_query = null;
            foreach ($this->menu['properties']->lists as $key => $value) {
                $this->option_lists[$key] = ['slug_name' => $value['slug_name'], 'menu_name' => $value['menu_name']];
                $sub_query = $value['model']::query()
                ->select('*')
                ->selectRaw('DATE_FORMAT(tanggal, "%M %Y") as date, ? as type, IFNULL(origin_sector_id, "ID-PST") as origin_sector_id', [$value['slug_name']]);
                
                if($key == 0) {
                    $main_query = $sub_query;
                } else {
                    $main_query = $main_query->unionAll($sub_query);
                }
            }
            $items = $main_query->orderBy('type', 'DESC')
            ->orderBy('tanggal', 'ASC')
            ->get()
            ->groupBy('date');
        }
        
        $this->items = collect($items)->map(function ($values, $index)
        {
            $data_items = $values->groupBy('origin_sector_id');
            return [
                'name' => $index,
                'main_items' => $data_items['ID-PST'] ?? [],
                'sector_items' => collect($data_items)->except('ID-PST'),
            ];
        });
        if ($this->selected_group_name) {
            $item = $this->items->where('name', $this->selected_group_name)->first();
            $this->selected_item_group = $item['main_items'] ?? [];
            if($this->selected_sector_id) {
                $this->selected_item_sector_group = $item['sector_items'][$this->selected_sector_id] ?? [];
            }
        }
        
        // dd($items);
        $data['menu_type'] = $this->menu['properties']->type;
        return view('livewire.perencanaan.lv-manage-perencanaan')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
    
    public function addItem()
    {
        $this->validate([
            'file_image' => 'required|image',
            'input_tanggal' => 'required|string',
        ]);
        $data_insert = [
            'image_real_name' => '',
            'image_name' => '',
            'tanggal' => '',
        ];
        if ($this->menu['properties']->type == 'main') {
            $modelClass = $this->menu['properties']->model;
        } elseif ($this->menu['properties']->type == 'parent') {
            $modelClass = $this->menu['properties']->child_model;
            $data_insert[$this->menu['properties']->parent_key] = $this->parent_id;
        } elseif ($this->menu['properties']->type == 'list') {
            $modelClass = collect($this->menu['properties']->lists)->firstWhere('slug_name', $this->selected_list);
            if($modelClass == null) abort(404);
            $modelClass = $modelClass['model'];
        }
        
        $date_parse = str_replace('/', '-', $this->input_tanggal);
        $date_now = date('Y-m-d H:i:s', strtotime($date_parse));
        $image_name = StringGenerator::fileName($this->file_image->extension());
        $image_path = Storage::disk('sector_disk')->putFileAs($modelClass::BASE_PATH, $this->file_image, $image_name);
        
        $data_insert['image_real_name'] = $this->file_image->getClientOriginalName();
        $data_insert['image_name'] = $image_name;
        $data_insert['tanggal'] = $date_now;
        
        // dd($data_insert);
        $insert = $modelClass::create($data_insert);
        
        $this->resetInput();
        
        return $this->dispatchBrowserEvent('notification:show', ['type' => 'success', 'title' => 'Success!', 'message' => 'Successfully adding data.']);
    }
    
    public function setInputTanggal($value)
    {
        $this->input_tanggal = $value;
    }
    
    public function resetInput()
    {
        $this->reset('file_image', 'selected_item');
        $this->input_tanggal = date('d/m/Y');
        $this->iteration++;
    }
    
    public function setItem($id, $list_slug = null)
    {
        if ($this->menu['properties']->type == 'main') {
            $modelClass = $this->menu['properties']->model;
        } elseif ($this->menu['properties']->type == 'parent') {
            $modelClass = $this->menu['properties']->child_model;
        } elseif ($this->menu['properties']->type == 'list') {
            $modelClass = collect($this->menu['properties']->lists)->firstWhere('slug_name', $list_slug);
            if($modelClass == null) abort(404);
            $modelClass = $modelClass['model'];
        }
        $item = $modelClass::findOrFail($id);
        $this->selected_item = $item;
        $this->selected_url = route('files.image.stream', ['path' => $item->base_path, 'name' => $item->image_name]);
        return $this->dispatchBrowserEvent('wheelzoom:init');
    }
    
    public function setGroupName($name)
    {
        $this->selected_group_name = $name;
        $this->control_tabs = [
            'list' => false,
            'detail' => true,
            'sector_list' => true,
            'sector_detail' => false,
        ];
        return $this->dispatchBrowserEvent('magnific-popup:init', ['target' => '.main-popup-link']);
    }
    
    public function downloadImage()
    {
        if ($this->menu['properties']->type == 'main') {
            $modelClass = $this->menu['properties']->model;
        } elseif ($this->menu['properties']->type == 'parent') {
            $modelClass = $this->menu['properties']->child_model;
        } elseif ($this->menu['properties']->type == 'list') {
            $modelClass = collect($this->menu['properties']->lists)->firstWhere('slug_name', $list_slug);
            if($modelClass == null) abort(404);
            $modelClass = $modelClass['model'];
        }
        $item = $modelClass::findOrFail($this->selected_item['id']);
        $path = $item->full_path;
        
        return Storage::disk('sector_disk')->download($path, $item->image_real_name);
    }
    
    public function delete($id)
    {
        if ($this->menu['properties']->type == 'main') {
            $modelClass = $this->menu['properties']->model;
        } elseif ($this->menu['properties']->type == 'parent') {
            $modelClass = $this->menu['properties']->child_model;
        } elseif ($this->menu['properties']->type == 'list') {
            $modelClass = collect($this->menu['properties']->lists)->firstWhere('slug_name', $list_slug);
            if($modelClass == null) abort(404);
            $modelClass = $modelClass['model'];
        }
        $item = $modelClass::findOrFail($id);
        $path = $item->full_path;
        Storage::disk('sector_disk')->delete($path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
