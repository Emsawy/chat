@extends('layouts.app')

@section('title', $pageTitle)

@section('content')

<div class="row">
  <div class="col-sm-12">

      <div class="row">
        <div class="col-md-8">
            <h3 class="box-title">All Users</h3>
        </div>
        <div class="col-md-4" style="text-align: center;">
            <a href="{{route($routeName.'.create')}}" class="btn btn-primary">Add User</a>
        </div>
      </div>

      <div class="table-responsive">
          <table class="table">
              <thead>
                  <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Blocked</th>
                      <th>Messages</th>
                      <th class="text-center">Control</th>
                  </tr>
              </thead>
              <tbody>

                @foreach($rows as $row)
                  <tr>
                      <td>{{$row->id}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->email}}</td>
                      <td>{{count($row->blocking)}}</td>
                      <td>{{count($row->messages)}}</td>
                      <td>
                        <div id="outer">
                          <div class="inner">
                            <div class="row">
                              <div class="collapse col-md-12" id="targetElement{{$row->id}}">
                                  {{$u_id =  auth()->user()->id }}
                                  @include('users.message-form',  ['routeName' => 'users', 'id' => 'sender_id', 'row' => $u_id, 'data' => $row])
                              </div>
                            </div>
                          </div>
                          <div class="inner">
                            <button type="button" class="btn btn-primary" data-target="#targetElement{{$row->id}}" data-toggle="collapse">Send Message</button>
                          </div>
                          @include('shared.buttons.edit',  ['routeName' => 'users', 'id' => 'user', 'row' => $row])
                          @include('shared.buttons.block',  ['routeName' => 'users', 'id' => 'blocked_id', 'row' => $u_id, 'data' => $row])
                          @include('shared.buttons.delete',['routeName' => 'users', 'id' => 'user', 'row' => $row])
                        </div>
                      </td>
                  </tr>

                @endforeach
              </tbody>
          </table>
          {{$rows->links()}}
      </div>
  </div>
</div>

@endsection
