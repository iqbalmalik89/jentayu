<?php
namespace App\Repositories;
use App\Models\Module;
use App\Models\Operation;
use App\Models\UserPermission;
use App\Library\Utility;

class ModuleRepository
{
    function __construct() {

    }    

    public function save($data)
    {
        $rec = new Module();
        $rec->module = $data['module'];
        $rec->status =  $data['module_status'];
        if($rec->save())
        {
            $this->addOperations($rec->id);
            return $rec->id;
        }
        else
        {
            return false;
        }
    }

    public function getUserPerm($userId)
    {
        $userOperationsIds = [];
        $userOperations = $this->getUserOperations($userId);
        foreach ($userOperations as $key => $userOperation) {
            $userOperationsIds[] = $userOperation['operation_id'];
        }


        $modules = $this->all(0, 0);
        foreach ($modules['data'] as $key => &$module) 
        {
            foreach ($module['operations'] as $key => &$operation) {
                $operation['access'] = 0;
                if(in_array($operation['id'], $userOperationsIds))
                {
                    $operation['access'] = 1;
                }                
            }
        }

        return $modules;
    }

    public function getUserOperations($userId)
    {
        return $recs = UserPermission::where('user_id', $userId)->get()->toArray();
    }

    public function addOperations($moduleId)
    {
        $operations = array('add' => 'Add', 'update' => 'Update', 'delete' => 'Delete', 'view' => 'View');
        foreach ($operations as $shortCode => $operation) {
            $rec = new Operation();
            $rec->module_id = $moduleId;
            $rec->operation = $operation;
            $rec->short_code = $shortCode;
            $rec->save();
        }
    }

    public function getOperations($moduleId)
    {
        return Operation::where('module_id', $moduleId)->get()->toArray();
    }

    public function destroy($id)
    {
        $rec = Module::find($id);
        if(!empty($rec))
        {
            $rec->delete();
            Operation::where('module_id', $id)->delete();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update($data)
    {
        $rec = Module::find($data['id']);
        $rec->module = $data['module'];
        $rec->status =  $data['module_status'];
    
        if($rec->update())
        {
            return $rec->id;
        }
        else
        {
            return false;
        }
    }

    public function saveUserPerm($userId, $permissions)
    {
        $this->delUserPermission($userId);
        foreach ($permissions as $key => $permission) 
        {
            $this->addUserPermission($userId, $permission);
        }

        return true;
    }

    public function addUserPermission($userId, $permissionId)
    {
        $rec = new UserPermission();
        $rec->user_id = $userId;
        $rec->operation_id = $permissionId;
        $rec->created_at = date('Y-m-d H:i:s');
        if($rec->save())
        {
            return $rec->id;
        }
        else
        {
            return false;
        }
    }

    public function delUserPermission($userId)
    {
        UserPermission::where('user_id', $userId)->delete();
    }

    public function all($page, $limit)
    {
        $response = array('data' => array(), 'paginator' => '');
        if(!empty($limit))
        {
            $records = Module::paginate($limit);
        }
        else
        {
            $records = Module::get();
        }

        if(!empty($records))
        {
            foreach ($records as $key => $record) 
            {
                $response['data'][] = $this->get($record->id, false);
            }
        }

        if(!empty($limit))
            $response = Utility::paginator($response, $records, $limit);

        return $response;
    }



    public function getByCol($col, $val, $operand = '=')
    {
        $rec = Module::where($col, $operand, $val)->first();
        if(!empty($rec))
        {
            $rec = $this->get($rec->id, false);
        }

        return $rec;
    }

    public function get($id, $eleq)
    {
        $id = (int) $id;
        if($eleq)
        {
            $rec = Module::find($id);
        }
        else
        {
            $rec = Module::find($id)->toArray();
            $rec['operations'] = $this->getOperations($id);
        }
        return $rec;
    }

}