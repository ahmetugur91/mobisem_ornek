<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Location;
use App\LocationDetail;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::with(["user","detail"])->orderBy("id","desc")->paginate(20);

        return view("location.index",compact("locations"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("location.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $user = auth()->user();
        $location = Location::make($request->only(["name","city","district"]));
        $user->locations()->save($location);

        $location->detail()->save(LocationDetail::make($request->only(["lat","lng"])));
        return redirect()->route("location.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $location->load(["user","detail"]);
        return view("location.show",compact("location"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $this->authorize('update', $location);
        $location->load(["user","detail"]);
        return view("location.edit",compact("location"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LocationRequest $request
     * @param \App\Location $location
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(LocationRequest $request, Location $location)
    {
        $this->authorize('update', $location);

        $location->update($request->only(["name","city","district"]));
        $location->detail()->update($request->only(["lat","lng"]));

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $this->authorize('delete', $location);
        $location->delete();
        return redirect()->back();
    }
}
