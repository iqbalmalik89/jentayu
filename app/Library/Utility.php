<?php

namespace App\Library;

class Utility
{
    public static function paginator($data, $paginate, $limit)
    {
        $data['paginator'] = array();

        // calculate next record
        if ($paginate->currentPage() < $paginate->lastPage()){
            $next = $paginate->currentPage()+1;
        } else {
            $next = null;
        }

        // calculate previous record
        if ($paginate->currentPage() > 1) {
            $previous = $paginate->currentPage()-1;
        } else {
          $previous = 1;
        }

        $data['paginator']['next']  = $next;
        $data['paginator']['previous'] = $previous;
        $data['paginator']['current']  = $paginate->currentPage();
        $data['paginator']['first']  = 1;
        $data['paginator']['last']  = $paginate->lastPage();
        $data['paginator']['total_pages']  = ceil($paginate->total() / $limit);  
        //        $data['pagination']['to']   = $paginate->getTo();
        //       $data['pagination']['from']  = $paginate->getFrom();
        $data['paginator']['total']  = $paginate->total();

        // return data and 200 response
        return $data;
    }

    public static function selectedNav($modules)
    {
       $class = '';
       $currentPath = \Route::getFacadeRoot()->current()->uri();
       foreach ($modules as $key => $module) {
        if($module == $currentPath)
        {
           return 'active';
        }
       else
           $class = '';
       }
       return $class;
    }

    // @user_type admin/super_admin/user
    public function getModuleAccess($module, $operation = '') 
    {
        $userSession = \Session::get('user');
        if(!empty($userSession['is_super_admin']))
        {
            if(!empty($operation))
                return true;
            else
                return array('add' => 1, 'update' => 1, 'delete' => 1, 'view' => 1);                
        }
        else
        {
            $userPermissions = $userSession['permissions'];
            if(!empty($userPermissions))
            {
                if(isset($userPermissions[$module]))
                {
                    if(!empty($operation))
                    {
                        if(isset($userPermissions[$module][$operation]))
                        {
                            return true;
                        }                        
                    }
                    else
                    {
                        $permissions = array();
                        // if superadmin
                        if(!empty($userPermissions[$module]))
                        {
                            return $userPermissions[$module];
                        }
                        else
                        {
                            return array();
                        }
                    }
                }
            }
        }

        return false;
    }

    public static function encryptDecrypt($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Jasonlovesphp';
        $secret_iv = 'Jasonlovesphp';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }    



    public static function isAdminUser()
    {
        if(\Session::get('user')['user_type'] == 'admin')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
   
}
