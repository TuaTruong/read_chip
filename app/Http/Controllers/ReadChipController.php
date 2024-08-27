<?php

namespace App\Http\Controllers;

use App\Models\Date;
use App\Models\Nickname;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Monolog\Logger;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Str;

class ReadChipController extends Controller
{
    public function read_chip(Request $request){
        $currentDayId = Date::firstOrCreate(["date"=>date('d-m-Y')])->id;

        // Retrieve the base64 string from the request
        $base64String = $request->header("data-image");
        $phoneNameData = $request->header("data-phone-id");
        $nickNameData = $request->header("data-nickname");


        $phoneId = Phone::firstOrCreate([
            "name"=>$phoneNameData,
            "date_id"=>$currentDayId
        ])->id;

        // Decode the base64 string
        $imageData = base64_decode($base64String);

        // Define a file name and path
        $fileName = 'image_' . (string)Str::uuid() . '.png'; // Change extension if needed
        $filePath = 'images\\' . $fileName;
        Storage::put($filePath, $imageData);
        $imagePath = storage_path()."\\app\\images\\".$fileName;
        try{
            $tesseract = new TesseractOCR($imagePath);
            $text = $tesseract->run();
            $nickname = Nickname::where("nickname",$nickNameData)->where("date_id",$currentDayId)->where("phone_id",$phoneId)->first();

            if($nickname){
                $nickname->chip = $text;
                $nickname->save();
            } else {
                Nickname::create([
                    "phone_id"=>$phoneId,
                    "date_id"=>$currentDayId,
                    "nickname"=>$nickNameData,
                    "chip" => $text,
                ]);
            }
            unlink($imagePath);
            return $text;
        } catch (\Exception $exception){
            return "fail";
        }
    }

    public function thong_ke_chip(Request $request){
        $currentDay = Date::firstOrCreate(["date"=>date('d-m-Y')]);

        $all_phones = $currentDay->phones;
        return view("thong_ke",compact("all_phones","currentDay"));
    }
}
