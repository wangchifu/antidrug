<?php

namespace App\Http\Controllers;

use App\Models\Setup;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function setup()
    {
        $setup = Setup::orderBy('id')->first();
        if(empty($setup)){
            $att['website_name'] = "彰化縣政府毒品危害防制中心預防宣導組";
            $setup = Setup::create($att);
        }

        $data = [
            'setup'=>$setup,
        ];
        return view('setup',$data);
    }

    public function setup_update(Request $request,Setup $setup)
    {
        $att = $request->all();
        $setup->update($att);
        return redirect()->route('setups.index');
    }
}
