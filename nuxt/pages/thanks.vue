<template>
  <div class="thanks-wrapper">
    <p>会員登録ありがとうございます</p>
    <p>ご登録いただいたメールアドレスに本登録のためのURLを送信しました。</p>
    <p>メールをご確認の上、本登録を完了させてください。</p>
    <NuxtLink to="/">ホームへ</NuxtLink>
  </div>
</template>

<script>

</script>
<style>
  .thanks-wrapper{
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
  .thanks-wrapper p{
    font-size:1.2em;
    margin-bottom:20px;
  }
  .thanks-wrapper a{
    display:block;
    text-decoration:none;
    width:130px;
    background:royalblue;
    color:white;
    border-radius:10px;
    padding:5px 0 ;
  }
  @media screen and (max-width: 768px) {
    .thanks-wrapper{
      width:100%;
    }
  }
</style>