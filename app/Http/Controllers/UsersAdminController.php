<?php namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use Caffeinated\Flash\Facades\Flash;
use App\Http\Requests\EditUsersRequest;
use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\ProfilesRequest;
use Menu;

class UsersAdminController extends AdminController
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

        return view('admin.users.index', $view);
    }

    public function create(User $user)
    {
        $view['roles'] = $this->getRoles();
        $view['user'] = $user;

        return view('admin.users.form', $view);
    }

    public function store(CreateUsersRequest $request)
    {
        if (User::create($request->all())) {
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

        return view('admin.users.form', $view);
    }

    public function update(User $user, EditUsersRequest $request)
    {
        $input = $request->all();
        if ($input['password'] == '') {
            unset($input['password']);
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

    public function profile()
    {
        $view['user'] = auth()->user();

        return view('admin.users.profile', $view);
    }

    public function profileUpdate(ProfilesRequest $request)
    {
        $input = $request->all();
        if ($input['password'] == '') {
            unset($input['password']);
        }

        $user = auth()->user();

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

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admin.profile');
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
