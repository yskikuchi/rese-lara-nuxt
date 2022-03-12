<template>
  <div class="register-wrapper">
    <p class="register-ttl">Registration</p>
        <form class="register-form" @submit.prevent="register">
          <div>
            <input type="text" name="name" placeholder="Username" v-model="form.name" required>
            <p class="error">{{errors.name}}</p>
          </div>
          <div>
            <input type="email" name="email" placeholder="Email" v-model="form.email" required>
            <p class="error">{{errors.email}}</p>
          </div>
          <div>
            <input type="text" name="tel" placeholder="TEL" v-model="form.tel">
            <p class="error">{{errors.tel}}</p>
          </div>
          <div>
            <input type="password" name="password" placeholder="Password" v-model="form.password" required>
            <p class="error">{{errors.password}}</p>
          </div>
          <div>
            <button class="register-btn" type="submit">登録</button>
          </div>
          <p class="to-login"><NuxtLink to="/login">会員の方はこちら</NuxtLink></p>
        </form>
  </div>
</template>


<script>
export default {
  auth:'guest',
  data(){
    return{
      errors:{
        name:"",
        email:"",
        tel:"",
        password:"",
      },
      form:{
        name:"",
        email:"",
        tel:"",
        password:"",
      },
      processing:false,
    }
  },
  methods:{
    async register(){
      if(this.processing){
        return;
      }
      this.processing = true;
      try{
          Object.keys(this.errors).forEach((key) =>{
          this.errors[key] = "";
        })
        await this.$axios.get("/sanctum/csrf-cookie");
        await this.$axios.post("/register", this.form);
        await this.$auth.loginWith('cookie',{
          data:{
            email:this.form.email,
            password:this.form.password,
            },
        });
        this.$router.push('/thanks');
      }catch(e){
        if (e.response.data.message == 'The given data was invalid.'){
        const resData = e.response.data;
        Object.keys(resData.errors).forEach((key) =>{
          this.errors[key] = resData.errors[key][0];
        })
        this.processing = false;
        }
      }
    }
  }
}
</script>

<style>
    .register-ttl{
        background:royalblue;
        color:white;
        padding:15px 20px;
        font-size:20px;
    }
    .register-wrapper{
        margin:0 auto;
        width:45%;
        background:white;
        border-radius:10px;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        overflow:hidden;
    }
    .register-form{
        width:70%;
        margin:20px auto;
    }
    .register-form input{
        width:100%;
        height:25px;
        border:none;
        border-bottom:1px solid black;
        margin-bottom:10px;
    }
    .register-form div:last-of-type{
        display:flex;
        justify-content:flex-end;
        margin-top:20px;
    }
    .register-btn{
        background-color:royalblue;
        color:white;
        border:none;
        border-radius:5px;
        padding:5px 10px;
    }
    .to-login{
        text-align:center;
        margin-top:10px;
    }
    .to-login a{
        color:royalblue;
    }
    .error{
        font-size:15px;
        color:red;
        margin-bottom:5px;
    }
  @media screen and (max-width: 768px) {
    .register-wrapper{
      width:90%;
    }
  }
</style>