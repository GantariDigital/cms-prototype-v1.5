<?php

namespace App\Http\Livewire\Pelaksanaan\Umum;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Umum\LegalitasPerusahaan,
    Umum\ItemLegalitasPerusahaan,
};
use App\Helpers\{
    StringGenerator,
    SectorData,
};

class LvItemLegalitasPerusahaan extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'evSetInputTanggal' => 'setInputTanggal',
    ];
    
    public $page_attribute = [
        'title' => '',
    ];
    public $page_permission = [
        'add' => 'item-legalitas-perusahaan add',
        'delete' => 'item-legalitas-perusahaan delete',
    ];
    public $control_tabs = [
        'detail' => true,
        'sector_list' => true,
        'sector_detail' => false,
    ];

    public $parent_id;
    public $file_image;
    public $input_tanggal;
    public $iteration;

    public $selected_item_group = [];
    public $selected_item_sector_group = [];
    public $selected_group_name;
    public $selected_item;
    public $selected_url;
    
    public $wilayah;
    public $selected_sector_id;
    public $sector_name;

    public function mount($slug)
    {
        $parent = LegalitasPerusahaan::query()
        ->where('slug_name', $slug)
        ->firstOrFail();

        $this->parent_id = $parent->id;
        $this->page_attribute['title'] = $parent->name;
        $this->wilayah = SectorData::getAllNames();
    }

    public function render()
    {
        $items = ItemLegalitasPerusahaan::query()
        ->select('*')
        ->selectRaw('IFNULL(origin_sector_id, "ID-PST") as origin_sector_id')
        ->where('legalitas_perusahaan_id', $this->parent_id)
        ->orderBy('tanggal', 'ASC')
        ->get()
        ->groupBy('origin_sector_id');
        $this->selected_item_group = $items['ID-PST'] ?? [];

        if($this->selected_sector_id) {
            $this->selected_item_sector_group = $items[$this->selected_sector_id] ?? [];
        }
        
        $data['items'] = $items;
        return view('livewire.pelaksanaan.umum.lv-item-legalitas-perusahaan')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function addItem()
    {
        $this->validate([
            'file_image' => 'required|image',
            'input_tanggal' => 'required|string',
        ]);
        $date_parse = str_replace('/', '-', $this->input_tanggal);
        $date_now = date('Y-m-d H:i:s', strtotime($date_parse));
        $image_name = StringGenerator::fileName($this->file_image->extension());
        $image_path = Storage::disk('sector_disk')->putFileAs(ItemLegalitasPerusahaan::BASE_PATH, $this->file_image, $image_name);

        $insert = ItemLegalitasPerusahaan::create([
            'legalitas_perusahaan_id' => $this->parent_id,
            'image_real_name' => $this->file_image->getClientOriginalName(),
            'image_name' => $image_name,
            'tanggal' => $date_now,
        ]);

        $this->resetInput();
        
        $this->dispatchBrowserEvent('magnific-popup:init', ['target' => '.main-popup-link']);
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

    
    public function setItem($id)
    {
        $item = ItemLegalitasPerusahaan::findOrFail($id);
        $this->selected_item = $item;
        $this->selected_url = route('files.image.stream', ['path' => $item->base_path, 'name' => $item->image_name]);
        return $this->dispatchBrowserEvent('wheelzoom:init');
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

    public function downloadImage($image_number = 1)
    {
        $file = ItemLegalitasPerusahaan::findOrFail($this->selected_item['id']);
        $path = $item->base_path.$item->image_name;
        
        return Storage::disk('sector_disk')->download($path, $item->image_real_name);
    }

    public function delete($id)
    {
        $item = ItemLegalitasPerusahaan::findOrFail($id);
        $path = $item->base_path.$item->image_name;
        Storage::disk('sector_disk')->delete($path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
