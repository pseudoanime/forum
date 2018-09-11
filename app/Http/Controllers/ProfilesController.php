<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Log;

/**
 * Class ProfilesController
 *
 * @package App\Http\Controllers
 */
class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * show
     *
     * @param User $user
     *
     * @return $this
     */
    public function show(User $user)
    {
        Log::debug(__METHOD__ . " : bof");

        return view('profiles.show', [
            'profileUser' => $user,
            'activities'  => $this->getActivity($user)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * getActivity
     *
     * @param User $user
     *
     * @return mixed
     */
    protected function getActivity(User $user)
    {
        return $user->activity()->with('subject')->take(50)->get()->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}
