<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class AjaxController extends Controller
{
    public function ajax_Order(Request $request){
        
        $query = Order::query();
    	if($request->ajax())
        {
            if ($request->has('status') && !empty($request->status)) {
                $query = $query->where('status',$request->status);
            }
            
            if ($request->has('search') && !empty($request->search))
            {
                $querysearch = $request->get('search');
                //dd($querysearch);
                $query = $query->where(function ($query1) use ($querysearch) {
                    $query1->where('name', 'like','%'. $querysearch.'%')
                    ->orWhere('phone', 'like','%'. $querysearch.'%')
                       ->orWhere('address', 'like','%'. $querysearch.'%');
                });
                      
            }
            if($request->has('datefrom') && $request->has('dateto')) 
            {
                $datefrom = $request->get('datefrom');
                $dateto   = $request->get('dateto');
                $query = $query->whereBetween('created_at',[$datefrom,$dateto]);
            }          
            $orders = $query->orderBy('id','asc')->get();
            $view = view('admin.ajax.ajax_order',compact('orders'))->render();
            return response()->json(['view'=> $view],200);
        }
        $orders = Order::all();
        return view('admin.pages.order.index',compact('orders'));
    }
}
