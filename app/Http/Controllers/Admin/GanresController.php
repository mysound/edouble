<?php

namespace App\Http\Controllers\Admin;

use App\Ganre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GanresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ganres.index', [
            'ganres' => Ganre::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ganres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|min:2',
        ]);

        Ganre::create($request->all());

        return redirect()->route('admin.ganre.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ganre  $ganre
     * @return \Illuminate\Http\Response
     */
    public function show(Ganre $ganre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ganre  $ganre
     * @return \Illuminate\Http\Response
     */
    public function edit(Ganre $ganre)
    {
        return view('admin.ganres.edit', compact('ganre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ganre  $ganre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ganre $ganre)
    {
        $this->validate(request(), [
            'title' => 'required|min:2',
        ]);

        $ganre->title = request('title');
        $ganre->save();

        return redirect()->route('admin.ganre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ganre  $ganre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ganre $ganre)
    {
        $ganre->delete();

        return redirect()->route('admin.ganre.index');
    }
}
