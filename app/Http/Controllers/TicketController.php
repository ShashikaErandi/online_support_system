<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Reply;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OpenTicket;
use App\Mail\ReplyTicket;
use Redirect;

class TicketController extends Controller
{
    public function index(){
        $ticket = Ticket::get();
    	return $ticket;
    }

    public function search($val){
        $ticket = Ticket::where('customer_name', 'like', '%'.$val.'%')->get();
    	return $ticket;
    }

    public function show($id){
        $ticket = Ticket::find($id);

        if($ticket->status == 0){
            $ticket->status = Ticket::VIEW;
            $ticket->save();
        }

        return view('ticket.show', ['ticket' => $ticket]);
    }
    
    public function openTicket(){
        return view('ticket.open');
    }

    public function store(Request $request){
        $request->validate([
            'customerName' => ['required','max:255'],
            'description' => ['required','string'],
            'email' => ['required','string','email','max:255','unique:users'],
            'phoneNo' => ['required', 'digits:10', 'starts_with:0']
        ]);

        $result = Ticket::create([
            'customer_name' => $request->customerName,
            'description' => $request->description,
            'email' => $request->email,
            'phone_no' => $request->phoneNo,
            'reference_no' => $request->phoneNo + Carbon::now()->timestamp
        ]);

        if($result){
            Mail::to($result->email)->send(new OpenTicket($result));
            return redirect('/open/support-ticket')->with('status', 'Successful!');
        }else{
            return redirect('/open/support-ticket')->with('error', 'Successful!');
        }

    }

    public function reply(Request $request){

        $request->validate([
            'reply' => ['required']
        ]);

        $result = Reply::create([
            'ticket_id' => $request->id,
            'reply' => $request->description
        ]);

        if($result){
            $ticket = Ticket::find($request->id);
            $ticket->status = Ticket::REPLY;
            $ticket->save();

            Mail::to($ticket->email)->send(new ReplyTicket($ticket, $result));
            return Redirect::back()->with('status', 'Successful!');
        }else{
            return Redirect::back()->with('error', 'Successful!');
        }
    }

    public function viewStatus(Request $request){
        $request->validate([
            'reference_no' => ['required']
        ]);

        $ticket = Ticket::where('reference_no', $request->reference_no)->with('reply')->first();

        if($ticket->status == 1){
            $status = 'Your ticket has been viewed.';
        }elseif($ticket->status == 2){
            $status = 'Your ticket has replied';
        }else{
            $status = 'Your ticket has not been viewed yet.';
        }

        return view('ticket.status', ['ticket' => $ticket, 'status' => $status]);
    }
}
