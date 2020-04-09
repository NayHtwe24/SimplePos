<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Transaction;
use App\CustomerOrderLine;
use App\Product;
use App\Set;
use App\Category;
use Carbon\Carbon;
use Response;


class InfoController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return Response::json([
              'recipes' => $recipes,
    					'recipe_categories' => $recipe_categories,
    				], 200);
    }

    public function recipeOrder(Request $request){

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

            $transaction->invoice_no = $invoice_no;
            $transaction->transaction_date =  Carbon::now();
            $transaction->discount_amount = $request->discount;
            $transaction->total_before = $request->before_total;
            $transaction->final_total = $request->final_total;
            $transaction->status = 'Paid';
            $transaction->save();
            foreach ($request->orderlists as $key => $value) {

                $order_line = new CustomerOrderLine();
                $order_line->transaction_id = $transaction->id;
                $order_line->product_id = $value['id'];
                $order_line->qty = $value['qty'];
                $order_line->sub_sell_price = $value['price'];
                $order_line->sell_price = $value['price'] * $value['qty'];
                $order_line->save();

            }

            return Response::json([
                  'status' => 'Complete Process !',
        				], 200);
    }
}
