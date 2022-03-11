@extends('layouts.default')

@section('content')


<h2 class="admin-ttl">管理画面</h2>
<p>ログイン名：{{Auth::user()->name}}</p>
<form method="POST" action="/admin/logout">
  @csrf
  <button class="admin-logout">ログアウト</button>
</form>

<div class="admin-contents">
  <div class="admin-menu_left">
    <h3>●店舗代表者を追加</h3>
    @can('isAdmin')
    <form method="POST" action="/admin/manager">
    @csrf
      <table class="admin-dashboard_form">
        <tr>
          <td>
            <label for="name">氏名</label>
          </td>
          <td>
            <input name="name" type="text" value="{{old('name')}}" required>
              @error('name')
              <p class="error">{{$message}}</p>
              @enderror
          </td>
        </tr>
        <tr>
          <td>
            <label for="email">メールアドレス</label>
          </td>
          <td>
            <input name="email" type="email" value="{{old('email')}}" required>
              @error('email')
              <p class="error">{{$message}}</p>
              @enderror
          </td>
        </tr>
        <tr>
          <td>
            <label for="password">パスワード</label>
          </td>
          <td>
            <input name="password" type="password" required>
              @error('password')
              <p class="error">{{$message}}</p>
              @enderror
          </td>
        </tr>
        <tr>
          <td>
            <label for="shop">担当店舗</label>
          </td>
          <td>
            <select name="shop">
              <option value="new-shop">新規店舗</option>
              @foreach($shops as $shop)
              <option value="{{$shop->id}}">{{$shop->id}}.{{$shop->name}}</option>
              @endforeach
            </select>
          </td>
        </tr>
      </table>
      <button class="add-btn">店舗代表者を追加</button>
    </form>
      <table class="manager-list">
        <tr>
          <th>店名</th>
          <th>店舗代表者</th>
          <th>メールアドレス</th>
        </tr>
        @foreach($managers as $manager)
        <tr>
          <td>{{$manager->shop->name}}</td>
          <td>{{$manager->name}}</td>
          <td>{{$manager->email}}</td>
        </tr>
        @endforeach
      </table>
    </ul>
    @else
    <p>管理者のみが店舗代表者を追加できます</p>

    @endcan
  </div>
  <div class="admin-menu_right">
    <h3>●店舗情報の作成・更新</h3>

    @can('isAdmin')
      <p>変更する店舗情報を選択し、更新ページへ進んでください</p>
    @else
      <p>更新ページへ進んでください</p>
    @endcan

    <form method="GET" action="/admin/shop">
      <select name="shop_id">
        @foreach($shops as $shop)
          @can('isAdmin')
            <option value="{{$shop->id}}">{{$shop->id}}.{{$shop->name}}</option>
          @else
            @if(Auth::user()->shop->id == $shop->id)
              <option value="{{$shop->id}}">{{$shop->id}}.{{$shop->name}}</option>
            @endif
          @endcan
        @endforeach
      </select>
      <button>更新ページへ</button>
    </form>

    <h3>●予約確認</h3>
      <form method="GET" action="/admin/booking">
      <select name="shop_id">
        @foreach($shops as $shop)
          @can('isAdmin')
            <option value="{{$shop->id}}">{{$shop->id}}.{{$shop->name}}</option>
          @else
            @if(Auth::user()->shop->id == $shop->id)
              <option value="{{$shop->id}}">{{$shop->id}}.{{$shop->name}}</option>
            @endif
          @endcan
        @endforeach
      </select>
      <button>予約一覧へ</button>
      </form>

    <h3>●お店の画像の追加</h3>
      <form method="GET" action="/admin/image">
      <select name="shop_id">
        @foreach($shops as $shop)
          @can('isAdmin')
            <option value="{{$shop->id}}">{{$shop->id}}.{{$shop->name}}</option>
          @else
            @if(Auth::user()->shop->id == $shop->id)
              <option value="{{$shop->id}}">{{$shop->id}}.{{$shop->name}}</option>
            @endif
          @endcan
        @endforeach
      </select>
      <button>店舗ページへ</button>
      </form>
  </div>
</div>

@endsection

<script>

</script>


<style>
  .admin-logout{
    margin:10px;
  }
  .admin-contents h3{
    margin:20px 0;
  }
  .admin-dashboard_form{
    margin:20px 10px;
  }
  .admin-dashboard_form td{
    height:25px;
    padding:10px;
  }
  .admin-contents{
    display:flex;
    margin-top:20px;
    width:100%;
    justify-content:space-around;
  }
  .admin-menu-left, .admin-menu-right{
    width:40%;
  }
  .add-btn{
    margin-bottom:10px;
  }
  .manager-list{
    margin:20px 0;
  }
  .manager-list th{
    padding:10px;
  }
  .manager-list td{
    padding:5px 20px;
  }
  .error{
    color:red;
  }
</style>