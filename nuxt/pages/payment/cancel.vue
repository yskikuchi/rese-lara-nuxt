<template>
  <div class="canceled-wrapper">
    <p>支払いがキャンセルされました</p>
    <p>事前決済をする場合はマイページからお願いします</p>
    <NuxtLink to="/">ホームへ</NuxtLink>
  </div>
</template>

<style>

  .canceled-wrapper{
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
  .canceled-wrapper p{
    font-size:1.2em;
    margin-bottom:20px;
  }
  .canceled-wrapper a{
    display:block;
    text-decoration:none;
    width:130px;
    background:royalblue;
    color:white;
    border-radius:10px;
    padding:5px 0 ;
  }
  @media screen and (max-width: 768px) {
    .canceled-wrapper{
      width:100%;
    }
  }

</style>