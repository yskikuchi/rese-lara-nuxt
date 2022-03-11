<template>
  <div class="posted-wrapper">
    <p>投稿ありがとうございます</p>
    <NuxtLink to="/mypage">マイページへ戻る</NuxtLink>
  </div>
</template>

<style>
  .posted-wrapper{
    width:45%;
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
  .posted-wrapper p{
    font-size:1em;
    margin-bottom:20px;
  }
  .posted-wrapper a{
    display:block;
    text-decoration:none;
    width:150px;
    background:royalblue;
    color:white;
    border-radius:10px;
    padding:5px 0 ;
  }
  @media screen and (max-width: 768px) {
    .posted-wrapper{
      width:90%;
    }
  }
</style>