<?php

namespace App\Http\Livewire\Pelaksanaan\Keuangan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Keuangan\PengajuanDana,
    Master\MsSubCode,
};
use App\Helpers\{
    StringGenerator,
    SectorData,
};

class LvPengajuanDana extends Component
{
    use WithFileUploads;
    
    protected $listeners = [
        'evSetPaket' => 'setPaket',
        'evSetInputTanggal' => 'setInputTanggal',
    ];
    
    public $page_attribute = [
        'title' => 'Pengajuan Anggaran',
    ];
    public $page_permission = [
        'add' => 'pengajuan-dana add',
        'delete' => 'pengajuan-dana delete',
    ];
    
    public $control_tabs = [
        'list' => true,
        'detail' => false,
        'sector_list' => true,
        'sector_detail' => false,
    ];
    
    public $paket_id;
    public $file_image;
    public $input_tanggal;
    public $iteration;
    
    public $items;
    public $selected_item_group = [];
    public $selected_item_sector_group = [];
    public $selected_group_name;
    public $selected_item;
    public $selected_url;
    
    public $wilayah;
    public $selected_sector_id;
    public $sector_name;
    
    public function mount()
    {
        $this->wilayah = SectorData::getAllNames();
    }

    public function render()
    {
        $data['pakets'] = MsSubCode::all();
        $items = PengajuanDana::query()
        ->select('*')
        ->selectRaw('DATE_FORMAT(tanggal, "%M %Y") as date, IFNULL(origin_sector_id, "ID-PST") as origin_sector_id')
        ->orderBy('tanggal', 'ASC')
        ->get()
        ->groupBy('date');

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
        
        return view('livewire.pelaksanaan.keuangan.lv-pengajuan-dana')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
    
    public function addItem()
    {
        $this->validate([
            'paket_id' => 'required|integer',
            'file_image' => 'required|image',
            'input_tanggal' => 'required|string',
        ]);
        $date_parse = str_replace('/', '-', $this->input_tanggal);
        $date_now = date('Y-m-d H:i:s', strtotime($date_parse));
        $image_name = StringGenerator::fileName($this->file_image->extension());
        $image_path = Storage::disk('sector_disk')->putFileAs(PengajuanDana::BASE_PATH, $this->file_image, $image_name);
        
        $paket = MsSubCode::find($this->paket_id);

        $insert = PengajuanDana::create([
            'divisi_id' => $paket->parent_code_id,
            'paket_id' => $this->paket_id,
            'image_real_name' => $this->file_image->getClientOriginalName(),
            'image_name' => $image_name,
            'tanggal' => $date_now,
        ]);
        
        $this->resetInput();
        
        return $this->dispatchBrowserEvent('notification:show', ['type' => 'success', 'title' => 'Success!', 'message' => 'Successfully adding data.']);
    }
    
    public function setPaket($value)
    {
        $this->paket_id = $value;
    }
    public function setInputTanggal($value)
    {
        $this->input_tanggal = $value;
    }
    
    public function resetInput()
    {
        $this->reset('paket_id', 'file_image', 'selected_item');
        $this->input_tanggal = date('d/m/Y');
        $this->iteration++;
        $this->dispatchBrowserEvent('select2:reset', ['selector' => '#select_paket']);
    }
    
    public function setItem($id)
    {
        $item = PengajuanDana::findOrFail($id);
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

    public function clearSector()
    {
        $this->selected_sector_id = null;
        $this->sector_name = null;
    }

    public function setSectorId($sector_id)
    {
        $exists = $this->setSector($sector_id, ['notification' => true]);
        if($exists) {
            $this->selected_sector_id = $sector_id;
            $this->control_tabs = [
                'list' => false,
                'detail' => true,
                'sector_list' => false,
                'sector_detail' => true,
            ];
            return $this->dispatchBrowserEvent('magnific-popup:init', ['target' => '.sector-popup-link']);
        }
    }
    
    public function openList()
    {
        $this->control_tabs = [
            'list' => true,
            'detail' => false,
        ];
    }
    
    public function downloadImage()
    {
        $item = PengajuanDana::findOrFail($this->selected_item['id']);
        $path = $item->full_path;
        
        return Storage::disk('sector_disk')->download($path, $item->image_real_name);
    }
    
    public function delete($id)
    {
        $item = PengajuanDana::findOrFail($id);
        $path = $item->full_path;
        Storage::disk('sector_disk')->delete($path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
