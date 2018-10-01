<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\BidCompany;
use App\Bid;
use Session;
use App\ChatUsers;
use App\ChatMessages;
use Carbon\Carbon;


class admin extends Controller
{
    public function company_accounts()
    {
      $user_data=User::where('user_category','=',0)->where('admin_approved','<>',2)->where('is_admin','=',0)->paginate(env('ORDERS_PER_PAGE',1));
      session(['active_element'=>1]);
      return view('admin.company-accounts',compact('user_data'));
      //return $user_data;
    }
    public function search_company(Request $request)
    {
      if(session('active_element')==1){
        $user_category=0;
      }else{
        $user_category=1;
      }
      $search_query=$request->input('search-query');
      $user_data=User::where('company_name','like','%'.$search_query.'%')->where('user_category','=',$user_category)->where('last_name','like','%'.$search_query.'%')->where('first_name','like','%'.$search_query.'%')->where('company_name','like','%'.$search_query.'%')->where('admin_approved','<>',2)->orWhere('email','like','%'.$search_query.'%')->paginate(env('ORDERS_PER_PAGE',1));
      if(empty($user_data))
      {
          Session::flash('no-search-results', '見つかりません!');
          return back();
      }
      else {

        Session::flash('no-search-results', count($user_data).' 見つけた!');
      }
      return view('admin.company-accounts',compact('user_data'));
    }
    public function company_details($company_id)
    {
      $data=User::where('user_category','=',0)->where('id','=',$company_id)->where('admin_approved','<>',2)->get();
      session(['active_element'=>1]);
      return view('admin.company-accounts-details',compact('data'));
    }
    public function update_company_record(Request $request)
    {
      if($request->input('password')!='')
      {
        $updated_password=bcrypt($request->input('password'));
        User::where('id','=',$request->input('id'))->update(['password'=>$updated_password]);
      }
      User::where('id','=',$request->input('id'))->update([
        'company_name'=>$request->input('company_name'),
        'company_name_furigana'=>$request->input('company_name_furigana'),
        'last_name'=>$request->input('last_name'),
        'first_name'=>$request->input('first_name'),
        'last_name_furigana'=>$request->input('last_name_furigana'),
        'first_name_furigana'=>$request->input('first_name_furigana'),
        'address'=>$request->input('address'),
        'email'=>$request->input('email'),
        'tel'=>$request->input('tel'),
        'company_type'=>$request->input('company_type'),
        'admin_approved'=>$request->input('admin_approved')
      ]);
      Session::flash('update_success_admin', '更新しました!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->get();
      //return view('admin.company-accounts-details',compact('data'));
      //return $request->input('id');
      return back();
    }
    public function delete_company_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>2]);
      Session::flash('no-search-results', '削除された!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->where('admin_approved','<>',2)->get();
      return $this->company_accounts();
    }
    public function client_accounts()
    {
      $user_data=User::where('user_category','=',1)->where('admin_approved','<>',2)->where('is_admin','=',0)->paginate(env('ORDERS_PER_PAGE',1));
      session(['active_element'=>2]);
      return view('admin.client-accounts',compact('user_data'));
      //return $user_data;
    }
    public function client_details($client_id)
    {
      $data=User::where('user_category','=',1)->where('id','=',$client_id)->get();
      return view('admin.client-accounts-details',compact('data'));
    }

    public function update_client_record(Request $request)
    {
      if($request->input('password')!='')
      {
        $updated_password=bcrypt($request->input('password'));
        User::where('id','=',$request->input('id'))->update(['password'=>$updated_password]);
      }
      User::where('id','=',$request->input('id'))->update([
        'company_name'=>$request->input('company_name'),
        'company_name_furigana'=>$request->input('company_name_furigana'),
        'last_name'=>$request->input('last_name'),
        'first_name'=>$request->input('first_name'),
        'last_name_furigana'=>$request->input('last_name_furigana'),
        'first_name_furigana'=>$request->input('first_name_furigana'),
        'address'=>$request->input('address'),
        'email'=>$request->input('email'),
        'tel'=>$request->input('tel')
      ]);
      Session::flash('update_success_admin', '更新しました!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->get();
      //return view('admin.company-accounts-details',compact('data'));
      //return $request->input('id');
      return back();
    }
    public function delete_client_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>2]);
      Session::flash('no-search-results', '削除された!');
      //$data=User::where('user_category','=',0)->where('id','=',$request->input('id'))->where('admin_approved','<>',2)->get();
      return $this->client_accounts();
    }
    public function admin_orders()
    {
      $data=Order::paginate(env('ORDERS_PER_PAGE',1));
      session(['active_element'=>3]);
      return view('admin.orders',compact('data'));
    }
    public function order_details($order_id)
    {
      $data=Order::where('id','=',$order_id)->get();
      $bid_companies=BidCompany::where('order_id','=',$order_id)->get();
      $count=0;
      foreach($bid_companies as $bid_company)
      {
        $bidder_email[$count]=User::where('id','=',$bid_company['user_id'])->value('email');
        $bidder_name[$count]=User::where('id','=',$bid_company['user_id'])->value('first_name');
        $bidder_latest_price[$count]=Bid::where('bid_company_id','=',$bid_company['id'])->orderBy('id','desc')->value('price');
        $count++;
      }
      session(['active_element'=>3]);
      $all_companies=User::where('user_category','=',0)->where('admin_approved','=',1)->get();
      return view('admin.order-details',compact('data','bid_companies','bidder_email','bidder_name','bidder_latest_price','all_companies'));
    }
    public function transactions()
    {
      $data=Order::where('bid_status','=',1)->paginate(env('ORDERS_PER_PAGE',1)); //get finalized orders
      $count=0;
      foreach($data as $order)
      {
        $client_email[$count]=User::where('id','=',$order['user_id'])->value('email');
        $client_name[$count]=User::where('id','=',$order['user_id'])->value('company_name');

        $seller_id=BidCompany::where('order_id','=',$order['id'])->value('user_id');
        $seller_name[$count]=User::where('id','=',$seller_id)->value('company_name');
        $seller_email[$count]=User::where('id','=',$seller_id)->value('email');

        $count++;
      }
      session(['active_element'=>4]);
      return view('admin.transactions',compact('data','client_email','client_name','seller_name','seller_email'));
    }
    public function transaction_details($order_id)
    {
      $data=Order::with('user')->where('id','=',$order_id)->where('bid_status','=',1)->get();
      if(count(BidCompany::all()))
      {
        $seller_id=BidCompany::where('order_id','=',$order_id)->whereNotNull('price_agreed')->value('user_id');
        $seller=User::where('id','=',$seller_id)->get();
        if($seller)
        {
          $closing_bid=BidCompany::where('user_id','=',$seller_id)->whereNotNull('price_agreed')->get();
        }
      }
      else
      {
        $seller=0;
      }
      session(['active_element'=>4]);
      return view('admin.transactions-details',compact('data','seller','closing_bid'));
      //return $data;
    }
    public function deleted_companies()
    {
      $data=User::where('admin_approved','=',2)->where('is_admin','=',0)->paginate(env('ORDERS_PER_PAGE',1));
      session(['active_element'=>6]);
      return view('admin.trash',compact('data'));
    }
    public function deleted_company_details($user_id)
    {
      $data=user::where('id','=',$user_id)->where('admin_approved','=',2)->where('is_admin','=',0)->get();
      session(['active_element'=>6]);
      return view('admin.trash-details',compact('data'));
    }
    public function restore_company_record(Request $request)
    {
      User::where('id','=',$request->input('id'))->update(['admin_approved'=>1]);//user now approved by admin
      Session::flash('trash_page', 'Company '.$request->input('company_name').' 復元された!');
      return $this->deleted_companies();
    }
    public function delete_record_permanently(Request $request)
    {
        User::where('id','=',$request->input('id'))->delete();//admin_approved value 10 indicates permanet deletion
        Order::where('user_id','=',$request->input('id'))->delete();
        ChatUsers::where('client_id','=',$request->input('id'))->delete();
        ChatUsers::where('company_id','=',$request->input('id'))->delete();
        ChatMessages::where('recipient_id','=',$request->input('id'))->delete();
        ChatMessages::where('user_id','=',$request->input('id'))->delete();
        BidCompany::where('user_id','=',$request->input('id'))->delete();
        Bid::where('bidder_id','=',$request->input('id'))->delete();
        Session::flash('trash_page', 'Company '.$request->input('company_name').' 永久に削除されました!');
      return $this->deleted_companies();
    }
    public function message_hist()
    {
        $chatusers=ChatUsers::get();
        $count=0;
        if(!count($chatusers)){$client_data=0;$message_data=0;return view('admin.message-hist',compact('client_data','message_data'));}
        foreach ($chatusers as $chatuser)
        {
          //$company_data[$count]=User::where('id','=',$chatuser['company_id'])->get();
          $client_data[$count]=User::where('id','=',$chatuser['client_id'])->get();
          $message_data[$count]=ChatMessages::where('chat_users_id','=',$chatuser['id'])->orderBy('id','DESC')->get();
          $count++;
        }
        session(['active_element'=>5]);
        return view('admin.message-hist',compact('client_data','message_data'));
    }
    public function message_details($chat_users_id)
    {
      $chatusers=ChatUsers::where('id','=',$chat_users_id)->get();
      $client_data=User::where('id','=',$chatusers[0]['client_id'])->get();
      $company_data=User::where('id','=',$chatusers[0]['company_id'])->get();
      $message_data=ChatMessages::where('chat_users_id','=',$chat_users_id)->get();
      session(['active_element'=>5]);
      return view('admin.message-details',compact('client_data','company_data','message_data'));
    }
    public function chat_messages_duration()
    {
      if($_GET['chat_messages_duration']==1)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
      }
      else if($_GET['chat_messages_duration']==2)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()])->get();
      }
      else if($_GET['chat_messages_duration']==3)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->whereBetween('created_at', [Carbon::now()->subMonth(12), Carbon::now()])->get();
      }
      else if($_GET['chat_messages_duration']==3)
      {
        $message_data=ChatMessages::where('chat_users_id','=',$_GET['chat_users_id'])->where('created_at', '>', Carbon::now()->subMonth(12))->get();
      }
      return $message_data;
    }
}
