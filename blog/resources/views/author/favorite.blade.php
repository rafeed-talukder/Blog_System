@extends('layouts.backend.app')

@section('tittle')
    Post
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
                            All Favorite Post's
                            <span class="badge bg-blue" > {{ $posts->count() }} </span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tittle</th>
                                    <th>Author</th>
                                    <th> <i class="material-icons">favorite</i> </th>
{{--                                    <th> <i class="material-icons">comment</i> </th>--}}
                                    <th> <i class="material-icons">visibility</i> </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Tittle</th>
                                    <th>Author</th>
                                    <th> <i class="material-icons">favorite</i> </th>
{{--                                    <th> <i class="material-icons">comment</i> </th>--}}
                                    <th> <i class="material-icons">visibility</i> </th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $key=>$post)
                                    <tr>
                                        <th>
                                            {{ $key + 1 }}
                                        </th>
                                        <th>
                                            {{ str_limit($post->tittle,'10') }}
                                        </th>
                                        <th>
                                            {{ $post->user->name}}
                                        </th>
                                        <th>
                                            {{ $post->favorite_to_users->count()}}
                                        </th>
                                        <th>
                                            {{ $post->view_count  }}
                                        </th>
                                        <th>
                                            <a href="{{ route('admin.post.show',$post->id) }}" class="btn btn-info">
                                                <i class="material-icons">visibility</i>
                                            </a>

                                            <button class="btn btn-danger" type="button" onclick="removePost({{ $post->id }})" >
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{ route('post.favorite',$post->id) }}" method="post" id="remove-form-{{$post->id}}" style="display: none">
                                                @csrf
                                            </form>
                                        </th>

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

        function removePost(id){
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
                        document.getElementById('remove-form-'+ id).submit()
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
