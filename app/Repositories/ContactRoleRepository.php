<?php
namespace App\Repositories;
use App\Models\RoleType;
use App\Models\ContactRole;
use App\Library\Utility;

class ContactRoleRepository
{
    function __construct() {

    }    

    public function save($data)
    {
        $rec = new RoleType();
        $rec->role = $data['role'];
        $rec->status =  $data['role_status'];
        if($rec->save())
        {
            return $rec->id;
        }
        else
        {
            return false;
        }
    }

    public function saveAllContactRoles($id, $roles)
    {
        if(!empty($roles['role_ids']))
        {
            foreach ($roles['role_ids'] as $key => $role) {

                if(!$this->isContactRole($id, $role))
                {
                    $this->addContactrole($id, $role);
                }
            }
        }

        $contactRolesIds = $this->getContactRolesIds($id);
        if(!empty($contactRolesIds))
        {
            foreach ($contactRolesIds as $key => $contactRolesId) 
            {
                if(!in_array($contactRolesId, $roles['role_ids']))
                {
                    $this->deleteContactRole($id, $contactRolesId);
                }
            }
        }

        return true;
    }

    public function deleteContactRole($contactId, $contactRolesId)
    {
        $rec = ContactRole::where('contact_id', $contactId)->where('role_type_id', $contactRolesId);
        if($rec->count())
        {
            $rec->delete();
        }
        return true;
    }

    public function addContactrole($contactId, $roleTypeId)
    {
        $rec = new ContactRole();
        $rec->contact_id = $contactId;
        $rec->role_type_id = $roleTypeId;
        if($rec->save())
        {
            return $rec->id;
        }
        else
        {
            return false;
        }
    }

    public function isContactRole($contactId, $roleTypeId)
    {
        return ContactRole::where('contact_id', $contactId)->where('role_type_id', $roleTypeId)->count();
    }

    public function getAllContactRoles($id)
    {
        $contactRolesIds = $this->getContactRolesIds($id);

        $allRoles = $this->all(0, 0);
        foreach ($allRoles['data'] as $key => &$role) {
            if(in_array($role['id'], $contactRolesIds))
            {
                $role['assigned'] = 1;
            }
            else
            {
                $role['assigned'] = 0;                
            }
        }

        return $allRoles['data'];
    }

    public function getContactRolesIds($id)
    {
        $contactRoles = ContactRole::where('contact_id', $id)->get();
        $contactRolesIds = [];
        foreach ($contactRoles as $key => $contactRole) 
        {
            $contactRolesIds[] = $contactRole->role_type_id;
        }
        return $contactRolesIds;
    }

    public function destroy($id)
    {
        $rec = RoleType::find($id);
        if(!empty($rec))
        {
            $rec->delete();
            ContactRole::where('role_type_id', $id)->delete();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update($data)
    {
        $rec = RoleType::find($data['id']);
        $rec->role = $data['role'];
        $rec->status =  $data['role_status'];
    
        if($rec->update())
        {
            return $rec->id;
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
            $records = RoleType::paginate($limit);
        }
        else
        {
            $records = RoleType::get();
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
        $rec = RoleType::where($col, $operand, $val)->first();
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
            $rec = RoleType::find($id);
        }
        else
        {
            $rec = RoleType::find($id)->toArray();
        }
        return $rec;
    }

}