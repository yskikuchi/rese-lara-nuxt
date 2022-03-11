<body>
  <div class="login-wrapper">
    <p class="login-ttl">管理者ログインフォーム</p>
    @error('email')
      <p class="error">メールアドレスまたはパスワードに誤りがあります</p>
    @enderror
    <form method="POST" action="/admin/login" class="login-form">
        @csrf
        <div>
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div>
          <button class="login-btn">ログイン</button>
        </div>
    </form>
  </div>
<body>

<style>
    .login-ttl{
        background:royalblue;
        color:white;
        padding:15px 20px;
        font-size:22px;
        margin:0;
    }
    .login-wrapper{
        margin:0 auto;
        width:35%;
        background:white;
        border-radius:10px;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        overflow:hidden;
    }
    .login-form{
        width:70%;
        margin:20px auto;
    }
    .login-form input{
        width:100%;
        height:25px;
        border:none;
        border-bottom:1px solid black;
        margin-bottom:10px;
    }
    .login-form div:last-of-type{
        display:flex;
        justify-content:flex-end;
        margin-top:10px;
    }
    .login-btn{
        background-color:royalblue;
        color:white;
        border:none;
        border-radius:5px;
        padding:5px 10px;
    }

    .error{
        color:red;
        margin:10px;
    }
</style>