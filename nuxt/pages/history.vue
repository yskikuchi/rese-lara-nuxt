<template>
  <div class="booking_history">
    <h2>過去の予約</h2>
    <span class="back-btn"><NuxtLink to="/mypage">&lt;</NuxtLink></span>
    <p class="history-no-exist" v-if="$store.getters.getPastBookings.length == 0"> 過去の予約はありません</p>
    <section class="booking_card" v-for="booking in $store.getters.getPastBookings" :key="booking.id">
        <table>
          <tr>
            <th>Shop</th>
            <td>{{booking.shop.name}}</td>
          </tr>
          <tr>
            <th>Date</th>
            <td>{{booking.date}}</td>
          </tr>
          <tr>
            <th>Time</th>
            <td>{{booking.time|formatTime}}</td>
          </tr>
          <tr>
            <th>Number</th>
            <td>{{booking.number_of_people}}人</td>
          </tr>
        </table>
        <NuxtLink class="post-review" :to="{path:'shops/' + booking.shop.id + '/review'}">口コミを投稿する</NuxtLink>
    </section>
  </div>
</template>

<script>
export default {
  filters:{
    formatTime(time){
      return time.slice(0, -3);
    }
  },
}
</script>
<style scoped>
  .booking_history h2{
    font-size:25px;
    margin-bottom:20px;
  }
  .history-no-exist{
    font-size:25px;
    margin-top:10px;
  }
  .booking_card{
    width:30%;
    color:white;
    border-radius:5px;
    background-color:royalblue;
    padding:5px 10px;
    margin-top:10px;
    margin-bottom:20px;
    position:relative;
  }
  .booking_card span{
    font-size:1em;
    line-height:1.5em;
  }
  .booking_card table{
    color:white;
    font-size:1em;
    padding:10px;
  }
  .booking_card th{
    text-align:left;
    padding:5px 20px 5px 0;
  }
  .post-review{
    display: block;
    color: white;
    padding:10px;
  }
  @media screen and (max-width: 768px) {
    .booking_card{
      width:90%;
    }
  }
</style>