<?php
namespace App\Repositories;
use App\Models\PaymentMode;
use App\Library\Utility;

class PaymentModeRepository
{
    function __construct() {

    }    

    public function save($data)
    {
        $rec = new PaymentMode();
        $rec->code = $data['code'];
        $rec->description =  $data['description'];
        $rec->created_by = \Session::get('user')['id']; 
        $rec->updated_by =  0;
        $rec->status =  $data['status'];
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
        $rec = PaymentMode::find($id);
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

    public function update($data)
    {
        $rec = PaymentMode::find($data['id']);
        $rec->code = $data['code'];
        $rec->description =  $data['description'];
        $rec->updated_by =  \Session::get('user')['id'];
        $rec->status =  $data['status'];
    
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
            $records = PaymentMode::paginate($limit);
        }
        else
        {
            $records = PaymentMode::get();
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
        $rec = PaymentMode::where($col, $operand, $val)->first();
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
            $rec = PaymentMode::find($id);
        }
        else
        {
            $rec = PaymentMode::find($id)->toArray();
        }
        return $rec;
    }

}