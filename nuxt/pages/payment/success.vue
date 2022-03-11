<template>
  <div class="success-wrapper">
    <p>決済が完了しました</p>
    <p>ご来店をお待ちしております</p>
    <NuxtLink to="/">ホームへ</NuxtLink>
  </div>
</template>

<style>

  .success-wrapper{
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
  .success-wrapper p{
    font-size:1.2em;
    margin-bottom:20px;
  }
  .success-wrapper a{
    display:block;
    text-decoration:none;
    width:130px;
    background:royalblue;
    color:white;
    border-radius:10px;
    padding:5px 0 ;
  }
  @media screen and (max-width: 768px) {
    .success-wrapper{
      width:100%;
    }
  }

</style>