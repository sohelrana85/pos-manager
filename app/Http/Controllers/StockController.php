<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StockController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }


    public function add_to_stock_page()
    {
        if(!$this->user->can('stock.add')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.stock.add-stock');
    }

    public function all_purchase()
    {
        if(!$this->user->can('stock.add')){
            abort(403, 'sorry! Access Denied');
        }

        $all_purchase = Purchase::with('supplier','product')->where('status','0')->get();

            return response()->json([
                'all_purchase' => $all_purchase
            ]);
    }


    public function add_to_stock($id)
    {
        if(!$this->user->can('stock.add')){
            abort(403, 'sorry! Access Denied');
        }


        $product = Purchase::find($id);

        $checkDuplicate = Stock::where('product_name', $product->product_name)->first();

        // DB::beginTransaction();
       try {
            if($checkDuplicate == null) {
                $result = Stock::create([
                    'user'         => Auth::id(),
                    'product_name' => $product->product_name,
                    'warehouse'    => $product->warehouse,
                    'stock_qty'    => $product->product_qty + $product->free_qty,
                    'stock_value'  => $product->total_price,
                ]);

                if($result){
                    $product->status = 1;
                    $product->update();
                }
            } else {

                $checkDuplicate->stock_qty  += $product->product_qty + $product->free_qty;
                $checkDuplicate->stock_value  += $product->total_price;
                $checkDuplicate->update();

                $product->status = 1;
                $product->update();
            }

            return response()->json([
                'status' => '1',
                'message' => 'Product successfully Added to the Stock'
            ]);

            // DB::commit();
        } catch (Exception $e) {
                // DB::rollBack();
                return response()->json([
                'status' => '0',
                'message' => 'Product Add Failed!',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function manage_stock_page()
    {
        if(!$this->user->can('stock.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.stock.manage-stock');
    }

    public function get_all_stock()
    {
        if(!$this->user->can('stock.view')){
            abort(403, 'sorry! Access Denied');
        }

        $stock = Stock::all();
        $stock->map(function($stock){

           $stock->product = Product::where('id', $stock->product_name)->select('product_name','product_code')->first();
        });
        return $stock;
    }

    // public function search_data(Request $request){
    //     return $request->all();
    // }
}
