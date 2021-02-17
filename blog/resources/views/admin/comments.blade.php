@extends('layouts.backend.app')

@section('tittle')
    Comment
@endsection

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Comments
                            <span class="badge bg-blue" > {{ $comments->count() }} </span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th class="text-center" >Comment Info</th>
                                    <th class="text-center" >Post Info</th>
                                    <th class="text-center" >Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th class="text-center" >Comment Info</th>
                                    <th class="text-center" >Post Info</th>
                                    <th class="text-center" >Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($comments as $key=>$comment)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-left" >
                                                    <a href="#">
                                                        <img class="media-object" src="{{ asset('storage/profile/'.$comment->user->image) }}" alt="" height="64" width="64">
                                                    </a>
                                                </div>
                                                <div class="media-body" >
                                                    <h4  class="media-heading">
                                                        {{ $comment->user->name }}
                                                        <small>{{ $comment->created_at->diffForHumans() }}  </small>
                                                    </h4>
                                                    <p>{{ $comment->comment }}</p>
                                                    <a target="_blank" href="{{ route('post.details', $comment->post->slug.'#comments') }}">Reply</a>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="media">
                                                <div class="media-right" >
                                                    <a href="#">
                                                        <img class="media-object" src="{{ asset('storage/post/'.$comment->post->image) }}" alt="" height="64" width="64">
                                                    </a>
                                                </div>
                                                <div class="media-body" >
                                                    <a target="_blank" href="{{ route('post.details', $comment->post->slug) }}">
                                                        <h4  class="media-heading">
                                                            {{ str_limit( $comment->post->tittle,'40' ) }}
                                                        </h4>
                                                    </a>
                                                    <p> By-<strong> {{ $comment->post->user->name }} </strong> </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <button class="btn btn-danger" type="button" onclick="deleteComment({{ $comment->id }})" >
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{ route('admin.comment.destroy',$comment->id) }}" method="post" id="delete-form-{{$comment->id}}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>


    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">

        function deleteComment(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        // event.preventDefault();
                        document.getElementById('delete-form-'+ id).submit()
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>

@endpush
