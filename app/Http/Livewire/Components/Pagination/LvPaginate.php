<?php

namespace App\Http\Livewire\Components\Pagination;

use Livewire\Component;
use App\Helpers\{
    Converter,
};

class LvPaginate extends Component
{
    public $startPage;
    public $endPage;
    public $currentPage;
    public $totalPage = 0;
    public $last_entry = 0;
    public $paginationAttributes = [
        'total_data' => 0,
        'offset' => 0,
        'limit' => 0,
        'current_page' => 1,
    ];
    
    public function mount()
    {
        $this->convertPage();
    }

    public function render()
    {
        $this->currentPage = $this->paginationAttributes['current_page'];
        $this->startPage = ($this->currentPage < 4)? 1 : $this->currentPage - 1;
        $this->endPage = 2 + $this->startPage;
        $this->endPage = ($this->totalPage < $this->endPage) ? $this->totalPage : $this->endPage;
        $diff = $this->startPage - $this->endPage + 2;
        $this->startPage -= ($this->startPage - $diff > 0) ? $diff : 0;
        $this->last_entry =  ($this->currentPage <> $this->totalPage)? $this->paginationAttributes['limit']*$this->paginationAttributes['current_page'] : $this->paginationAttributes['total_data'];
        
        return view('livewire.components.pagination.lv-paginate');
    }
    
    public function goToPage($page)
    {
        if($page < 1) {
            $page = 1;
        }
        $this->paginationAttributes['current_page'] = $page;
        $this->convertPage();
        $this->emitUp('setPaginationAttributes', $this->paginationAttributes);
    }
    
    private function convertPage()
    {
        $total_data = $this->paginationAttributes['total_data'];
        $limit = $this->paginationAttributes['limit'];
        $this->totalPage = Converter::totalPage($total_data, $limit);
        $this->paginationAttributes['offset'] = Converter::pageToOffset($this->paginationAttributes['current_page'], $limit);

    }
}
