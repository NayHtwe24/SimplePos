<?php


namespace App\Http\Controllers;


use App\Extra;
use Illuminate\Http\Request;


class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:extra-list|extra-create|extra-edit|extra-delete', ['only' => ['index','show']]);
         $this->middleware('permission:extra-create', ['only' => ['create','store']]);
         $this->middleware('permission:extra-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:extra-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extras = Extra::latest()->paginate(5);
        return view('extras.index',compact('extras'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extras.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'product_id' => 'required',
            'price' => 'required',
        ]);


        Extra::create($request->all());


        return redirect()->route('extras.index')
                        ->with('success','Extra created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Extra  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Extra $extra)
    {
        return view('extras.show',compact('extra'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Extra $extra)
    {
        return view('extras.edit',compact('extra'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Extra $extra)
    {
         request()->validate([
           'name' => 'required',
           'product_id' => 'required',
           'price' => 'required',
        ]);


        $extra->update($request->all());


        return redirect()->route('extras.index')
                        ->with('success','Extra updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extra $extra)
    {
        $extra->delete();


        return redirect()->route('extras.index')
                        ->with('success','Extra deleted successfully');
    }
}
