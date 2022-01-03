@section('title-page', ' - '. $page_attribute['title'])
@section('css-libraries')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

@section('css')
@endsection

@inject('sectorDataHelper', 'App\Helpers\SectorData')

<div>
    <section class="section">
        <div class="section-header">
            <h1>{{$page_attribute['title']}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pelaksanaan.index') }}">Pelaksanaan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pelaksanaan.umum.index') }}">Divisi Umum</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pelaksanaan.umum.aset_perusahaan.index') }}">Aset Perusahaan</a></div>
            </div>
        </div>
        
        <div x-data="{ control_tabs: @entangle('control_tabs') }" class="section-body">
            <div :class="{ 'd-none': !control_tabs.detail }" class="row d-none">
                @can($page_permission['add'])
                <div class="col-12 mb-4">
                    <button data-toggle="modal" data-target="#modalAddItem" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add</button>
                </div>
                @endcan
                <div class="col-12">
                    <h2 class="section-title">Data Pusat</h2>
                    <hr>
                </div>
                <div class="col-12">
                    <div class="row">
                        @forelse($selected_item_group as $item_group)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card shadow-sm custom-card-folder">
                                <article class="article article-style-b mb-0">
                                    <div class="article-header">
                                        <div class="article-top-badge w-100">
                                            <button class="btn btn-sm btn-primary pb-0 float-right btn-open-modal" wire:click="setItem({{$item_group['id']}})" data-toggle="modal" data-target="#modalViewItem"><i class="fas fa-expand"></i></button>
                                            <span class="badge shadow badge-primary text-capitalize">{{$sectorDataHelper::getNameById($item_group['origin_sector_id'])}}</span>
                                        </div>
                                        <div class="article-image" style="background-image: url({{ route('files.image.stream', ['path'=>$item_group['base_path'], 'name' => $item_group['image_name']]) }});">
                                        </div>
                                        <a class="main-popup-link" href="{{ route('files.image.stream', ['path'=>$item_group['base_path'], 'name' => $item_group['image_name']]) }}">
                                            <div class="article-badge custom-article-badge w-100">
                                                <div class="article-badge-item text-black custom-bg-transparent-white">{{$item_group['image_real_name']}}</div>
                                            </div>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <span>Empty</span>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <h2 class="section-title">Data Lokasi <div wire:loading wire:target="setSectorId" style="display: none"><i wire:loading.class="d-block" class="ml-2 text-primary fas fa-sync-alt fa-spin"></i></div></h2>
                    <hr>
                </div>
                <div x-show="control_tabs.sector_list" class="col-12">
                    <div class="row">
                        @foreach ($wilayah as $key => $sector)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div id="overlay-card-sector-{{Str::slug($sector)}}" wire:target="setSectorId('{{$key}}')" wire:loading.flex class="custom-card-overlay" style="display: none">
                                <i class="fas fa-3x fa-sync-alt fa-spin fa-3x"></i>
                            </div>
                            <div wire:click="setSectorId('{{$key}}')" class="card custom-card-folder card-link">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                    </div>
                                    <div class="w-100 mt-2">
                                        <span class="text-uppercase font-weight-600 mb-0">{{$sector}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div :class="{ 'd-none': !control_tabs.sector_detail }" class="col-12 d-none">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <button x-on:click="control_tabs.sector_list = true;control_tabs.sector_detail = false;$wire.clearSector()" class="btn btn-warning">Back</button>
                        </div>
                        @forelse ($selected_item_sector_group as $sector_item)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card shadow-sm custom-card-folder">
                                <article class="article article-style-b mb-0">
                                    <div class="article-header">
                                        <div class="article-top-badge w-100">
                                            <button class="btn btn-sm btn-primary pb-0 float-right btn-open-modal" wire:click="setItem({{$sector_item['id']}})" data-toggle="modal" data-target="#modalViewItem"><i class="fas fa-expand"></i></button>
                                            <span class="badge shadow badge-primary text-capitalize">{{$sectorDataHelper::getNameById($sector_item['origin_sector_id'])}}</span>
                                        </div>
                                        <div class="article-image" style="background-image: url({{ route('files.image.stream', ['path'=>$sector_item['base_path'], 'name' => $sector_item['image_name']]) }});">
                                        </div>
                                        <a class="sector-popup-link" href="{{ route('files.image.stream', ['path'=>$sector_item['base_path'], 'name' => $sector_item['image_name']]) }}">
                                            <div class="article-badge custom-article-badge w-100">
                                                <div class="article-badge-item text-black custom-bg-transparent-white">{{$sector_item['image_real_name']}}</div>
                                            </div>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <span>Empty</span>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div wire:ignore.self class="modal fade" role="dialog" id="modalAddItem">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$page_attribute['title']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="addItem" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="input_date">Tanggal</label>
                            <input wire:model="input_tanggal" type="text" class="form-control form-date" name="input_date" id="input_date" />
                        </div>
                        @error('input_tanggal')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" wire:model="file_image" accept="image/*" class="form-control" id="upload_image_{{$iteration}}" required>
                        </div>
                        @error('file_image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div x-show="isUploading">
                            <progress max="100" class="w-100" x-bind:value="progress"></progress>
                        </div>
                        <div class="w-100">
                            @if ($file_image)
                            Image Preview:
                            <img src="{{ $file_image->temporaryUrl() }}" class="w-100 border shadow">
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:loading.class="disabled btn-progress" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" role="dialog" id="modalViewItem">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$page_attribute['title']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="w-100">
                            <div class="common-section-title">Lokasi</div>
                            <p>{{$sectorDataHelper::getNameById($selected_item['origin_sector_id'] ?? null) ?? 'Pusat'}}</p>
                        </div>
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
                            <img id="img_id_{{$selected_item['id']}}" src="{{$selected_url}}" class="w-100 img-wheel-zoom border shadow">
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <div class="mr-auto">
                            @if ($selected_item)
                            @can($page_permission['delete'])
                            <button wire:target="delete" wire:loading.class="disabled btn-progress" data-id="{{$selected_item['id']}}" type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                            @endcan
                            <button wire:click="downloadImage" wire:target="downloadImage" wire:loading.class="disabled btn-progress" type="button" class="btn btn-primary"><i class="fas fa-download"></i></button>
                            @endif
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('script')
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.form-date').daterangepicker({
            singleDatePicker: true,
            autoApply: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
        $('.main-popup-link').magnificPopup({
            gallery: {
                enabled:true,
                navigateByImgClick: false,
            },
            type: 'image',
            callbacks: {
                change: function(item) {
                    setTimeout(() => {
                        wheelzoom(document.querySelector('.mfp-img'));
                    }, 100);
                }
            }
            // other options
        });
    })
    
    $('.form-date').on('change', function(event) {
        Livewire.emit('evSetInputTanggal', event.target.value);
    })

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).attr('data-id');
        var target = $(this).attr('data-target');
        Swal.fire({
            title: 'Are you sure?',
            text: "Once deleted, you will not be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OK',
            showLoaderOnConfirm: true,
            reverseButtons: true,
            preConfirm: async () => {
                var data = await @this.delete(id)
                return data
            },
            allowOutsideClick: () => !Swal.fire.isLoading()
        }).then(async (result) => {
            if (result.value && result.value.status_code == 200) {
                $('.modal').modal('hide');
                
                setTimeout(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: result.value.message,
                    });
                }, 600);
            }
            else if (result.value && result.value.status_code == 403) {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: result.value.message,
                });
            }
        })
    })
    
    document.addEventListener('wheelzoom:init', function (event) {
        wheelzoom(document.querySelector('.img-wheel-zoom'));
    });
    document.addEventListener('magnific-popup:init', function (event) {
        $(event.detail.target).magnificPopup({
            gallery: {
                enabled:true,
                navigateByImgClick: false,
            },
            type: 'image',
            callbacks: {
                change: function(item) {
                    setTimeout(() => {
                        wheelzoom(document.querySelector('.mfp-img'));
                    }, 100);
                }
            }
            // other options
        });
    })
    
    document.addEventListener('notification:show', function (event) {
        setTimeout(function() {
            $('.modal').modal('hide');
        }, 200);
        setTimeout(function() {
            Swal.fire({
                icon: event.detail.type,
                title: event.detail.title,
                text: event.detail.message,
            });
        }, 600);
    })
</script>
@endpush
