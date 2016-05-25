<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin/auth/login');
    }

    public function showContactsRoles()
    {
        return view('admin/contact/roles');
    }

    
    public function showReceipt()
    {
        return view('admin/receipt/receipt');
    }

    public function showUser()
    {
        return view('admin/user/user');
    }

    public function showCatItems()
    {
        return view('admin/receipt/cat_items');
    }


    public function showContacts()
    {
        return view('admin/contact/contact');
    }

    public function showSecurity()
    {
        return view('admin/security/permissions');
    }

    public function showModules()
    {
        return view('admin/security/modules');
    }

	public function logout()
	{
        \Request::session()->forget('user');
        echo '<script>window.location = "'.\URL::to('admin').'"</script>';
	}

    public function showPasswordReset($code)
    {
        $UserRepository = new UserRepository();
        $status = $UserRepository->verifyCode($code);
        return view('admin/auth/reset_password', array('code' => $code, 'status' => $status));
    }


}
