@section('css-libraries')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/select2/css/select2.min.css') }}">
@endsection

<div>   
    <section class="section">
        <div class="section-header">
            <h1>OTP User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('master.index') }}">Master</a></div>
                <div class="breadcrumb-item">User</div>
            </div>
        </div>
        
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 mb-4">
                        <button wire:click="addUser" wire:click="addUser" wire:loading.class="btn-progress disabled" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add User</button>
                    </div>
                    <div class="table-responsive">
                        
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left" style="width: 25px;" scope="col">#</th>
                                <th class="text-left" scope="col">Link</th>
                                <th class="text-left" scope="col">Access Code</th>
                                <th class="text-left" style="width: 250px;" scope="col">Role</th>
                                <th class="text-center" style="width: 300px;" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($otp_users as $key => $otp_user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <p>
                                        <a href="{{ route('otp_user.form_login', ['token'=>$otp_user->token]) }}">[Link Login]</a>
                                        <i data-toggle="tooltip" data-placement="top" title="Copy to clipboard" class="copy_verify_link ml-1 far fa-copy" style="cursor: pointer"></i>
                                    </p>
                                </td>
                                <td>{{$otp_user->access_code}}</td>
                                <td>{{$otp_user->getRoleNames()[0] ?? '-'}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="px-1">
                                            <button wire:click="setUser({{$otp_user->id}})" wire:target="setUser({{$otp_user->id}})" data-toggle="modal" data-target="#modalEditUserRole" wire:loading.class="disabled btn-progress" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                        </div>
                                        <div class="px-1">
                                            <button wire:click="removeRole({{$otp_user->id}})" wire:target="removeRole({{$otp_user->id}})" wire:loading.class="btn-progress disabled" class="btn btn-sm btn-secondary"><i class="fas fa-user-alt-slash"></i> Clear Role</button>
                                        </div>
                                        <div class="px-1">
                                            <button wire:click="deleteUser({{$otp_user->id}})" wire:target="deleteUser({{$otp_user->id}})" wire:loading.class="btn-progress disabled" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                    </div>
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
                </div>
            </div>
        </div>
    </section>
    
    <div wire:ignore.self class="modal fade" role="dialog" id="modalEditUserRole">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="updateUserRole">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Token</label>
                            <p>{{$selected_otp_user->token ?? '-'}}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label>Access Code</label>
                            <p>{{$selected_otp_user->access_code ?? '-'}}</p>
                        </div>
                        <div wire:ignore class="form-group mb-3">
                            <label for="code">Role</label>
                            <select id="select_role" data-key="role_id" class="form-control select-wrapper select2" required>
                                <option></option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:loading.class="disabled btn-progress" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

@push('script-libraries')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/library/select2/js/select2.full.min.js') }}"></script>
@endpush
@push('script')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip()
        $('#select_role').select2({
            placeholder: 'Pilih',
            width: '100%'
        })
    })
    
    function fallbackCopyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            var successful = document.execCommand("copy");
            var msg = successful ? "successful" : "unsuccessful";
            console.log("Fallback: Copying text command was " + msg);
        } catch (err) {
            console.error("Fallback: Oops, unable to copy", err);
        }
        
        document.body.removeChild(textArea);
    }
    async function copyTextToClipboard(text) {
        if (!navigator.clipboard) {
            fallbackCopyTextToClipboard(text);
            return;
        }
        var status = await new Promise(function(resolve, reject) {
            navigator.clipboard.writeText(text).then(
            function() {
                resolve(true)
                // console.log("Async: Copying to clipboard was successful!");
            },
            function(err) {
                reject(false)
                // console.error("Async: Could not copy text: ", err);
            }
            );
        })
        return status;
    }

    $(document).on('click', '.copy_verify_link', async function() {
        var text = $(this).parent().find('a').attr('href');
        var tooltip = await copyTextToClipboard(text);
        var this_el = $(this);
        console.log(tooltip);
        if (tooltip) {
            $(this).attr('data-original-title', 'Copied!');
            $(this).tooltip('show');
        } else {
            $(this).attr('data-original-title', 'Could not copy text!');
            $(this).tooltip('show');
        }
        setTimeout(function() {
            this_el.attr('data-original-title', 'Copy to clipboard');
        }, 600);
    })

    $('.select-wrapper').on('change', function() {
        value = $(this).val();
        key = $(this).attr('data-key');
        Livewire.emit('evSetItem', key, value);
    })
    
    document.addEventListener('select2:set', function (event) {
        $(event.detail.selector).val(event.detail.value).trigger("change")
    })
    document.addEventListener('notification:success', function (event) {
        $('.modal').modal('hide');
        
        setTimeout(function() {
            Swal.fire({
                icon: 'success',
                title: event.detail.title,
                text: event.detail.message,
            });
        }, 600);
    })
</script>
@endpush

