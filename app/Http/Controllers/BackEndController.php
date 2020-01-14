<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Pluralizer;

class BackEndController extends Controller
{
    protected $model;
    protected $folderName;
    protected $pageTitle;
    protected $pageDes;
    protected $modelName;
    protected $pluralModelName;

    public function __construct(Model $model){
      $this->model = $model;
    }

    public function index()
    {
      $rows = $this->model::order()->with($this->with())->paginate(5);
      $folderName = $routeName = $this->getTableNameFromModel();
      $modelName = $this->getModelName();
      $pluralModelName = $this->pluralModelName();
      $pageTitle = 'Control ' . $pluralModelName;
      $pageDes = 'Here You Can Add \ Edit \ Delete ' . $pluralModelName;
      return view($folderName.'.index', compact(
        'rows',
        'pageTitle',
        'pageDes',
        'modelName',
        'routeName',
        'folderName'
      ));
    }


    public function create()
    {
      $folderName = $routeName = $this->getTableNameFromModel();
      $modelName = $this->getModelName();
      $pageTitle = 'Add ' . $modelName;
      $pageDes = 'Here You Can Add ' . $modelName;
      $row = $this->model;
      return view($folderName.'.create', compact(
          'row',
          'pageTitle',
          'pageDes',
          'modelName',
          'routeName',
          'folderName'
      ));
    }


    public function edit($id)
    {
      $row = $this->model->FindOrFail($id);
      $folderName = $routeName = $this->getTableNameFromModel();
      $modelName = $this->getModelName();
      $pageTitle = 'Update ' . $modelName;
      $pageDes = 'Here You Can Update ' . $modelName;
      return view($folderName.'.edit', compact(
          'row',
          'pageTitle',
          'pageDes',
          'modelName',
          'routeName',
          'folderName'
      ));
    }

    public function destroy($id)
    {
        $folderName = $this->getTableNameFromModel();
        $this->model->FindOrFail($id)->delete();
        return redirect()->route($folderName . '.index');
    }

    protected function filter($rows){
        return $rows;
    }

    protected function with(){
        return [];
    }
    protected function getTableNameFromModel(){
        return strtolower($this->pluralModelName());
    }

    protected function pluralModelName()
    {
      return Pluralizer::plural($this->getModelName());
    }

    protected function getModelName()
    {
      return class_basename($this->model);
    }
}
