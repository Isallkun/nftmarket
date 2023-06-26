<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NFT;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class NFTController extends Controller
{
    public function index()
    {
        $nfts = NFT::all();
        return Inertia::render('NFT/Index', compact('nfts'));
    }

    public function create()
    {
        $nft = new NFT();
        return Inertia::render('NFT/Create', compact('nft'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'collection' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'required',
            'external_url' => 'nullable|url',
            'author' => 'required',
            'image' => 'required|image',
        ]);

        try {
            $imageName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('public', $imageName);
            $imageUrl = Storage::url($imagePath);

            NFT::create([
                'name' => $request->input('name'),
                'collection' => $request->input('collection'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description'),
                'external_url' => $request->input('external_url'),
                'author' => $request->input('author'),
                'image' => $imageName,
            ]);

            return redirect()->route('nfts.index')->with('success', 'NFT berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function show(NFT $nft)
    {
        $imagePath = asset('storage/' . $nft->image);
        return Inertia::render('NFT/Show', compact('nft', 'imagePath'));
    }

    public function edit(NFT $nft)
    {
        return Inertia::render('NFT/Edit', compact('nft'));
    }

    public function update(Request $request, NFT $nft)
    {
        $request->validate([
            'name' => 'required',
            'collection' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'nullable',
            'external_url' => 'nullable',
            'author' => 'nullable',
            'image' => 'nullable',
        ]);

        $nft->update($request->only('name', 'collection', 'price', 'quantity', 'description'));
        return back()->with('success', 'NFT updated successfully.');
    }

    public function destroy(NFT $nft)
    {
        $nft->delete();

        return redirect()->route('nfts.index')->with('success', 'NFT deleted successfully.');
    }
}
