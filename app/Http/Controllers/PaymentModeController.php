<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\PaymentModeRepository;
use Illuminate\Http\Request;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;


class PaymentModeController extends Controller
{
    public function __construct(PaymentModeRepository $repo)
    {
        $this->repo = $repo;
    }

	public function save(Request $request)
	{
		$data = $request->all();
        $exists = $this->repo->getByCol('code', $data['code']);
        if(!$exists)
        {
            $resp = $this->repo->save($data);            
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Payment Mode Code already exists', 'code' => Status::HTTP_CONFLICT], Status::HTTP_CONFLICT);            
        }

        if(!empty($resp))
        {
            return response()->json(['status' => 'success', 'message' => 'Record added successfully','code' => Status::HTTP_OK], Status::HTTP_OK);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Record not added successfully', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);            
        }
	}

    public function update(Request $request)
    {
        $data = $request->all();
        $exists = $this->repo->getByCol('code', $data['code']);

        if($data['id'] != $exists->id && !empty($exists->id))
        {
            return response()->json(['status' => 'error', 'message' => 'Payment Mode Code already exists', 'code' => Status::HTTP_CONFLICT], Status::HTTP_CONFLICT);
        }
        else
        {
            $resp = $this->repo->update($data);            
        }

        if(!empty($resp))
        {
            return response()->json(['status' => 'success', 'message' => 'Record updated successfully','code' => Status::HTTP_OK], Status::HTTP_OK);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Record not updated successfully', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);            
        }
    }

    public function get($id)
    {
        $resp = $this->repo->get($id, false);
        if(!empty($resp))
        {
            return response()->json(['status' => 'success', 'data' => $resp, 'code' => Status::HTTP_OK], Status::HTTP_OK);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Record not found', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        $resp = $this->repo->destroy($id);
        if(!empty($resp))
        {
            return response()->json(['status' => 'success', 'message' => 'Record deleted successfully','code' => Status::HTTP_OK], Status::HTTP_OK);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Record not deleted', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);            
        }
    }


    public function all(Request $request)
    {
        $data = $this->repo->all($request->input('page'), $request->input('limit'));
        if(!empty($data))
        {
            return response()->json(['status' => 'success','data' => $data , 'message' => 'Record added successfully','code' => Status::HTTP_OK], Status::HTTP_OK);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'No Records', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);            
        }

    }

}
