<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutUs::all();

        return view('Admin.About.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.About.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        AboutUs::create($validatedData);

        return redirect('/AboutUs')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $id)
    {
        $aboutShow = AboutUs::find($id);
        return view('Admin.About.index', compact('aboutShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aboutUpdate = AboutUs::where('id', $id)->firstorfail();

        return view('Admin.About.update', compact('aboutUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'description' => 'required',
        ];

        $validatedData = $request->validate($content);

        $about = AboutUs::find($id);

        $about->update($validatedData);

        return redirect('/AboutUs')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);

        $about->delete();

        return redirect('/AboutUs')->with('error', 'Data deleted successfully!');
    }

    public function showContent()
    {
        $about = AboutUs::latest('id')->first();

        if ($about) {
            $description = $about->description;

            return [
                'descriptionView' => $description,
            ];
        }
    }
}
