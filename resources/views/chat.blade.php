@extends('layouts.chat')

@section('content')
<div class="container">
  <nav class="nav-second">
      <ul>
        <li class="menu">
            <a class="menu" href="#"><i class="fa fa-bars" aria-hidden="true"></i>Menu</a>
        </li>
        <li>
            <a class="" href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>よくある質問</a>
        </li>
        <li>
            <a class="" href="/"><i class="fa fa-info-circle" aria-hidden="true"></i>サービスの流れ</a>
        </li>
      　<li class="open-chat">
            <a class="" href="#"><i  class="fa fa-comments" aria-hidden="true"></i>メッセージ<span id="notification"></span></a>
        </li>
      　<li>
            <a class="" href="/client_order_view_all"><i class="fa fa-list" aria-hidden="true"></i>注文履歴</a>
        </li>
      　<li>
            <a class="" href="/new_order"><i class="fa fa-plus-circle" aria-hidden="true"></i>新しいご注文</a>
        </li>
      　<li>

              @if(Auth::user())
                <a class="toggle" href="#"><i class="fa fa-user" aria-hidden="true"></i>{{Auth::user()->last_name}}<i class="fa fa-caret-down" aria-hidden="true"></i></a>

              @else
              <a href="/login" href="/login"><i class="fa fa-user" aria-hidden="true"></i>Login<i class="fa fa-caret-down" aria-hidden="true"></i></a>
              @endif
            <ul class="submenu">
              @if(Auth::user())
                <li><a href="#" onclick="logout()"><i class="fa fa-sign-out" aria-hidden="true"></i>ログアウト</a></li>
              @else
                <li><a href="/login"><i class="fa fa-sign-out" aria-hidden="true"></i>ログイン</a></li>
              @endif
                <li><a href="/mypage"><i class="fa fa-user" aria-hidden="true"></i>会員情報</a></li>
            </ul>
        </li>
      </ul>
  </nav>
  <div class="hero">
      <h2>メッセージ</h2>
  </div>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>連絡先</h4>
            </div>
            <!--<div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>-->
          </div>
          <div class="inbox_chat" id="selected-chat-companies">


          </div>
        </div>
        <div class="mesgs">

          <div class="msg_history" id="msg_history">

          </div>

          <div class="type_msg hidden">
            <div class="input_msg_write">
              <input id="typedMessage" type="text" class="write_msg" placeholder="ここにメッセージをご入力ください。" />
              <button class="msg_send_btn" type="button" onclick="send_typed_message()"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
      </div>

    </div></div>
@endsection
