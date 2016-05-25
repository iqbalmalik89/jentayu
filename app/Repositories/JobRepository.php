<?php

namespace App\Repositories;
use App\Models\Job;
use App\Models\Room;
use App\Library\Image;
use App\Library\Utility;

class JobRepository
{

    public function save($data)
    {
    	$data = $data['obj'];
    	// dd($data);	
    	$rec = new Job();
    	$rec->name = $data['full_name'];
    	$rec->address1 = $data['address1'];
    	$rec->address2 = $data['address2'];
    	$rec->town = $data['town'];
    	$rec->county = $data['county'];
    	$rec->postcode = $data['postcode'];
    	$rec->job_title = $data['job_title'];
    	$rec->job_description = $data['job_description'];

    	if($rec->save())
    	{
    		if(!empty($data['room_obj']))
    		{
    			foreach ($data['room_obj'] as $key => $room)
    			{
					$this->addRoom(new Image(), $rec->id, $room);
    			}
    		}
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
            $jobs = Job::paginate($limit);
        }
        else
        {
            $jobs = Job::get();
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

    public function get($id, $eleq)
    {
        $job = Job::find($id);
        if(!empty($job))
        {
            if($eleq)
            {
                return $job;
            }
            else
            {
                $job = $job->toArray();
                $job['rooms'] = $this->getRooms($job['id']);
            }            

            return $job;
        }
        else
        {
            return false;
        }


    }

    public function getRooms($jobId)
    {
        $response = array();
        $rooms = Room::where('job_id', $jobId)->get();
        if(!empty($rooms))
        {
            foreach ($rooms as $key => $room) {
                $response[] = $this->getRoom($room->id, false);
            }
        }
        return $response;
    }

    public function destroy($id)
    {
        $rec = $this->get($id, true);
        if(!empty($rec))
        {
            // delete rooms
            $this->deleteRooms($id);

            $rec->delete();
            return true;
        }
        else
        {
            return false;            
        }
    }

    public function deleteRooms($jobId)
    {
        Room::where('job_id', $jobId)->delete();
    }

    public function getRoom($id, $eleq)
    {
        $rec = Room::find($id);
        if(!empty($rec))
        {
            if($eleq)
            {
                return $rec;
            }
            else
            {
                $rec = $rec->toArray();
                $rec['room_image_url'] = \URL::to('data/room_images/'.$rec['room_image']);
            }            

            return $rec;
        }
        else
        {
            return false;
        }

    }


    public function addRoom($imageObj ,$jobId, $roomArr)
    {
    	$room = new Room();
    	$room->job_id = $jobId;
    	$room->room_name = $roomArr['room_name'];
    	$room->room_description = $roomArr['room_description'];
    	$image = $imageObj->baseToImage($roomArr['room_image']);
    	$room->room_image = $image;
    	if($room->save())
    	{
    		return $room->id;
    	}
    	else
    	{
    		return false;
    	}
    }

}