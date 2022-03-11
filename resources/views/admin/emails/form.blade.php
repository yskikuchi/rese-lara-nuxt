
<h3>{{$user->name}}さんへメールを送ります</h3>
<form method="POST" action="/admin/mail">
@csrf
  <table>
    <tr>
      <th>
        <label for="email">メールアドレス</label>
      </th>
      <th>
        <input name="email" type="text" value="{{$user->email}}">
      </th>
    </tr>
    <tr>
      <th>
        <label for="name">名前</label>
      </th>
      <th>
        <input name="name" type="text" value="{{$user->name}}">
      </th>
    </tr>
    <tr>
      <th>
        <label for="main">本文</label>
      </th>
      <th>
        <textarea name="main" id="" cols="30" rows="10"></textarea>
      </th>
    </tr>
  </table>
  <button>送信</button>
</form>
