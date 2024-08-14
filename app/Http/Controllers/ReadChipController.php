<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Str;

class ReadChipController extends Controller
{
    public function read_chip(Request $request){
        // Retrieve the base64 string from the request
        $base64String = $request->header("data-image");

        // Decode the base64 string
        $imageData = base64_decode($base64String);

        // Define a file name and path
        $fileName = 'image_' . (string)Str::uuid() . '.png'; // Change extension if needed
        $filePath = 'images\\' . $fileName;
        // Save the image using Laravel's storage facade
        Storage::put($filePath, $imageData);
        try{
            $tesseract = new TesseractOCR("C:\\Users\\tuan\\Music\\read_chip\\storage\\app\\images\\".$fileName);
            $text = $tesseract->run();
            return $text;
        } catch (\Exception $e){
            return "fail";
        }


    }
}
