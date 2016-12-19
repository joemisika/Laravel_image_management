<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Gallery;
use App\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

use App\Helpers\FileUploads;

class ImagesController extends Controller
{

   protected $images;

   public function __construct(Image $images)
   {
      $this->images = $images;
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $images = $this->images->with('Gallery')->get();
      return view('images.index', compact('images'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create(Image $image)
   {
      $galleries = $this->getGalleries();
      //print_r($galleries);
      return view('images.form', compact('image', 'galleries'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(StoreImageRequest $request)
   {
      $image = new Image();
      if($request->hasFile('image'))
      {
         $newUpload = new FileUploads();
         //get $result back from FileUploads Helper
         $result = $newUpload->uploadFile($request->file('image'));
         //upload path plus name of image
         $image->image = $result[1].$result[0];
      }

      $image->gallery_id = $request->gallery_id;
      $image->title = $request->title;
      $image->description = $request->description;
      $image->image_credit = $request->image_credit;
      $image->save();

      //redirect back to the form after successfully add the information
      return redirect(route('images.create'))->with('status', 'image has been created successfully!!!');
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
      $image = $this->images->findorFail($id);
      $galleries = $this->getGalleries();

      return view('galleries.form', compact('image', 'galleries'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(UpdateImageRequest $request, $id)
   {
      $image = new Image();
      if($request->hasFile('image'))
      {
         $newUpload = new FileUploads();
         //get $result back from FileUploads Helper
         $result = $newUpload->uploadFile($request->file('image'));
         //upload path plus name of image
         $image->image = $result[1].$result[0];
      }

      $image->name = $request->title;
      $image->description = $request->description;
      $image->image_credit = $request->image_credit;
      $image->save();

      //redirect back to the edit after successfully editing the information
      return redirect(route('backend.destinations.edit', $image->id))
            ->with('status', 'Image edited successfully!');
   }

   /**
   * Confirm that you want to delete specified resource
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
   public function confirm($id)
   {
      $image = $this->images->findOrFail($id);
      return view('images.confirm', compact('image'));
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      $image = $this->images->findOrFail($id);

      $image->delete();

      return redirect(route('images.index'))
            ->with('status', 'Image has been deleted');
   }

   /*
   * Create a lists of available galleries
   *
   * @return array()
   */
   protected function getGalleries()
   {
      $galleries = Gallery::pluck('name', 'id');
      return $galleries;
   }
}
