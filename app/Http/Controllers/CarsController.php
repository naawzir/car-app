<?php

namespace App\Http\Controllers;

use Auth;
use App\Car;
use App\Math;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

// php artisan make:controller CarsController --resource --model=Car
class CarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $math = (new Math)->add(1,2,3,4);
        dd($math);

        $carModel = new Car;
        $makeValues = $carModel->getUniqueValues(new Car, 'make');
        $allCars = Car::where('active', 1)->get();

        $cars = [];
        $i = 0;
        foreach ($allCars as $car) {
            $cars[$i]['car'] = $car;
            $cars[$i]['owner'] = $car->owner()->where('active', 1)->first();
            $i++;
        }

        /*$cars = DB::table('cars as c')
            ->join('owners as o', 'o.id', '=', 'c.owner_id')
            ->select("*")
        ->where([
            ['c.active', '=', 1],
            ['o.active', '=', 1],

        ])->get();*/

        /*$cars = DB::select(
            "SELECT * 
              FROM cars as `c`
              INNER JOIN owners as `o` ON o.id = c.owner_id
        WHERE o.active = 1 AND c.active = 1");*/

        $data = [
            'makeValues' => $makeValues,
            'cars' => $cars
        ];

        return view('car.index', $data);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecords()
    {
        /** @var $user User */
        $user = Auth::user();
        $cars = Car::all();
        return Datatables::of($cars)->make(true);
    }

    public function getCars()
    {
        return Car::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required',
            'model' => 'required',
            'registration_number' => [
                'required',
                'regex:/^[a-zA-Z0-9]*([a-zA-Z][0-9]|[0-9][a-zA-Z])[a-zA-Z0-9]*$/',
                'unique:cars'
            ]
            //, 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $car = new Car;
            $car->slug = Uuid::generate(4)->string;
            $car->make = $request->make;
            $car->model = $request->model;
            $car->registration_number = $request->registration_number;
            $car->image = $request->image;
            $car->save();

            /*if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
            }*/

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Unable to save car');
        }

        //return redirect('/home')->with('message', 'Car Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $data = [
            'car' => $car
        ];

        return view('car.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'make' => 'required',
            'model' => 'required',
            'registration_number' => [
                'required',
                'regex:/^[a-zA-Z0-9]*([a-zA-Z][0-9]|[0-9][a-zA-Z])[a-zA-Z0-9]*$/',
                'unique:cars,registration_number,' . $car->id,
            ],
            //'image' => 'image|mimes:jpg,png,jpeg,gif',
        ]);

        try {
            DB::beginTransaction();
            //$car->slug = Uuid::generate(4)->string;
            $car->make = $request->make;
            $car->model = $request->model;
            $car->registration_number = $request->registration_number;
            //$car->image = $request->image;
            $car->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            //return redirect()->back()->withInput()->with('error', 'Unable to save car');
        }

        //return redirect('/home')->with('message', 'Car Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('/cars');
    }
}
