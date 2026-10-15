<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    /**
     * Menampilkan daftar event.
     */
    public function index()
    {
        $events = Events::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Menampilkan form tambah event.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Menyimpan event baru beserta foto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Musik,Festival,Seminar',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Events::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Data event berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail event.
     */
    public function show(Events $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Menampilkan form edit event.
     */
    public function edit(Events $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Memperbarui data event dan mengganti foto jika ada.
     */
    public function update(Request $request, Events $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Musik,Festival,Seminar',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $event->image;

        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Data event berhasil diperbarui!');
    }

    /**
     * Menghapus event beserta foto.
     */
    public function destroy(Events $event)
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Data event berhasil dihapus!');
    }
}