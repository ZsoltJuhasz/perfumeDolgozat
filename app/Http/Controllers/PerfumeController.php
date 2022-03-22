<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PerfumeController extends Controller
{
    public function getPerfumes() {

        $perfumes = Perfume::all();
        return view( "perfumes" );
    }

    public function newPerfume() {

        return view( "new_perfume" );
    }

    public function storePerfume( Request $request ) {

        $perfume = new Perfume;

        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = (int)$request->price;

        $perfume->save();

        return redirect( "new-perfume" );
    }

    public function editPerfume( $id ) {

        $perfume = Perfume::find( $id );

        return view( "edit_perfume", [
            "perfume" => $perfume
        ]);
    }

    public function updatePerfume( Request $request ) {
        DB::table("perfumes")->where("id", 2)->update([
            "name" => "Chanel",
            "type" => "női",
            "price" => 10000
        ]);

        echo ("A parfüm módosítása sikeres");
    }

    public function deletePerfume( $id ) {

        $perfume = Perfume::find( $id );
        $perfume->delete();

        return redirect( "perfumes" );
    }

    public function submitPerfume(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                "name" => "required|min:4|max:20",
                "type" => "required",
                "price" => "required"
            ],
            [
                "name.required" => "Név kötelező",
                "type.required" => "Típus kötelező",
                "price.required" => "Ár kötelező",
            ]
        )->validate();

        print_r($request->all());
    }
}
