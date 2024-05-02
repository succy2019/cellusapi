<?php

namespace App\Http\Controllers;

use App\Models\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{
    //

    public function update_options(Request $request)
    {
        // dd($request->all()['buy']);

        $data = DB::table("options")->get()->first();

        if ($data == null) {
            // create new
            $fields = [
                "buy" => $request->all()['buy'],
                "sell" => $request->all()['sell']
            ];

            Options::create($fields);
            return redirect('/admin/index', )->with('message', 'Buy and sell options created successfully');
        } else {
            // update existing
            // dd($data);

            $option_data = Options::find($data->id);
            $fields = [
                "buy" => $request->all()['buy'],
                "sell" => $request->all()['sell']
            ];

            $option_data->update($fields);

            // Options::update($fields);
            return redirect('/admin/index', )->with('message', 'Buy and sell options updated successfully');
        }
    }
}
