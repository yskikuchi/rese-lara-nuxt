@extends('layouts.default')

@section('content')
<table class="admin-booking-list">
    <tr>
      <th>ステータス</th>
      <th>日付</th>
      <th>時間</th>
      <th>人数</th>
      <th>予約者名</th>
      <th>メールアドレス</th>
      <th>電話番号</th>
    </tr>
    <tr>
      @if($booking->deleted_at)
      <td>キャンセル</td>
      @else
      <td></td>
      @endif
      <td>{{$booking->date}}</td>
      <td>{{$booking->time}}</td>
      <td>{{$booking->number_of_people}}</td>
      <td>{{$booking->user->name}}</td>
      <td>{{$booking->user->email}}</td>
      <td>{{$booking->user->tel}}</td>
    </tr>
</table>

@endsection

<style>
  .admin-booking-list{
    text-align:center;
  }
  .admin-booking-list th{
    padding:10px;
    font-size:20px;
  }
  .admin-booking-list td{
    padding:10px;
  }
  @media screen and (max-width: 768px) {

  }
</style>