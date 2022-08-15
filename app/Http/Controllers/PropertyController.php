<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaraDev\Property;
use Nexmo\Entity\EmptyFilter;

class PropertyController extends Controller
{
    public function index() 
    {
        //$properties = DB::select("SELECT * FROM properties");
        $properties = Property::all();

        return view('property.index')->with('properties', $properties);
    }

    public function show($name)
    {
        //$property = DB::select("SELECT * FROM properties WHERE name = ?", [$name]);
        $property = Property::where('name', $name)->get();

        if(!empty($property)) {
            return view('property.show')->with('property', $property); 
        } else {
            return redirect()->action('PropertyController@index');
        }
    }

    public function create() 
    {
        return view('property.create');
    }

    public function store(Request $request) 
    {
        $propertySlug = $this->setName($request->title);
        // var_dump($propertySlug);
        // exit;
        // $property = [
        //     $request->title,
        //     $request->description,
        //     $request->rental_price,
        //     $request->sale_price,
        //     $propertySlug,
        // ];

        // DB::insert("INSERT INTO properties (title, description, rental_price, sale_price, name) VALUES
        //         (?, ?, ?, ?, ?)", $property);

        $property = [
            'title' => $request->title,
            'description' => $request->description,
            'rental_price' => $request->rental_price,
            'sale_price' => $request->sale_price,
            'name' => $request->$propertySlug
        ];

        Property::create($property);

        return redirect()->action('PropertyController@index');
    }

    public function edit($name)
    {
        //$property = DB::select("SELECT * FROM properties WHERE name = ?", [$name]);
        $property = Property::where('name', $name)->get();

        if(!empty($property)) {
            return view('property.edit')->with('property', $property); 
        } else {
            return redirect()->action('PropertyController@index');
        }

        //var_dump($name);
    }

    public function update(Request $request, $id)
    {
        $propertySlug = $this->setName($request->title);

        // $property = [
        //     $request->title,
        //     $request->description,
        //     $request->rental_price,
        //     $request->sale_price,
        //     $propertySlug,
        //     $id
        // ];

        // DB::insert("UPDATE properties SET title = ?, description = ?, rental_price = ?, sale_price = ?, name = ?
        //             WHERE id = ?", $property);

        $property = Property::find($id);

        $property->title = $request->title;
        $property->description = $request->description;
        $property->rental_price = $request->rental_price;
        $property->sale_price = $request->sale_price;
        $property->name = $request->$propertySlug;

        $property->save();

        return redirect()->action('PropertyController@index');
    }


    public function destroy($name)
    {
        //$property = DB::select("SELECT * FROM properties WHERE name = ?", [$name]);
        $property = Property::where('name', $name)->get();

        if(!empty($property)){
            DB::delete("DELETE FROM properties WHERE name = ?", [$name]);
        }

        return redirect()->action('PropertyController@index');

        //var_dump($name);

    }

    private function setName($title)
    {
        $propertySlug = str_slug($title);
        
        //$properties = DB::select("SELECT * FROM properties");
        $properties = Property::all();

        $t = 0;
        foreach($properties as $property){
            if(str_slug($property->title) === $propertySlug) {
                $t++;
            }
        }

        if($t > 0){
            $propertySlug = $propertySlug . '-' . $t;
        }

        return $propertySlug;
    }
}
