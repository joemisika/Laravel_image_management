<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\StoreGalleryRequest;
use VisitAfrica\Helpers\FileUploads;

class GalleriesController extends Controller
{
    protected $galleries;

    public function __construct(Gallery $galleries)
    {
        $this->galleries = $galleries;

        parent::__construct();
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
    public function store(StoreGalleryRequestRequest $request)
    {
        //$this->galleries->create($request->only('name', 'description', 'cover_image'));
        $gallery = new Gallery();
        if($request->hasFile('cover_image'))
        {
            $newUpload = new FileUploads();
            //get $result back from FileUploads Helper
            $result = $newUpload->uploadFile($request->file('cover_image'));
            //upload path
            $gallery->cover_image = $result[1].$result[0];
        }

        return redirect('')->with('status', 'gallery has been created successfully!!!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Confirm that you want to delete specified resource
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
