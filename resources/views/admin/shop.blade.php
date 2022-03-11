@extends('layouts.default')

@section('content')
<h2 class="admin-ttl">店舗情報の変更</h2>

@if($shop->name == '新規店舗')
<p>新規作成画面</p>
<form method="POST" action="{{ route('admin.shop.create') }}" enctype="multipart/form-data">
  @csrf
  <input name="id" type="hidden" value="{{$shop->id}}">
  <table class="admin-shop-info">
    <tr>
      <th><label for="name">店名</label></th>
      <td><input name="name" type="text" value="{{$shop->name}}" required></td>
    </tr>
    <tr>
      <th><label for="genre">ジャンル</label></th>
      <td>
        <input name="genre" type="text" value="{{$shop->genre}}" required>
      </td>
    </tr>
    <tr>
      <th><label for="area">エリア</label></th>
      <td>
        <!-- <input name="area" type="text" value="{{$shop->area}}"> -->
        <select name="area" value="{{$shop->genre}}" required>
          <option value="" selected>都道府県</option>
          <option value="北海道">北海道</option>
          <option value="青森県">青森県</option>
          <option value="岩手県">岩手県</option>
          <option value="宮城県">宮城県</option>
          <option value="秋田県">秋田県</option>
          <option value="山形県">山形県</option>
          <option value="福島県">福島県</option>
          <option value="茨城県">茨城県</option>
          <option value="栃木県">栃木県</option>
          <option value="群馬県">群馬県</option>
          <option value="埼玉県">埼玉県</option>
          <option value="千葉県">千葉県</option>
          <option value="東京都">東京都</option>
          <option value="神奈川県">神奈川県</option>
          <option value="新潟県">新潟県</option>
          <option value="富山県">富山県</option>
          <option value="石川県">石川県</option>
          <option value="福井県">福井県</option>
          <option value="山梨県">山梨県</option>
          <option value="長野県">長野県</option>
          <option value="岐阜県">岐阜県</option>
          <option value="静岡県">静岡県</option>
          <option value="愛知県">愛知県</option>
          <option value="三重県">三重県</option>
          <option value="滋賀県">滋賀県</option>
          <option value="京都府">京都府</option>
          <option value="大阪府">大阪府</option>
          <option value="兵庫県">兵庫県</option>
          <option value="奈良県">奈良県</option>
          <option value="和歌山県">和歌山県</option>
          <option value="鳥取県">鳥取県</option>
          <option value="島根県">島根県</option>
          <option value="岡山県">岡山県</option>
          <option value="広島県">広島県</option>
          <option value="山口県">山口県</option>
          <option value="徳島県">徳島県</option>
          <option value="香川県">香川県</option>
          <option value="愛媛県">愛媛県</option>
          <option value="高知県">高知県</option>
          <option value="福岡県">福岡県</option>
          <option value="佐賀県">佐賀県</option>
          <option value="長崎県">長崎県</option>
          <option value="熊本県">熊本県</option>
          <option value="大分県">大分県</option>
          <option value="宮崎県">宮崎県</option>
          <option value="鹿児島県">鹿児島県</option>
          <option value="沖縄県">沖縄県</option>
        </select>
      </td>
    </tr>
    <tr>
      <th><label for="detail">概要</label></th>
      <td><textarea name="detail" cols="50" rows="10">{{$shop->detail}}</textarea></td>
    </tr>
    <tr>
      <th><label for="number_of_seats">席数</label></th>
      <td><input name="number_of_seats" type="text" value="{{$shop->number_of_seats}}" required></td>
    </tr>
    <tr>
      <th><label for="image">画像</label></th>
      <td><input name="image" type="file" required></td>
    </tr>
  </table>
  <button>作成する</button>
</form>

@else

<p>修正箇所を入力後、「変更する」のボタンを押してください。</p>
<form method="POST" action="{{ route('admin.shop.update') }}" enctype="multipart/form-data">
  @csrf
  <input name="_method" type="hidden" value="PUT">
  <input name="id" type="hidden" value="{{$shop->id}}">
  <table class="admin-shop-info">
    <tr>
      <th><label for="name">店名</label></th>
      <td><input name="name" type="text" value="{{$shop->name}}" required></td>
    </tr>
    <tr>
      <th><label for="detail">概要</label></th>
      <td><textarea name="detail" cols="50" rows="10">{{$shop->detail}}</textarea></td>
    </tr>
    <tr>
      <th><label for="number_of_seats">席数</label></th>
      <td><input name="number_of_seats" type="text" value="{{$shop->number_of_seats}}" required></td>
    </tr>
    <tr>
      <th><label for="image">画像</label></th>
      <td><input name="image" type="file"></td>
    </tr>
  </table>
  <button>変更する</button>
</form>

@endif

<a href="/admin/dashboard">管理画面トップへ</a>

@endsection

<style>
  .admin-shop-info th, .admin-shop-info td{
    padding:7px;
  }
</style>