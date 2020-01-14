@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="row">
    <div class="col-md-8">
      <div class="card">
          <div class="card-body">
              <form action="{{route($routeName.'.update', ['user' => $row])}}" method="post" class="form-horizontal form-material" enctype="multipart/form-data">
                @method('PATCH')
                @include($folderName.'.form')
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Update {{$modelName}}</button>
                    </div>
                </div>
              </form>
          </div>
      </div>
    </div>
</div>
@endsection
