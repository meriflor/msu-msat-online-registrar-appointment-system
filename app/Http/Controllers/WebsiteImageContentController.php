<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteImageContent;
use Illuminate\Support\Facades\File;

class WebsiteImageContentController extends Controller
{
    public function updateImage(Request $request, $id){
        $imageWebsite = WebsiteImageContent::find($id);
        // $imageWebsite->file_name = $request->upload_web_image;
        $previousImage = public_path($imageWebsite->file_name);
        if (File::exists($previousImage)) {
            File::delete($previousImage);
        }
        $image = $request->file('upload_web_image');
        $timestamp = time();
        $fileName = $timestamp . '_' . $image->getClientOriginalName();
        $imagePath = $image->move(public_path('images/websiteImage'), $fileName);
        $imageWebsite->file_name = 'images/websiteImage/'.$fileName;
        $imageWebsite->save();
        return back();
    }
}
