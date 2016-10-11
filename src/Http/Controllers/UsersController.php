<?php

namespace Mixdinternet\Admix\Http\Controllers;

use Mixdinternet\Admix\User;
use Mixdinternet\Admix\Role;
use Illuminate\Http\Request;
use Caffeinated\Flash\Facades\Flash;
use Mixdinternet\Admix\Http\Requests\EditUsersRequest;
use Mixdinternet\Admix\Http\Requests\CreateUsersRequest;

class UsersController extends AdmixController
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        session()->put('backUrl', request()->fullUrl());

        $trash = ($request->segment(3) == 'trash') ? true : false;

        $query = User::sort();
        ($trash) ? $query->onlyTrashed() : '';

        $search = [];
        $search['name'] = $request->input('name', '');
        $search['status'] = $request->input('status', '');
        $search['email'] = $request->input('email', '');

        ($search['name']) ? $query->where('name', 'LIKE', '%' . $search['name'] . '%') : '';
        ($search['email']) ? $query->where('email', 'LIKE', '%' . $search['email'] . '%') : '';
        ($search['status']) ? $query->where('status', $search['status']) : '';

        $users = $query->paginate(50);

        $view['trash'] = $trash;
        $view['search'] = $search;
        $view['users'] = $users;

        return view('mixdinternet/admix::users.index', $view);
    }

    public function create(User $user)
    {
        $view['roles'] = $this->getRoles();
        $view['user'] = $user;

        return view('mixdinternet/admix::users.form', $view);
    }

    public function store(CreateUsersRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        if (User::create($input)) {
            Flash::success('Item inserido com sucesso.');
        } else {
            Flash::error('Falha no cadastro.');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        $view['roles'] = $this->getRoles();
        $view['user'] = $user;

        return view('mixdinternet/admix::users.form', $view);
    }

    public function update(User $user, EditUsersRequest $request)
    {
        $input = $request->all();
        if ($input['password'] == '') {
            unset($input['password']);
        } else {
            $input['password'] = bcrypt($input['password']);
        }

        if (isset($input['remove'])) {
            foreach ($input['remove'] as $k => $v) {
                $user->{$v}->destroy();
                $user->{$v} = STAPLER_NULL;
            }
        }

        if ($user->update($input)) {
            Flash::success('Item atualizado com sucesso.');
        } else {
            Flash::error('Falha na atualização.');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.users.index');
    }

    public function destroy(Request $request)
    {
        if (User::destroy($request->input('id'))) {
            Flash::success('Item removido com sucesso.');
        } else {
            Flash::error('Falha na remoção.');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.users.index');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);

        if (!$user) {
            abort(404);
        }

        if ($user->restore()) {
            Flash::success('Item restaurado com sucesso.');
        } else {
            Flash::error('Falha na restauração.');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.users.trash');
    }

    private function getRoles()
    {
        $roles = Role::sort()->get()->pluck('id', 'name');

        $arrayRoles = [];
        foreach ($roles as $k => $v) {
            $arrayRoles[$v] = $k;
        }

        return $arrayRoles;
    }
}
