<?php 

namespace Mixdinternet\Admix\Http\Controllers;

use Caffeinated\Flash\Facades\Flash;
use Mixdinternet\Admix\Http\Requests\ProfilesRequest;

class ProfileController extends AdmixController
{
    public function __construct()
    {

    }

    public function edit()
    {
        $view['user'] = auth()->user();

        return view('mixdinternet/admix::profile', $view);
    }

    public function update(ProfilesRequest $request)
    {
        $input = $request->all();
        if ($input['password'] == '') {
            unset($input['password']);
        }
        else {
            $input['password'] = bcrypt($input['password']);
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
}
