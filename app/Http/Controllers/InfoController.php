<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Transaction;
use App\CustomerOrderLine;
use App\Product;
use App\Set;
use App\Category;
use Carbon\Carbon;



class InfoController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:order-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
      return view('pos.index');
    }
    public function getRecipes(){
        $recipe_categories = Category::all();
        $recipes = Product::all()->groupBy('category_id');

        return ['recipe_categories' => $recipe_categories, 'recipes' => $recipes];
    }

    public function recipeOrder(Request $request){


        // DB::beginTransaction();
        // try{

            $cu = Transaction::where('type', '=', 'sell')
                    ->count();
            $cu = $cu+1;
            if($cu < 10){
                $invoice_no = "000".$cu;
            }elseif ($cu < 100) {
                $invoice_no = "00".$cu;
            }elseif ($cu < 1000) {
                $invoice_no = "0".$cu;
            }else{
                $invoice_no = $cu;
            }

            $transaction = new Transaction();
            $transaction->type = "sell";

            $transaction->table_id = $request->table_id;
            $transaction->invoice_no = $invoice_no;
            $transaction->transaction_date =  Carbon::now();
            $transaction->total_before = $request->total;
            $transaction->final_total = $request->total;
            $transaction->status = 'Progress';
            $transaction->save();
            foreach ($request->orderlists as $key => $value) {

                // $service_products = DB::table('product_service')
                //         ->join('products', 'product_service.product_id', '=', 'products.id')
                //         ->select('product_service.product_id','products.usage_count')
                //         ->where('product_service.service_id','=',$value['service_id'])
                //         ->get();
                // foreach ($service_products as $key => $val) {

                //     $used = $value['quantity'];
                //     $product = Stock::where('product_id', '=', $val->product_id)->get();
                //     $usage_qty = $product[0]->usage_qty - $used;
                //     $qty = $usage_qty / $val->usage_count;

                //     $data = DB::update( DB::raw("UPDATE stocks
                //             SET qty = ".$qty." , usage_qty = ".$usage_qty."
                //             WHERE product_id = ".$val->product_id.";"
                //     ));
                // }

                $order_line = new CustomerOrderLine();
                $order_line->transaction_id = $transaction->id;
                $order_line->recipes_id = $value['id'];
                $order_line->qty = $value['qty'];
                $order_line->sub_sell_price = $value['price'];
                $order_line->sell_price = $value['price'] * $value['qty'];
                $order_line->save();

            }


           // DB::commit();
            return redirect('/order-list');
        //     // return redirect('/tay')
        //     // ->with('alert-type', 'success')
        //     // ->with('message', 'Thanks for your patience.!');
        // }catch(\Exception $e){
        //     DB::rollback();
        //     return Redirect::back()->with('alert-type', 'error')
        //     ->with('message', ' Fail!');
        // }

    }
    public function getTables(){
        $tables = Table::all();
        return ['message' =>'successfully get data' ,'tables' => $tables];
    }



}
