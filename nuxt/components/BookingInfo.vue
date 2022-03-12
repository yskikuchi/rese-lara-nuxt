<template>
  <div>
    <section class="booking_card" :booking="booking" :index="index">
      <span class="booking_card_ttl">予約{{index+1}}</span>
      <span v-if="booking.checked == 1" class="checked">(支払い済)</span>
      <span v-else><button class="checkout" @click="checkout">事前決済をする</button></span>
      <img @click="cancelBooking(booking.id, index+1)" class="close-btn" src="~assets/images/close.png">
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
          <tr>
            <th>Menu</th>
            <td>{{booking.menu.name}}</td>
          </tr>
        </table>
        <NuxtLink class="change-booking" :to="{path:'bookings/' + booking.id}">日時、人数を変更する</NuxtLink>
        <button class="qr-btn" @click="toggleIsShowQR">QRコードを表示</button>
        <div class="qrcode-wrapper" v-show="isShowQR">
          <div class="qrcode-content">
            <p>こちらのQRコードを従業員にお見せください</p>
            <img :src="qrcode" alt="QRcode">
            <button class="qr-close" @click="toggleIsShowQR">閉じる</button>
          </div>
        </div>
    </section>
  </div>
</template>

<script>
const QRCode = require('qrcode');

export default {
  props:{
    booking:{
      type:Object
    },
    index:{
      type:Number
    }
  },
  data(){
    return{
      isShowQR:false,
      qrcode:"",
      sendData:{
          user_id:this.$auth.user.id,
          shop_id:this.booking.shop.id,
          menu_id:this.booking.menu.id,
          booking_id:this.booking.id,
          number_of_people:this.booking.number_of_people,
      },
      processing:false,
    };
  },
  filters:{
    formatTime(time){
      return time.slice(0, -3);
    }
  },
  mounted(){
    QRCode.toDataURL(this.$config.apiURL + '/admin/booking/' + this.booking.id, (e, url)=>{
      if(e){
        throw e
      }
      this.qrcode = url;
    })
  },
  methods:{
    async cancelBooking(id, index){
      if(this.processing){
        return;
      }
      if(confirm('予約'+index +'を削除してよろしいですか？')){
        await this.$axios.delete('/booking/' + id);
        await this.$store.dispatch('getMyBookings');
      }
    },
    toggleIsShowQR: function(){
      this.isShowQR = !this.isShowQR;
    },
    async checkout(){
      try{
        if(this.processing){
          return;
        }
        if(confirm('事前決済ページへ移動しますか？')){
          this.processing = true;
          const res = await this.$axios.post('/pay',this.sendData);
          const sessionId = res.data.data.id;
          await this.$stripe.redirectToCheckout({
          sessionId : sessionId
        }).then((result) => {
          console.log(result);
        })
      }
      }catch(e){
        console.log(e);
        this.processing = false;
      }
    },
  }
}
</script>

<style>
  .booking_card{
    width:55%;
    color:white;
    border-radius:5px;
    background-color:royalblue;
    padding:5px 10px;
    margin-bottom:20px;
    position:relative;
  }
  .booking_card_ttl{
    font-size:20px;
    line-height:1.5em;
  }
  .checked{
    margin-left: 10px;
    background: rgb(255, 104, 104);
    padding:3px 6px;
    border-radius: 5px;
    font-size: 15px;
  }
  .checkout{
    margin-left: 10px;
    background: rgb(248, 166, 14);
    border:none;
    border-radius: 5px;
    color:white;
  }
  .booking_card table{
    color:white;
    font-size:1em;
    padding:10px;
    margin:5px;
  }
  .booking_card th{
    text-align:left;
    padding:5px 20px 5px 0;
  }

  .close-btn{
    height:13%;
    position:absolute;
    top:7%;
    right:5%;
  }
  .change-booking{
    display: inline-block;
    color: white;
    padding:10px;
  }
  .qr-btn{
    background-color: inherit;
    border:none;
    color:white;
    display: block;
    font-size:15px;
  }
  .qrcode-wrapper{
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: white;
      z-index:9;
  }
  .qrcode-content{
    width:70%;
    margin:0 auto;
    color:black;
    text-align: center;
  }
  .qr-close{
    display: block;
    margin:0 auto;
  }
  @media screen and (max-width: 768px) {
    .booking_card{
      width:90%;
    }
  }

</style>