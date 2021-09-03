<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\SupportTicket;
use App\Model\SupportTicketConv;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupportTicketController extends Controller
{
    public function index(){
        $tickets=SupportTicket::orderBy('status','desc')->paginate(10);
        return view('admin-views.support-ticket.view',compact('tickets'));
    }

    public function status(Request $request){
        if($request->ajax())
        {
            $currency = SupportTicket::find($request->id);
            $currency->status = $request->status;
            $currency->save();
        }
    }
    public function single_ticket($id){
        $supportTicket = SupportTicket::where('id',$id)->get();
        return view('admin-views.support-ticket.singleView',compact('supportTicket'));
    }
    public function replay_submit(Request $request){

        $reply=[
            'admin_message'=>$request->replay,
            'admin_id'=>$request->adminId,
            'support_ticket_id'=>$request->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
        SupportTicketConv::insert($reply);
        return redirect()->back();
    }

}
