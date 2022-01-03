<div>
    <div class="row">
        <div class="col-sm-12 col-md-5 align-self-center">
            @if ($paginationAttributes['total_data'] == 0)
            <span>Showing 0 to 0 of 0 entries</span>
            @else
            <span>Showing {{ $this->paginationAttributes['offset']+1 }} to {{ $last_entry }} of {{$paginationAttributes['total_data']}} entries</span>
            @endif
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="d-flex justify-content-end">
                <div style="overflow-x: auto">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination custom-pagination-scroll-h mb-0">
                            @if ($currentPage == 1)
                            <li class="page-item disabled">
                                <button class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </button>
                            </li>
                            @else
                            <li class="page-item">
                                <button id="btn-prev-page" wire:click="goToPage({{$currentPage-1}})" class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </button>
                            </li>
                            @endif
                            @if ($startPage > 1)
                            <li class="page-item">
                                <button id="btn-first-page" wire:click="goToPage(1)" class="page-link" aria-label="Previous">
                                    First
                                </button>
                            </li>
                            @endif
                            @for ($i = $startPage; $i <= $endPage; $i++)
                            <li class="page-item {{($i == $currentPage)? 'active' : ''}}"><button id="btn_{{$i}}" class="page-link" wire:click="goToPage({{$i}})">{{$i}}</button></li>
                            @endfor
                            @if ($endPage < $totalPage)
                            <li class="page-item">
                                <button id="btn-last-page" wire:click="goToPage({{$totalPage}})" class="page-link" aria-label="Previous">
                                    Last
                                </button>
                            </li>
                            @endif
                            @if ($currentPage == $totalPage || $totalPage == 0)
                            <li class="page-item disabled">
                                <button class="page-link" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </button>
                            </li>
                            @else
                            <li class="page-item">
                                <button id="btn-next-page" wire:click="goToPage({{$currentPage+1}})"  class="page-link" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </button>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
