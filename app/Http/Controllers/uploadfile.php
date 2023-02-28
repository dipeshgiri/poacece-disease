<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class uploadfile extends Controller
{
    public function uploaddisease(Request $req)
    {
            $fileName=$_FILES['filename']['name'];
            $tempName=$_FILES['filename']['tmp_name'];

            if(isset($fileName))
            {
                if(!empty($fileName))
                {
                    $location="/Volumes/DipeshDocuments/Major Project/poacece/poacece code/photos/";
                    if(move_uploaded_file($tempName,$location.$fileName))
                    {
                        $response = Http::get("http://localhost:8000/predictdisease/{$fileName}");
                        $data = json_decode($response);
                        return view('result')->with(['response'=>$data->class,'cure'=>$data->cure]);

                    }

                }
            }
    }

    public function uploadnutrient(Request $req)
    {
            $fileName=$_FILES['filename']['name'];
            $tempName=$_FILES['filename']['tmp_name'];

            if(isset($fileName))
            {
                if(!empty($fileName))
                {
                    $location="/Volumes/DipeshDocuments/Major Project/poacece/poacece code/photos/Nutrient/";
                    if(move_uploaded_file($tempName,$location.$fileName))
                    {
                        $response = Http::get("http://localhost:8000/predictnutrient/{$fileName}");
                        $data = json_decode($response);
                        return view('result-nutrient')->with(['response'=>$data]);
                        
                    }

                }
            }
    }
}
