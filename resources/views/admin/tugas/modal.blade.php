<!-- Modal Detail-->
<div class="modal fade" id="modalTugasShow{{ $item->id }}" tabindex="-1" aria-labelledby="modalTugasShowLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalTugasShowLabel">Detail {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-6">
                        Nama :
                    </div>
                    <div class="col-6">
                        {{ $item->user->nama }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Email :
                    </div>
                    <div class="col-6">
                        <span class="badge badge-primary badge-pill">{{ $item->user->email }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Jabatan :
                    </div>
                    <div class="col-6">
                        @if ($item->jabatan == 'Admin')
                            <span class="badge badge-dark badge-pill">{{ $item->user->jabatan }}</span>
                        @else
                            <span class="badge badge-info badge-pill">{{ $item->user->jabatan }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete-->
<div class="modal fade" id="modalTugasDelete{{ $item->id }}" tabindex="-1" aria-labelledby="modalTugasDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalTugasDeleteLabel">Hapus {{ $title }} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-6">
                        Nama :
                    </div>
                    <div class="col-6">
                        {{ $item->user->nama }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Email :
                    </div>
                    <div class="col-6">
                        <span class="badge badge-primary badge-pill">{{ $item->user->email }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Jabatan :
                    </div>
                    <div class="col-6">
                        @if ($item->user->jabatan == 'Admin')
                            <span class="badge badge-dark badge-pill">{{ $item->user->jabatan }}</span>
                        @else
                            <span class="badge badge-info badge-pill">{{ $item->user->jabatan }}</span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>
                    Close
                </button>
                <form action="{{ route('tugasDelete', $item->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash mr-2"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
