<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$project->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100" id="modalTitleId-{{$project->id}}">
                    <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                </h5>
            </div>
            {{-- /.modal-header --}}

            <div class="modal-body text-center">
                Are you sure to delete?
            </div>
            {{-- /.modal-body --}}

            <div class="modal-footer d-flex justify-content-center align-items-center gap-3">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </form>

            </div>
            {{-- /.modal-footer --}}

        </div>
        {{-- /.modal-content --}}

    </div>
    {{-- /.modal-dialog --}}
    
</div>
{{-- /.modal --}}