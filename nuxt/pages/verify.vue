<template>
  <div class="verified-wrapper">
    <p>ご登録のメールアドレスに本登録用のURLを送信しております。</p>
    <p>URLをクリックし、本登録を完了させてください。</p>
    <button @click="resend">再送信はこちら</button>
  </div>
</template>

<script>
export default{
  data(){
    return{
      processing:false,
    }
  },
  methods:{
    async resend(){
      if(this.processing){
        return;
      }
      this.processing = true;
      await this.$axios.post('/email/verification-notification');
      alert('メールを送信しました。ご確認ください。')
      this.processing = false;
    }
  }
}
</script>

<style>
  .verified-wrapper{
    width:50%;
    height:250px;
    margin:0 auto;
    text-align:center;
    background:white;
    border-radius:10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
  }
  .verified-wrapper p{
    font-size:1em;
    margin-bottom:20px;
  }
  .verified-wrapper button{
    display:block;
    text-decoration:none;
    width:130px;
    background:royalblue;
    color:white;
    border-radius:10px;
    padding:5px 0 ;
    border: none;
    cursor:pointer;
  }
  @media screen and (max-width: 768px) {
    .verified-wrapper{
      width:90%;
    }
  }
</style>