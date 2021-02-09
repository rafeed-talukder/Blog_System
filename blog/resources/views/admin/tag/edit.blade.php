@extends('layouts.backend.app')

@section('tittle')
    Tag
@endsection

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add New Tag
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.tag.update',$tag->id) }}" method="post" >
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="email_address" class="form-control" name="name" value="{{ $tag->name }}">
                                    <label class="form-label">Email Address</label>
                                </div>
                            </div>
                            <br>
                            <a  href="{{route('admin.tag.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Multi Column -->
    </div>
@endsection

@push('js')

@endpush
