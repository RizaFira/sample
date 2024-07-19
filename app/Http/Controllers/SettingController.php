<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
{
    public function media()
    {
        $media = Media::first();
        $data['youtube'] = null;
        $data['images'] = null;
        $data['video'] = '';
        $data['footer'] = null;
        if($media){
            $data['youtube'] = $this->getYouTubeID($media->url);
            $data['images'] = json_decode($media->images);
            $data['video'] = $media->video ?? '';
            $data['footer'] = $media->footer;
        }

        return view('welcome',$data);
    }

    public function setting()
    {
        $data['media'] = Media::first();
        return view('setting',$data);
    }
    
    public static function getYouTubeID($url) {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|.+\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
    
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function update(Request $request)
    {
        $media = Media::first();
        if (!$media) {
            $media = new Media();
        }
        $media->url = $request->url;
        $media->footer = $request->footer;
        if ($request->file('video')) {
            if ($media->video) {
                $oldVideoPath = storage_path('app/videos/' . $media->video);
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }
    
            $video = $this->file($request->file('video'));
            $media->video = $video;
        }
        if($request->file('file')){
            $images = [];
            $n = 1;
            if($media->images){
                $images = json_decode($media->images);
                $n = count($images)+1;
            }
            foreach($request->file('file') as $image){
                $images[] = $this->file($image,time().'-'.$n);
                $n++;
            }
            $media->images = json_encode($images);
        }
        $media->save();
    
        return back();
    }

    public function deleteVideo(Request $request)
    {
        $media = Media::first();
        if(!$media){
            return back();
        }
        $oldVideoPath = storage_path('app/videos/' . $media->video);
        if (file_exists($oldVideoPath)) {
            unlink($oldVideoPath);
        }
        $media->video = null;
        $media->save();
        return back();

    }

    public function deleteImage(Request $request,$name)
    {
        $media = Media::first();
        if(!$media){
            return back();
        }
        $images = json_decode($media->images);
        $index = array_search($name, $images);
        if ($index !== false) {
            unset($images[$index]);
            $oldImage = storage_path('app/images/' . $name);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            $images = array_values($images);
            $media->images = json_encode($images);
            $media->save();
            return back()->with('success', 'Image deleted successfully.');
        }
        return back();

    }

    public static function file($file,$name=null)
    {
        $ext = $file->getClientOriginalExtension();
        $filename = $name. '.' . $ext;
        if(!$name){
            $filename = time() . '.' . $ext;
        }
    
        $videoExtensions = ['mp4', 'mpeg', 'gif', 'MP4', 'GIF', 'MPEG'];
        $imageExtensions = ['jpg', 'jpeg', 'png', 'PNG', 'JPEG', 'JPG'];
    
        if (in_array($ext, $imageExtensions, true)) {
            $file->storeAs('images', $filename);
            return $filename;
        } else if (in_array($ext, $videoExtensions, true)) {
            $file->storeAs('videos', $filename);
            return $filename;
        } else {
            return null;
        }
    }
}
