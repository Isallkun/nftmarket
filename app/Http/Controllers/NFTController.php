<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NFT;
use Inertia\Inertia;

class NFTController extends Controller
{
    public function index()
    {
        $nfts = NFT::all(); // Ambil semua data NFT dari model

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
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'nullable',
            'external_url' => 'nullable',
            'author' => 'nullable',
            'image' => 'nullable',
        ]);

        NFT::create($request->only(
            'name',
            'collection',
            'price',
            'quantity',
            'description',
            'external_url',
            'author',
            'image'
        ));

        return redirect()->route('nfts.index')->with('success', 'NFT created successfully.');
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

        $nft->update($request->only(
            'name',
            'collection',
            'price',
            'quantity',
            'description',
            'external_url',
            'author',
            'image'
        ));

        return back()->with('success', 'NFT updated successfully.');
    }

    public function destroy(NFT $nft)
    {
        $nft->delete();

        return redirect()->route('nfts.index')->with('success', 'NFT deleted successfully.');
    }
}
