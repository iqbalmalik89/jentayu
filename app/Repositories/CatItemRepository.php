<?php
namespace App\Repositories;
use App\Models\CatItem;
use App\Library\Utility;

class CatItemRepository
{
    function __construct() {

    }    

    public function save($data)
    {
        $rec = new CatItem();
        $rec->category = $data['category'];
        $rec->category_items =  $data['category_items'];
        $rec->qb_accountid =  $data['qb_accountid'];
        $rec->updated_by = \Session::get('user')['id'];

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
        $rec = CatItem::find($id);
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
        $rec = CatItem::find($data['entity_id']);
        $rec->category = $data['category'];
        $rec->category_items =  $data['category_items'];
        $rec->qb_accountid =  $data['qb_accountid'];
        $rec->created_by = \Session::get('user')['id'];
        $rec->updated_by = 0;

        if($rec->update())
        {
            return $rec->id;
        }
        else
        {
            return false;
        }
    }




    public function all($param)
    {
        $response = array('data' => array(), 'paginator' => '');
        if(!empty($param['limit']))
        {
            $records = CatItem::paginate($param['limit']);
        }
        else
        {
            $records = CatItem::get();
        }

        if(!empty($records))
        {
            foreach ($records as $key => $record) 
            {
                $response['data'][] = $this->get($record->id, false);
            }
        }

        if(!empty($param['limit']))
            $response = Utility::paginator($response, $records, $param['limit']);

        return $response;
    }



    public function getByCol($col, $val, $operand = '=')
    {
        $rec = CatItem::where($col, $operand, $val)->first();
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
            $rec = CatItem::find($id);
        }
        else
        {
            $rec = CatItem::find($id)->toArray();
            $rec['created_at_formatted'] = date('d/m/Y', strtotime($rec['created_at']));
        }
        return $rec;
    }

}