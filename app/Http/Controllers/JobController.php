<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;


class JobController extends Controller
{
    public function __construct(JobRepository $jobRepo)
    {
        $this->repo = $jobRepo;
    }

	public function save(Request $request)
	{
		$data = $request->all();
        $resp = $this->repo->save($data);
        if(!empty($resp))
        {
            return response()->json(['status' => 'success', 'message' => 'Record added successfully','code' => Status::HTTP_OK], Status::HTTP_OK);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Record not added successfully', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);            
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
