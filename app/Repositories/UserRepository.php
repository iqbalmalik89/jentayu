<?php
namespace App\Repositories;
use App\Models\User;
use App\Library\Utility;

class UserRepository
{

    public function login($email, $password, $rememberMe)
    {
        $user = $this->getByCol('email', $email);
        if(!empty($user))
        {
            if (\Hash::check($password, $user->password))
            {
                $this->setUserSession($user);
                return true;
            }
            else
            {
                return false;
            }
        }
        return $user;
    }

    public function destroy($id)
    {
        $rec = User::find($id);
        if(!empty($rec))
        {
            $rec->delete();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function save($data)
    {
        $user = new User();
        $user->name = $data['user_name'];
        $user->email =  $data['user_email'];
        $user->password = \Hash::make($data['user_password']);
        $user->status = $data['user_status'];
        if($user->save())
        {
            return $user->id;
        }
        else
        {
            return false;
        }
    }

    public function update($data)
    {
        $user = User::find($data['id']);
        $user->name = $data['user_name'];
        $user->email =  $data['user_email'];
    
        if(!empty($data['user_password']))
            $user->password = \Hash::make($data['user_password']);
    
        $user->status = $data['user_status'];
        if($user->update())
        {
            return $user->id;
        }
        else
        {
            return false;
        }
    }

    public function setUserSession($user)
    {
        $user->password = '';
        $user->operations = '';
        \Request::session()->put('user', $user->toArray());
    }

    public function forgotPasswordReq($email)
    {
        $user = $this->getByCol('email', $email);
        if(!empty($user))
        {
            $code = md5(time());
            $user->link = \URL::to('admin/verify/'.$code);

            \Mail::send('admin.emails.forgot_email', ['user' => $user], function ($m) use ($user) {
                $m->from('smtp@vegatechnologies.net', 'Jentayu');
                $m->to($user->email, $user->name)->subject('Forgot Password');
            });

            $this->updateCode($user->id, $code);
            return true;
        }
        else
        {
            return true;
        }
    }


    public function resetPassword($id, $password)
    {  
        $user = $this->get($id, true);
        if(!empty($user))
        {
            $user->password = \Hash::make($password);
            $user->code = '';
            $user->update();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function verifyCode($code)
    {
        $user = $this->getByCol('code', $code);
        if(!empty($user))
        {
            return $user->id;
        }
        else
        {
            return false;
        }
    }

    public function updateCode($id, $code)
    {
        $user = $this->get($id, true);
        if(!empty($user))
        {
            $user->code = $code;
            $user->update();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function all($page, $limit)
    {
        $response = array('data' => array(), 'paginator' => '');
        if(!empty($limit))
        {
            $jobs = User::paginate($limit);
        }
        else
        {
            $jobs = User::get();
        }

        if(!empty($jobs))
        {
            foreach ($jobs as $key => $job) 
            {
                $response['data'][] = $this->get($job->id, false);
            }
        }

        if(!empty($limit))
            $response = Utility::paginator($response, $jobs, $limit);

        return $response;
    }

    public function getByCol($col, $val, $operand = '=')
    {
        $user = User::where($col, $operand, $val)->first();
        if(!empty($user))
        {
            $user = $this->get($user->id, false);
        }

        return $user;
    }

    public function get($id, $eleq)
    {
        $moduleRepo = new ModuleRepository();
        $id = (int) $id;
        if($eleq)
        {
            $user = User::find($id);
        }
        else
        {
            $user = User::find($id);
            $user['operations'] = $moduleRepo->getUserPerm($id);
        }
        return $user;
    }

}