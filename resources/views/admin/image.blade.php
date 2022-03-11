@extends('layouts.default')

@section('content')


<h3 class="admin-ttl">画像の追加</h3>
<p>「{{$shop->name}}」に追加する画像を選び、アップロードを押してください</p>

<form class="admin-image-form" method="POST" action="/admin/image" enctype="multipart/form-data">
@csrf
  <div class="admin-image-main">
    <input name="shop_id" type="hidden" value="{{$shop->id}}">
    <ul>
      <li>
        <label for="type">カテゴリー</label>
        <select name="type">
          <option value="料理">料理</option>
          <option value="外観">外観</option>
          <option value="店内">店内</option>
        </select>
      </li>
      <li>
        <label for="image">画像</label>
        <input name="image" type="file" required>
      </li>
    </ul>
  </div>
  <input class="admin-image-submit" type="submit" value="アップロード">

</form>

@endsection

<style>
  .admin-image-main{
    margin:20px 0;
  }
  .admin-image-main li{
    list-style:none;
  }
</style>