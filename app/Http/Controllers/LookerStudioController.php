<?php

namespace App\Http\Controllers;

use App\Models\LookerStudio;
use Illuminate\Http\Request;

class LookerStudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $link_looker = LookerStudio::all();

        return view('Admin.Looker.index', compact('link_looker'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Looker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'link_looker' => 'required',
        ]);

        LookerStudio::create($validatedData);

        return redirect('/LookerStudio')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LookerStudio $id)
    {
        $lookerShow = LookerStudio::find($id);
        return view('Admin.Looker.index', compact('lookerShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lookerUpdate = LookerStudio::where('id', $id)->firstorfail();

        return view('Admin.Looker.update', compact('lookerUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'link_looker' => 'required',
        ];

        $validatedData = $request->validate($content);

        $link_looker = LookerStudio::find($id);

        $link_looker->update($validatedData);

        return redirect('/LookerStudio')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $link_looker = LookerStudio::findOrFail($id);

        $link_looker->delete();

        return redirect('/LookerStudio')->with('error', 'Data deleted successfully!');
    }

    public function showContent()
    {
        $looker = LookerStudio::latest('id')->first();

        if ($looker) {
            $link_looker = $looker->link_looker;

            return [
                'lookerView' => $link_looker,
            ];
        }

        abort(404);
    }
}
