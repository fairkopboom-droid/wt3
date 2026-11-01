<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->paginate(10);
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'full_description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'tracks' => 'nullable|string',
            'cover_image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'albums/' . $filename;

            $manager = new ImageManager(new Driver());
            $image = $manager->decode($file->getRealPath());
            $image->scale(width: 600);
            $image->save(storage_path('app/public/' . $path));

            $validated['cover_image'] = $path;
        }

        Album::create($validated);

        return redirect()->route('albums.index')->with('success', 'Альбом добавлен.');
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'full_description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'tracks' => 'nullable|string',
            'cover_image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image && !str_starts_with($album->cover_image, 'http')) {
                Storage::disk('public')->delete($album->cover_image);
            }

            $file = $request->file('cover_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'albums/' . $filename;

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());
            $image->scale(width: 600);
            $image->save(storage_path('app/public/' . $path));

            $validated['cover_image'] = $path;
        }

        $album->update($validated);

        return redirect()->route('albums.index')->with('success', 'Альбом обновлён.');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Альбом удалён.');
    }
}