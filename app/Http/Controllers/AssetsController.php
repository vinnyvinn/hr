<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetType;
use App\Mail\ApproveAsset;
use App\Mail\AssetRejected;
use App\RequestAsset;
use App\ReturnAsset;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Vinn\Repository\AssetsRepo;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assets.index')->with('assets',Asset::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assets.create')->with('asset_types',AssetType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Asset::create($request->all());
        Session::flash('success','Asset successfully created');
        return redirect('assets');
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
        return view('assets.edit')->with('asset',Asset::find($id))->with('asset_types',AssetType::all());
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
        Asset::find($id)->update($request->all());
        Session::flash('success','Asset successfully updated');
        return redirect('assets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asset::destroy($id);
        Session::flash('success','Asset successfully deleted');
        return redirect()->back();
    }

    public function allAssetsRequested()
    {
        $assets = '';
        if (User::find(\Auth::id())->role->layout ==1){
         $assets = RequestAsset::whereHas('asset')->get();
        }
        $assets = RequestAsset::whereHas('asset')->where('user_id',\Auth::id())->get();

 return view('assets.requests.all')->with('assets',$assets);
     }
    public function requestedAsset()
    {
        return view('assets.requests.index')->with('users',User::all())->with('assets',Asset::all());
    }

    public function saveRequest()
    {

        RequestAsset::create(request()->all());
        Session::flash('success','Request successfully placed');
        return redirect('all-requested-assets');
    }

    public function returnAsset()
    {
        return view('assets.returns.index')->with('users',User::all())->with('assets',Asset::all());
    }

    public function saveAsset()
    {
        ReturnAsset::create(request()->all());
        Session::flash('success','Asset returned successfully');
        return redirect()->back();
    }

    public function assetRequests()
    {

        return view('assets.requests.requested_index')->with('assetss',RequestAsset::whereHas('asset')->get());
    }

    public function assetDetails($id)
    {
        $asset = AssetsRepo::init()->getAssetDetails($id);
        return response()->json($asset);
    }

    public function approveRequest($id)
    {
        $asset = RequestAsset::find($id);
        $asset->update(['status' => 1]);
        Mail::to('pj@wizag.biz')->send(new ApproveAsset([
            'asset' =>$asset,
            'url' => '/asset-requests'
        ]));
        Session::flash('success','Asset request successfully approved');
        return response()->json($asset);

    }
    public function rejectRequest($id)
    {
        $asset = RequestAsset::find($id);
         $asset->update(['status' => 2,'reject_reason' => request()->get('message')]);
         Mail::to($asset->user->email)->send(new AssetRejected([
             'user' => $asset->user,
             'message' => request()->get('message')

         ]));
        Session::flash('success','Asset request successfully rejected');
        return response()->json($asset);

    }
}
