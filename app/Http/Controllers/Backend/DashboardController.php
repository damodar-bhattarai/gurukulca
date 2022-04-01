<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BranchRequest;
use App\Models\Contact;
use App\Models\Notice;
use App\Models\Order;
use App\Models\OrderComment;
use App\Models\OrderPayments;
use App\Models\Quotation;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    function index(){

        $orders=Order::select('id')->owned()->latest()->get();
        if($orders){
            $order_ids=$orders->pluck('id')->toArray();
            $comments=OrderComment::with('user')->whereIn('order_id',$order_ids)->where('created_at','>=',Carbon::now()->subDays(20))->latest()->get();
            $orderComments=$comments->groupBy('order_id');

            $unread_comment=$orderComments->filter(function ($comment) {
                if($comment->first()->user_id==auth()->user()->id || null) return false;
                else return true;
            });

            $unread_comments=$unread_comment->filter(function ($comment) {
               return $comment!=null;
            });

            foreach($unread_comments as $index=>$unread){
                $unread_comments[$index]=$unread[0]??null;
            }

        }else{
            $unread_comments=[];
        }




        if(auth()->user()->hasRole('admin')){
            $totalUserRequest=BranchRequest::count();
            $totalCustomers=User::whereHas('roles',function($q){
                $q->where('name','customer');
            })->count();
            $totalBranches=User::whereHas('roles',function($q){
                $q->where('name','branch');
            })->count();
            $totalOrders=Order::count();

            $notices=Notice::active()->latest()->get();

            return view('backend.dashboard.adminDashboard',compact('unread_comments','notices','totalUserRequest','totalCustomers','totalBranches','totalOrders'));
        }elseif(auth()->user()->hasRole('branch')){

            $totalCustomers=User::whereIn('id',function($q){
                $q->select('created_by')->from('orders')->where('branch_id',auth()->user()->id);
            })->count();

            $totalOrders=Order::owned()->count();
            $totalPaid=OrderPayments::owned()->where('paid',1)->sum('total');
            $totalUnpaid=OrderPayments::owned()->where('paid',0)->sum('total');
            $notices=Notice::active()->latest()->get();

            return view('backend.dashboard.branchDashboard',compact('unread_comments','notices','totalCustomers','totalOrders','totalPaid','totalUnpaid'));
        }elseif(auth()->user()->hasRole('customer')){
            $delivered=Order::owned()->where('delivered',1)->count();
            $pending=Order::owned()->where('delivered',0)->where('returned',0)->count();
            $returned=Order::owned()->where('returned',1)->count();
            $orders=$delivered+$pending+$returned;

            $deliveredValue=Order::owned()->where('delivered',1)->sum('cod');
            $pendingValue=Order::owned()->where('delivered',0)->where('returned',0)->sum('cod');
            $returnedValue=Order::owned()->where('returned',1)->sum('cod');
            $ordersValue=$deliveredValue+$pendingValue+$returnedValue;

            $lastOrder=Order::owned()->orderBy('id','desc')->first();

            $paymentOrders=OrderPayments::owned()->where('paid',1)->get();
            $total_delivery_charge=$paymentOrders->sum('delivery_charge');
            $total_payments=$paymentOrders->sum('total');

            $receivable['cod']=OrderPayments::owned()->where('paid',0)->sum('cod');
            $receivable['charge']=OrderPayments::owned()->where('paid',0)->sum('delivery_charge');
            $receivable['total']=OrderPayments::owned()->where('paid',0)->sum('total');

            $last_payment=OrderPayments::owned()->orderBy('id','desc')->first();
            if($last_payment){
                $last_payment_date=$last_payment->created_at->format('d-m-Y');
            }else{
                $last_payment_date='';
            }


            $notices=Notice::active()->latest()->get();

            return view('backend.dashboard.customerDashboard',compact('unread_comments','last_payment_date','notices','receivable','delivered','pending','returned','total_payments','total_delivery_charge','deliveredValue','pendingValue','returnedValue','ordersValue','orders','lastOrder'));
        }else{
            abort(404);
        }
    }

    function profile(){
        $user=auth()->user();
        return view('backend.user.profile',compact('user'));
    }


    function updateProfile(Request $request){
        $request->validate([
            'previous_password'=>'required',
            'new_password'=>'required|min:6|confirmed',
            'new_password_confirmation'=>'required',
        ]);
        $user=User::find(auth()->user()->id);
        if(!Hash::check($request->previous_password,$user->password)){
            return redirect()->back()->with('error','Previous password is incorrect');
        }
        $user->password=bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('success','Password updated successfully');
    }

    function editUser($id=null){
        if(!$id){
            $id=auth()->user()->id;
        }
        if(auth()->user()->hasRole('admin')){
            $user=User::findOrFail($id);
            return view('backend.user.edit',compact('user'));
        }else{
            $user=User::findOrFail(auth()->user()->id);
            return view('backend.user.edit',compact('user'));
        }
    }

    function updateUser($id,Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'district'=>'required',
            'city'=>'required',
            'street'=>'required',
        ]);

        if(auth()->user()->hasRole('admin')){
            $user=User::findOrFail($id);


        }else{
            $user=User::findOrFail(auth()->user()->id);
        }
        $address=Address::firstOrCreate([
            'district'=>$request->district,
            'city'=>$request->city,
            'street'=>$request->street,
        ]);

        $user->address_id=$address->id;
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->save();

        if(auth()->user()->hasRole('admin')){
            if($user->hasRole('customer')) return redirect()->route('backend.user.index')->with('success','User updated successfully');
            elseif($user->hasRole('branch')) return redirect()->route('backend.branch.index')->with('success','Branch updated successfully');
            return redirect()->back()->with('success','Profile updated successfully');

        }else{
            return redirect()->back()->with('success','Profile updated successfully');
        }
    }

    function generalSettings(){
        return view('backend.settings.general');
    }

    function updateGeneralSettings(Request $request){
            if($request->has('header_logo')){
                $header_logo=Storage::disk('public')->put('header_logo',$request->header_logo);
            }else{
                $header_logo=config('appSettings.header_logo');
            }
            if($request->has('footer_logo')){
                $footer_logo=Storage::disk('public')->put('footer_logo',$request->footer_logo);
            }else{
                $footer_logo=config('appSettings.footer_logo');
            }
            if($request->has('site_favicon')){
                $site_favicon=Storage::disk('public')->put('site_favicon',$request->site_favicon);
            }else{
                $site_favicon=config('appSettings.site_favicon');
            }

            $arr=[
                'site_name'=>$request->site_name,
                'header_logo'=>$header_logo,
                'footer_logo'=>$footer_logo,
                'site_favicon'=>$site_favicon,
                'primary_email'=>$request->primary_email,
                'secondary_email'=>$request->secondary_email,
                'primary_phone'=>$request->primary_phone,
                'secondary_phone'=>$request->secondary_phone,
                'address'=>$request->address,
                'google_map'=>$request->google_map,
                'facebook_url'=>$request->facebook_url,
                'twitter_url'=>$request->twitter_url,
                'instagram_url'=>$request->instagram_url,
                'youtube_url'=>$request->youtube_url,
                'google_analytics'=>$request->google_analytics,
                'google_tag_manager'=>$request->google_tag_manager,
            ];
            $config = '<?php return ' . var_export($arr, true) . ';';
            if(file_put_contents(base_path('config/appSettings.php'), $config)){
                 \Artisan::call('config:clear');
                 return redirect()->route('backend.settings.general')->with('success', 'Data Updated Successfully');
            }else{
                return redirect()->back()->with('error', 'Something went wrong');
            }
    }

    function status(){
        return view('backend.orders.status');
    }

    function userRequest(){
        return view('backend.users.user-request');
    }

    function users(){
        return view('backend.users.index');
    }

    function branches(){
        return view('backend.users.branches');
    }
    function usersCreate(){
        return view('backend.users.create');
    }

    function sliders(){
        return view('backend.sliders.index');
    }

    function testimonials(){
        return view('backend.testimonials.index');
    }

    function services(){
        return view('backend.services.index');
    }

    function notices(){
        return view('backend.notices.index');
    }

    function allNotices(){
        $notices=Notice::active()->latest('deadline')->paginate(5);
        return view('backend.notices.all',compact('notices'));
    }

    function payments(){
        return view('backend.payments.branch-payment');
    }

    function paymentsAll(){
        return view('backend.payments.customer-payment');
    }

    function customers(){
        $orders=Order::with('branch','customer')->where('branch_id',auth()->user()->id)->orWhere('created_by',auth()->user()->id)->latest()->get();
        $uniqueOrders=$orders->unique('receiver_phone');

        $customers=collect();

        $customers=$uniqueOrders->map(function($cust){
            $customer=collect();
            $customer->id=$cust->created_by;
            $customer->customer_name=optional($cust->customer)->name;
            $customer->name=$cust->receiver_name;
            $customer->phone=$cust->receiver_phone;
            $customer->email=$cust->receiver_email;
            $customer->address=$cust->receiver_address;
            $customer->branch=optional($cust->branch)->name;
            $customer->branch_id=optional($cust->branch)->id;
            return $customer;
        });
        return view('backend.customers.index',compact('customers'));
    }

    function tickets(){
        if(auth()->user()->hasRole('admin')){
            $tickets=Ticket::with(['customer','replies'])->get();

        }elseif(auth()->user()->hasRole('branch')){
            $tickets=Ticket::with('replies')->where('branch_id',auth()->user()->id)->get();
        }else{
            $tickets=Ticket::with('replies')->where('customer_id',auth()->user()->id)->get();
        }
        return view('backend.tickets.index',compact('tickets'));
    }

    function ticketsCreate(){
        return view('backend.tickets.create');
    }

    function ticketsStore(Request $request){
        $validated=$request->validate([
            'subject'=>'required',
            'message'=>'required',
        ]);
        $branch=Order::where('created_by',auth()->user()->id)->latest()->first();
        if($branch) $branch_id=$branch->branch_id;
        else $branch_id=auth()->user()->id;
        Ticket::create([
            'subject'=>$request->subject,
            'message'=>$request->message,
            'branch_id'=>$branch_id,
            'customer_id'=>auth()->user()->id,
        ]);
        return redirect()->route('backend.tickets.index')->with('success','Ticket Created Successfully');
    }

    function ticketsReply($id){
        $ticket=Ticket::owned()->findOrFail($id);
        return view('backend.tickets.reply',compact('ticket'));
    }

    function ticketsClose($id){
        $ticket=Ticket::owned()->findOrFail($id);
        $ticket->update([
            'status'=>'Closed',
            'closed_by'=>auth()->user()->name,
        ]);
        return redirect()->route('backend.tickets.index')->with('success','Ticket Closed Successfully');
    }

    function contacts(){
        $contacts=Contact::latest()->paginate(10);
        return view('backend.contacts.index',compact('contacts'));
    }

    function contactsDelete($id){
        $contact=Contact::findOrFail($id);
        $contact->delete();
        return redirect()->back()->with('success','Contact Deleted Successfully');
    }
    function quotationsDelete($id){
        $contact=Quotation::findOrFail($id);
        $contact->delete();
        return redirect()->back()->with('success','Quotation Deleted Successfully');
    }

    function quotations(){
        $quotations=Quotation::latest()->paginate(10);
        return view('backend.quotations.index',compact('quotations'));
    }

    function userDetail($id){
        if(auth()->user()->hasRole('admin')){

            $user=User::with('address')->findOrFail($id);
            $orders=Order::where('created_by',$id)->orwhere('branch_id',$id)->latest()->paginate(10);

        }elseif(auth()->user()->hasRole('branch')){
            $orderUser=Order::where('created_by',$id)->first();
            if($orderUser){
                $user=User::with('address')->findOrFail($id);
            }else{
                abort(404,'User Not Found');
            }
            $orders=Order::where('created_by',$id)->where('branch_id',auth()->user()->id)->latest()->paginate(10);

        }
        if(auth()->user()->hasRole('admin')){
            $allPayments=OrderPayments::where('customer_id',$id)->where('paid',0)->latest()->get();
        }else{
            $allPayments=OrderPayments::owned()->where('customer_id',$id)->where('paid',0)->latest()->get();
        }
        $payments=[];
        foreach($allPayments as $payment){
            $payments['total']=0;
            $payments['totalCOD']=0;
            $payments['totalCharge']=0;
            $payments['payments'][]=$payment;
        }
        if(count($payments)>0){
            $payments['customer']=$payments['payments'][0]->customer;
            $payments['branch']=$payments['payments'][0]->branch;
            $payments['total']+=array_sum(array_column($payments['payments'],'total'));
            $payments['totalCOD']+=array_sum(array_column($payments['payments'],'cod'));
            $payments['totalCharge']+=array_sum(array_column($payments['payments'],'delivery_charge'));
        }



        return view('backend.user.detail',compact('user','orders','payments'));
    }
}
