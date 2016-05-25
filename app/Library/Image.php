<?php
namespace App\Library;


class Image
{

	public function baseToImage($bytestram)
	{

		// $bytestram =  'data:image/jpeg;base64,'.$bytestram;
		// list($type, $bytestram) = explode(';', $bytestram);
		// list(, $bytestram)      = explode(',', $bytestram);

		$exts = array('data:image/jpeg;base64,', 'data:image/jpg;base64,', 'data:image/png;base64,');
		foreach ($exts as $key => $ext) 
		{
			$bytestram = str_replace($ext, '', $bytestram);
		}

		$bytestram = base64_decode($bytestram);

		$fileName = time().'.jpg';

		file_put_contents(public_path().DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'room_images'.DIRECTORY_SEPARATOR.$fileName, $bytestram);
		return $fileName;
	}

}