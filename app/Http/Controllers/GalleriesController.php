<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Helpers\FileUploads;

class GalleriesController extends Controller
{
   protected $galleries;

   public function __construct(Gallery $galleries)
   {
      $this->galleries = $galleries;
   }

   /**
   * Display a listing of the galleries.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      //You can then use it like this
      //$galleries = Gallery::with('Images')->get();

      //OR like this especially if you are coming from a CI background
      $galleries = $this->galleries->with('Images')->get();

      return view('galleries.index', compact('galleries'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create(Gallery $gallery)
   {
      return view('galleries.form', compact('gallery'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(StoreGalleryRequest $request)
   {

      $gallery = new Gallery();
      if($request->hasFile('cover_image'))
      {
         $newUpload = new FileUploads();
         //get $result back from FileUploads Helper
         $result = $newUpload->uploadFile($request->file('cover_image'));
         //upload path plus name of image
         $gallery->cover_image = $result[1].$result[0];
      }

      $gallery->name = $request->name;
      $gallery->slug = str_slug($gallery->name);
      $gallery->description = $request->description;
      $gallery->save();

      //redirect back to the form after successfully add the information
      return redirect(route('galleries.create'))->with('status', 'gallery has been created successfully!!!');
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
        //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $gallery = $this->galleries->findorFail($id);
      return view('galleries.form', compact('gallery'));
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
	public function update(UpdateGalleryRequest $request, $id)
	{
		$gallery = $this->galleries->findorFail($id);
		if($request->hasFile('cover_image'))
		{
			$newUpload = new FileUploads();
			//get $result back from FileUploads Helper
         $result = $newUpload->uploadFile($request->file('cover_image'));
         //upload path plus name of image
         $gallery->cover_image = $result[1].$result[0];
		}

		$gallery->name = $request->name;
      $gallery->slug = str_slug($gallery->name);
      $gallery->description = $request->description;
      $gallery->save();

      return redirect(route('galleries.edit', $gallery->id))->with('status', 'Gallery has been edited successfully');
	}

   /**
   * Confirm that you want to delete specified resource
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
   public function confirm($id)
   {
      $gallery = $this->galleries->findOrFail($id);

      return view('galleries.confirm', compact('gallery'));
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      $gallery = $this->galleries->findOrFail($id);

      //$files = [];
      //File::delete($gallery->cover_image);

      $gallery->delete();

      return redirect(route('galleries.index'))
         ->with('status', 'Gallery has been deleted');
   }
}