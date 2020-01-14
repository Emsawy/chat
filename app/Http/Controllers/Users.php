<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Store;
use App\Http\Requests\User\Update;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class Users extends BackEndController
{

    public function __construct(User $model){
      parent::__construct($model);
    }

    public function store(Store $request)
    {
      $arrayRequest = $request->all();
      $arrayRequest['password'] = Hash::make($arrayRequest['password']);
      $this->model->create($arrayRequest);
      return redirect()->route('users.index');
    }

    public function show($user)
    {
        $row = $this->model->findOrFail($user);
        $folderName = $routeName = $this->getTableNameFromModel();
        return view('users.show', compact(
          'row',
          'folderName',
          'routeName'
        ));
    }

    public function update(Update $request, $id)
    {
      $row = $this->model->findOrFail($id);
      $arrayRequest = $request->all();
      if(isset($arrayRequest['password']) && $arrayRequest['password'] != ""){
        $arrayRequest['password'] = Hash::make($arrayRequest['password']);
      }
      else {
          unset($arrayRequest['password']);
      }
      $row->update($arrayRequest);
      return redirect()->route('users.edit', ['user' => $row]);
    }

    public function message(\App\Http\Requests\Message\Store $request, $id){
      if($request->target_id != auth()->user()->id){
          $arrayRequest = $request->all();
          $row = $this->model->findOrFail($id);
          $row->messages()->create($arrayRequest);
          return redirect()->route('notify-mess',['sender_id' => $id , 'mess_id' => $request->target_id]);
          return redirect()->route('users.index');
      }
      return "Cant Sent a message for your self";
    }

    public function block(Request $request, $id){
      if($request->blocked_id != auth()->user()->id){
        $blocker = $this->model->findOrFail($id);
        $blocked = $this->model->findOrFail($request->blocked_id);
        $blocker->blocking()->attach($blocked);
        return redirect()->route('users.index');
      }
      return "Cant block your self";
    }

    protected function with(){
        return ['blockers', 'blocking'];
    }

}
