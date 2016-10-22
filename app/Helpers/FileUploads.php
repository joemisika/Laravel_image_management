<?php

namespace VisitAfrica\Helpers;

use File;
use Image;

class FileUploads {

    /**
     * @param $fileName
     * Check that the directory exists if not then create a new one
     * @return array
     */
    public function uploadFile($fileName)
    {
        //New directory goes into uploads then becomes year/month/date like facebook
        $upload_dir = 'uploads/'.date('Y').'/'.date('m').'/'.date('d').'/';

        //check if the file exists and if it doesn't create a new one
        if(!file_exists($upload_dir))
        {
            $result = File::makeDirectory('uploads/'.date('Y').'/'.date('m').'/'.date('d').'/', 0775, true);
        }
        else
        {

            //return $result;
        }

        //Get a new filename and upload it to the new directory
        $image_name = $fileName->getClientOriginalName();
        $fileName->move($upload_dir, $image_name);

        //Define image sizes
        $resizes = [
            //name, width, height
            'resize300' => ['main_cat', 300, 200],
            'resize200' => ['main_200', 200, 133],
            'resize160' => ['thumb', 160, 120]
        ];

        //Go through the sizes and create new images with their sizes
        foreach($resizes as $resize=>$key)
        {
            $img = Image::make(sprintf($upload_dir.$image_name))->resize($key[1],$key[2]);
            $img->save($upload_dir.$key[0].'_'.$image_name);
        }

        //send the result back to the controller
        $result = [$image_name, $upload_dir];
        return $result;
    }
}