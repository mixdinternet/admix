<?php namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

use Caffeinated\Flash\Facades\Flash;
use App\Http\Requests\RolesRequest;
use Menu;

class RolesAdminController extends AdminController
{

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        session()->put('backUrl', request()->fullUrl());

        $model = Role::sort();
        $search = [];
        $search['name'] = $request->input('name', '');
        $search['status'] = $request->input('status', '');

        ($search['name']) ? $model->where('name', 'LIKE', '%' . $search['name'] . '%') : '';
        ($search['status']) ? $model->where('status', $search['status']) : '';

        $roles = $model->paginate(50);

        $view['search'] = $search;
        $view['roles'] = $roles;

        return view('admin.roles.index', $view);
    }

    public function create(Role $role)
    {
        $view['rules'] = $this->getRules();
        $view['role'] = $role;

        return view('admin.roles.form', $view);
    }

    public function store(RolesRequest $request)
    {
        if (Role::create($request->all())) {
            Flash::success('Item inserido com sucesso.');
        } else {
            Flash::error('Falha no cadastro.');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        $view['rules'] = $this->getRules();
        $view['role'] = $role;

        return view('admin.roles.form', $view);
    }

    public function update(Role $role, RolesRequest $request)
    {
        if ($role->update($request->all())) {
            Flash::success('Item atualizado com sucesso.');
        } else {
            Flash::error('Falha na atualização.');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.roles.index');
    }

    public function destroy(Request $request)
    {
        if (Role::destroy($request->input('id'))) {
            Flash::success('Item removido com sucesso.');
        } else {
            Flash::error('Falha na remoção.');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.roles.index');
    }

    private function getRules()
    {
        $rules = Menu::instance('adminlte-permissions');
        #dd($permissions->getItems());
        return $rules->getItems();
    }
}
