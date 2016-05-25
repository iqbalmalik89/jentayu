<?php
namespace App\Repositories;
use App\Models\Contact;
use App\Models\ContactRole;
use App\Library\Utility;

class ContactRepository
{
    function __construct() {

    }    

    public function save($data)
    {
        $rec = new Contact();
        $rec->name = $data['name'];
        $rec->nric = $data['nric'];
        if(!empty($data['dob']))
            $rec->dob = date('Y-m-d', strtotime($data['dob']));

        if(!empty($data['cob']))
            $rec->cob = date('Y-m-d', strtotime($data['cob']));

        $rec->sex = $data['sex'];
        $rec->citizenship = $data['citizenship'];
        $rec->race = $data['race'];
        $rec->marital_status = $data['marital_status'];
        $rec->address1 = $data['address1'];
        $rec->address2 = $data['address2'];
        $rec->address3 = $data['address3'];
        $rec->address4 = $data['address4'];
        $rec->postal_code = $data['postal_code'];
        $rec->email = $data['email'];
        $rec->home_phone = $data['home_phone'];
        $rec->mobile_phone = $data['mobile_phone'];
        $rec->status = $data['contact_status'];

        if(isset($data['religion']))
            $rec->religion = $data['religion'];
        if(isset($data['dialect']))
            $rec->dialect = $data['dialect'];

        $rec->created_by = \Session::get('user')['id'];
        $rec->updated_by = 0;

        if($rec->save())
        {
            return $rec->id;
        }
        else
        {
            return false;
        }
    }

    public function destroy($id)
    {
        $rec = Contact::find($id);
        if(!empty($rec))
        {
            $rec->delete();
            ContactRole::where('contact_id', $id)->delete();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update($data)
    {
        $rec = Contact::find($data['id']);


        $rec->name = $data['name'];
        $rec->nric = $data['nric'];

        if(!empty($data['dob']))
            $rec->dob = date('Y-m-d', strtotime($data['dob']));

        if(!empty($data['cob']))
            $rec->cob = date('Y-m-d', strtotime($data['cob']));

        $rec->sex = $data['sex'];
        $rec->citizenship = $data['citizenship'];
        $rec->race = $data['race'];
        $rec->marital_status = $data['marital_status'];
        $rec->address1 = $data['address1'];
        $rec->address2 = $data['address2'];
        $rec->address3 = $data['address3'];
        $rec->address4 = $data['address4'];
        $rec->postal_code = $data['postal_code'];
        $rec->email = $data['email'];
        $rec->home_phone = $data['home_phone'];
        $rec->mobile_phone = $data['mobile_phone'];
        $rec->status = $data['contact_status'];

        if(isset($data['religion']))
            $rec->religion = $data['religion'];
        if(isset($data['dialect']))
            $rec->dialect = $data['dialect'];

        $rec->updated_by = \Session::get('user')['id'];
    
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

    public function all($params)
    {
        $response = array('data' => array(), 'paginator' => '');

        if(!empty($params['limit']))
        {
            $records = Contact::SearchByKeyword($params['search_keyword'])->paginate($params['limit']);
        }
        else
        {
            $records = Contact::SearchByKeyword($params['search_keyword'])->get();
        }

        if(!empty($records))
        {
            foreach ($records as $key => $record) 
            {
                $response['data'][] = $this->get($record->id, false);
            }
        }

        if(!empty($params['limit']))
            $response = Utility::paginator($response, $records, $params['limit']);

        return $response;
    }



    public function getByCol($col, $val, $operand = '=')
    {
        $rec = Contact::where($col, $operand, $val)->first();
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
            $rec = Contact::find($id);
        }
        else
        {
            $rec = Contact::find($id)->toArray();
        }
        return $rec;
    }

}