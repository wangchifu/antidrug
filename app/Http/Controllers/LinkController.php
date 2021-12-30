<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::orderBy('order_by')->get();
        $data = [
            'links'=>$links,
        ];

        return view('links.index',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        Link::create($att);
        return redirect()->route('links.index');
    }

    public function edit(Request $request,Link $link)
    {
        $data = [
            'link'=>$link,
        ];

        return view('links.edit',$data);
    }

    public function update(Request $request,Link $link)
    {
        $att = $request->all();
        if(!isset($att['target'])){
            $att['target'] = null;
        }

        $link->update($att);
        return redirect()->route('links.index');
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('links.index');
    }
}
