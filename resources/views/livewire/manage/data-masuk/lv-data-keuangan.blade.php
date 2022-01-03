@section('css-libraries')
@endsection

@inject('sectorDataHelper', 'App\Helpers\SectorData')

<div>   
    <section class="section">
        <div class="section-header">
            <h1>Filter Data Masuk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('manage.data_masuk.index') }}">Manage</a></div>
                <div class="breadcrumb-item">Divisi Keuangan</div>
            </div>
        </div>
        
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width: 25px;" scope="col">#</th>
                                    <th class="text-left" scope="col">Asal</th>
                                    <th class="text-left" scope="col">Menu</th>
                                    <th class="text-left" scope="col">Nama</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sector_items as $key => $sector_item)
                                <tr>
                                    <td>{{$paginationAttributes['offset'] + ($key+1)}}</td>
                                    <td>{{$sectorDataHelper::getNameById($sector_item->sector_id)}}</td>
                                    <td>{{$sector_item->menu}}</td>
                                    <td>{{$sector_item->image_real_name}}</td>
                                    <td class="text-center" style="width: 200px">
                                        <button id='btn_look_{{"{$sector_item->uuid}_{$key}"}}' wire:click="setItem('{{$sector_item->menu_id}}', {{$sector_item->id}}, '{{$sector_item->sector_id}}')" data-toggle="modal" data-target="#modalViewSectorItem" class="btn btn-sm btn-info"><i class="fas fa-search"></i></button>
                                        <button id='btn_copy_{{"{$sector_item->uuid}_{$key}"}}' wire:click="copyDataSector('{{$sector_item->menu_id}}', {{$sector_item->id}}, '{{$sector_item->sector_id}}')" wire:target="copyDataSector('{{$sector_item->menu_id}}', {{$sector_item->id}},'{{$sector_item->sector_id}}')" wire:loading.class="disabled btn-progress" type="button" class="btn btn-sm btn-success"><i class="fas fa-sign-in-alt"></i> Accept</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Empty</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <livewire:components.pagination.lv-paginate :paginationAttributes="$paginationAttributes" key="{{ Str::random() }}" />
                </div>
            </div>
        </div>
    </section>
    
    <div wire:ignore.self class="modal fade" role="dialog" id="modalViewSectorItem">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$page_attribute['title']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="common-section-title">Lokasi</div>
                            <p>{{$selected_item['sector_name'] ?? '-'}}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="common-section-title">Menu</div>
                            <p>{{$selected_item['menu'] ?? '-'}}</p>
                        </div>
                    </div>
                    <hr class="mt-2 mb-4">
                    <div class="w-100">
                        <div class="common-section-title">Image Name</div>
                        <p>{{$selected_item['image_real_name'] ?? '-'}}</p>
                    </div>
                    <div class="w-100 mb-4">
                        <div class="common-section-title">Date</div>
                        @if ($selected_item)
                        <p>{{date('d F Y', strtotime($selected_item['tanggal']))}}</p>
                        @else
                        <p>-</p>
                        @endif
                    </div>
                    <div class="w-100">
                        @if ($selected_item)
                        <img id="sector_img_id_{{$selected_item['id']}}" src="{{$selected_url}}" class="w-100 border shadow">
                        @endif
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <div class="mr-auto">
                        @if ($selected_item)
                        <button wire:click="downloadImage('{{$selected_item['menu_id']}}', '{{$selected_item['sector_id']}}')" wire:target="downloadImage" wire:loading.class="disabled btn-progress" type="button" class="btn btn-primary"><i class="fas fa-download"></i></button>
                        @endif
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
</div>

@push('script-libraries')
@endpush
@push('script')
<script>
    document.addEventListener('notification:show', function (event) {
        let attr = {
            title: event.detail.title,
            message: event.detail.message,
            position: 'topRight'
        };
        
        iziToast[event.detail.type](attr);
    })
</script>
@endpush
