<template>
  <div class="login-wrapper">
    <p class="login-ttl">Login</p>
    <form @submit.prevent="login" class="login-form">
        <div>
          <input type="email" name="email" placeholder="Email" v-model="form.email" required>
        </div>
        <div>
          <input type="password" name="password" placeholder="Password" v-model="form.password" required>
        </div>
        <div>
          <button class="login-btn" type="submit">ログイン</button>
        </div>
        <p class="to-register"><NuxtLink to="/register">会員登録はこちら</NuxtLink></p>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form:{
        email:"",
        password:""
      },
      processing:false,
    }
  },
  methods:{
    async login(){
      if(this.processing){
        return;
      }
      try{
        this.processing = true;
        await this.$auth.loginWith("cookie",{
          data:this.form,
        });
      }catch(e){
        alert('メールアドレスまたはパスワードに誤りがあります')
        this.processing = false;
      }
    }
  }
}
</script>

<style>
    .login-ttl{
        background:royalblue;
        color:white;
        padding:15px 20px;
        font-size:25px;
        margin:0;
    }
    .login-wrapper{
        margin:0 auto;
        width:45%;
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
    .to-register{
        text-align:center;
        margin-top:10px;
    }
    .to-register a{
        color:royalblue;
    }
    .error{
        color:red;
        margin:10px;
    }
  @media screen and (max-width: 768px) {
    .login-wrapper{
      width:90%;
    }

  }
</style>