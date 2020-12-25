<?php

namespace App\Http\Controllers;

use App\Http\Requests\PicturePostRequest;
use Illuminate\Http\Request;
use App\Slice;
use App\Picture;
use Intervention\Image\Facades\Image as ImageInt;
use Illuminate\Support\Facades\Storage;

class PicturesController extends Controller
{
    function form() 
	{
		return view('form');
	}
	
	function save(PicturePostRequest $request) 
	{
		if($request->hasFile('file')) {
            $file = $request->file('file');
			$filename = mt_rand(999, 999999) . "_" . time() .'.' . $file->getClientOriginalExtension() ?: 'png';
            $file->move(public_path() . '/images', $filename);
			$path = public_path() . '/images/'.$filename;
        }
		
		$picture = new Picture;
		$picture->path = '/images/'.$filename;
		$picture->name = $request->input('name');
		$picture->save();

		if (exif_imagetype($path) == IMAGETYPE_PNG) {
			$src = ImageCreateFromPNG($path);
		} else {
			$src = imagecreatefromjpeg($path); 
		}

		$size_x = imageSX($src);
		$size_y = imageSY($src);
		$constant = 2;
		$cut_w = $size_x%$constant;
		$cut_h = $size_y%$constant;
		$size_x=$size_x-$cut_w;
		$size_y=$size_y-$cut_h;
		$size_x1 = 0;
		$size_y1 = 0;
		for ($i = 0; $i < $constant; $i++) {
			for ($j = 0; $j < $constant; $j++) {
				$im2[$i][$j] = imagecreatetruecolor($size_x / $constant, $size_y / $constant);
				imagecopy($im2[$i][$j], $src, 0, 0, $size_x1, $size_y1, $size_x / $constant, $size_y / $constant);
				if (exif_imagetype($path) == IMAGETYPE_PNG) {
					$puthSlice = '/images/' . $i . '-' . $j . '-' . $picture->id . '.png';
					imagePNG($im2[$i][$j], public_path() . '/images/' . $i . '-' . $j . '-' . $picture->id . '.png');
				} else {
					$puthSlice = '/images/' . $i . '-' . $j . '-' . $picture->id . '.jpg';
					imageJPEG($im2[$i][$j], public_path() . '/images/' . $i . '-' . $j . '-' . $picture->id . '.jpg');
				}
				$slice = new Slice();
				$slice->number = (int)$i . $j;
				$slice->path = $puthSlice;
				$slice->picture_id = $picture->id;
				$slice->save();

				$size_x1 = $size_x1 + ($size_x / $constant);
			}
			$size_y1 = $size_y1 + ($size_y / $constant);
			$size_x1 = 0;
		}
		
		return redirect()->route('image', ['pict_id' => $picture->id]);
	}

	function image($pict_id) 
	{
		
		$picture = Picture::findOrFail($pict_id);
		$slices = $picture->slices()->get();

		return view('image',['pictures' => $picture, "slices" => $slices]);
	}

	function slice($pict_id, $slice_id) 
	{
		$slice = Slice::findOrFail($slice_id);

		return view('slice',["slice" => $slice]);
	}

	function slice_list($pict_id) 
	{
		$picture = Picture::findOrFail($pict_id);
		$slices = $picture->slices()->get();
		$slicePath = [];
		foreach ($slices as $slice) {
			$slicePath[] = route('download_slice',['slice_id' => $slice->id]);
		}

		return response()->json($slicePath);
	}

	function download_slice($slice_id) 
	{
		$slice = Slice::findOrFail($slice_id);
		return response()->download(public_path().$slice->path);
	}
}
