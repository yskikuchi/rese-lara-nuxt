<template>
  <div class="done-wrapper">
    <p>ご予約ありがとうございます</p>
    <p>ご来店の際にはマイページよりQRコードを表示し、従業員にお見せください。</p>
    <NuxtLink to="/">戻る</NuxtLink>
  </div>
</template>

<script>
export default {
  data(){
    return{
      user:[],
    }
  },
}
</script>

<style>
  .done-wrapper{
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
  .done-wrapper p{
    font-size:1.2em;
    margin-bottom:20px;
  }
  .done-wrapper a{
    display:block;
    text-decoration:none;
    width:130px;
    background:royalblue;
    color:white;
    border-radius:10px;
    padding:5px 0 ;
  }
  @media screen and (max-width: 768px) {
    .done-wrapper{
      width:100%;
    }
  }
</style>