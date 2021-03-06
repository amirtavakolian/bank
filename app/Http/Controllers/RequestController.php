<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $requests = \App\Request::with('user')->where('is_proved', '=', '0')
            ->OrderBy('date_time', 'desc')->paginate(10);
        Controller::NumberFormat($requests);
        return view('request')->with(['requests' => $requests]);
    }

    public function confirm($id)
    {
        $request = \App\Request::query()->findOrFail($id);
        $request->is_proved = 1;
        $request->proved_by = auth()->user()->l_name;
        $request->save();

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $input = $request->all();
        if ($request->has('fee') && $input["fee"] != null) {
            $input["fee"] = str_replace(",", "", $input["fee"]);
        }
        $request->replace((array)$input);

        $user_id = basename(url()->previous());

        if (($user_id) == 'home') {
            $user_id = Auth::user()->id;
        }

        if (Auth::user()->is_super_admin == 0 && Auth::user()->id != $user_id) {
            abort(500);
        };

        $creator = auth()->user()->f_name . ' ' . auth()->user()->l_name;

        $date_time = verta();

        $this->Validate($request, [
            'type' => 'integer',
            'fee' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        \App\Request::create([
            'user_id' => $user_id,
            'type' => $request['type'],
            'fee' => $request['fee'],
            'description' => $request['description'],
            'date_time' => $date_time,
            'creator' => $creator,
        ]);

        return back();
    }

    public function delete($id)
    {
        $request = \App\Request::query()->findOrFail($id);
        if (Auth::user()->is_super_admin == 1 || $request->user_id == Auth::user()->id) {
            $request->delete();
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function form($id)
    {
        $request = \App\Request::query()->findOrFail($id);
        Controller::NumberFormat($request);
        return view('request_edit')->with(['request' => $request]);
    }

    public function edit(request $request, $id)
    {
        $requestfake = \App\Request::query()->findOrFail($id);

        $input = $request->all();
        if ($request->has('fee') && $input["fee"] != null) {
            $input["fee"] = str_replace(",", "", $input["fee"]);
        }
        $request->replace((array)$input);

        $this->Validate($request, [
            'loan' => 'nullable|integer',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $requestfake->fee = $request->fee;
        $requestfake->description = $request->description;
        $requestfake->note = $request->note;

        $requestfake->save();

        return redirect(route('user', ['id' => $requestfake->user_id]));
    }
}
