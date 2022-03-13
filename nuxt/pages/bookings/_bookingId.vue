<template>
  <div>
    <span class="back-btn"><a @click="$router.back()">&lt;</a></span>
    <div class="booking-form">
        <p class="booking-ttl">予約</p>
        <input type="date" name="date" :min="fromDate" :max="untilDate" v-model="form.date" required>
        <select name="time" id="time" v-model="form.time">
          <option v-for="time in timeList" :key="time" :value="time">{{time}}</option>
        </select>
        <select name="number_of_people" id="number" v-model="form.number" required>
          <option v-for="number in numberList" :key="number" :value="number">{{number}}</option>
        </select>
        <select name="menu" v-model="form.menu" id="menu" required>
          <option selected>メニューを選んでください</option>
          <option v-for="menu in shop.menus" :key="menu.id" :value="menu.name">{{menu.name}}</option>
        </select>
        <p class="error">{{errors.date}}</p>
        <p class="error">{{errors.time}}</p>
        <p class="error">{{errors.number_of_people}}</p>
        <p class="error">{{errors.hasOtherBooking}}</p>
        <p class="error">{{errors.remainingSeats}}</p>
        <p class="error">{{errors.menu_id}}</p>
        <p class="current-booking">現在の予約日時</p>
        <table class="current-booking-status">
          <tr>
            <th>Shop</th>
            <td>{{shop.name}}</td>
          </tr>
          <tr>
            <th>Date</th>
            <td>{{bookedDate}}</td>
          </tr>
          <tr>
            <th>Time</th>
            <td>{{bookedTime|formatTime}}</td>
          </tr>
          <tr>
            <th>Number</th>
            <td>{{bookedNumber}}人</td>
          </tr>
          <tr>
            <th>Menu</th>
            <td>{{bookedMenuName}}</td>
          </tr>
        </table>
        <button class="booking-change-btn" @click="changeBooking">予約を変更する</button>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      errors:{
        date:"",
        time:"",
        menu_id:"",
        number_of_people:"",
        hasOtherBooking:"",
        remainingSeats:"",
      },
      form:{
        date:"",
        time:"",
        number:"",
        menu:"メニューを選んでください",
      },
      timeList:[],
      numberList:[],
      fromDate:"",
      untilDate:"",
      booking:"",
      shop:"",
      bookedDate:"",
      bookedTime:"",
      bookedNumber:"",
      bookedMenuName:"",
      selectedMenuId:"",
      processing:false,
    }
  },
  async mounted(){
    const resData = await this.$axios.get('/booking/' + this.$route.params.bookingId);
    this.booking= resData.data.data;
    this.shop = this.booking.shop;
    this.bookedDate = this.booking.date;
    this.bookedTime = this.booking.time;
    this.bookedNumber = this.booking.number_of_people;
    this.bookedMenuName = this.booking.menu.name;

    //日付の選択肢を翌日〜１ヶ月後に制限
    const tomorrow = new Date();
    const oneMonthLater = new Date();
    tomorrow.setDate(tomorrow.getDate()+1);
    oneMonthLater.setMonth(oneMonthLater.getMonth()+1);
    this.fromDate = tomorrow.toISOString().slice(0,10);
    this.untilDate = oneMonthLater.toISOString().slice(0,10);

    //予約時間、人数の選択肢を表示
    for(let i = 11; i <= 21 ;i++){
      let time1 = i + ':00';
      this.timeList.push(time1);
      let time2 = i + ':30';
      this.timeList.push(time2);
      }
    for(let i = 1; i <= this.booking.shop.number_of_seats ;i++){
      let number = i + '人';
      this.numberList.push(number);
    }
  },
  filters:{
    formatTime(time){
      return time.slice(0, -3);
    }
  },
  methods:{
    async changeBooking(){
      if(this.processing){
        return;
      }
      try{
        if(confirm('この内容で変更してよろしいですか？')){
          this.processing = true;
          Object.keys(this.errors).forEach((key) =>{
            this.errors[key] = "";
          })
        if(this.form.menu != "メニューを選んでください"){
          const selectedMenu = this.shop.menus.find(e => e.name == this.form.menu);
          this.selectedMenuId = selectedMenu.id;
        }
          const sendData={
            shop_id:this.booking.shop.id,
            date:this.form.date,
            time:this.form.time,
            number_of_people:this.form.number.slice(0, -1),
            booking_id:this.booking.id,
            menu_id:this.selectedMenuId,
          };
          await this.$axios.put("/booking/" + this.$route.params.bookingId, sendData);
          this.$router.push('/mypage');
        }
      }catch(e){
        // console.log(e.response.data.errors);
        const resData = e.response.data;
        Object.keys(resData.errors).forEach((key) =>{
          this.errors[key] = resData.errors[key][0];
        })
        this.processing = false;
      }
    }
  }
}
</script>

<style>
  .detail-wrapper{
    display:flex;
    justify-content:space-around;
  }
  .back-btn{
    display:inline-block;
    width:20px;
    font-size: 30px;
    padding: 5px;
    background-color:white;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.3);

  }
  .back-btn a{
    text-decoration:none;
  }
  .booking-form{
    width:40%;
    background-color:royalblue;
    color:white;
    position:relative;
    padding:0 20px;
    border-radius:10px;
    overflow:hidden;
  }
  .booking-form input, .booking-form select{
    display:block;
    height:30px;
    margin-bottom:10px;
  }
  .booking-form input{
    width:200px;
  }
  .booking-form select{
    width:80%;
  }
  .booking-ttl{
    font-size:25px;
    margin:20px 0;
  }
  .current-booking{
    margin-top:30px;
    font-size: 1em;
  }
  .current-booking-status{
    color:white;
    background-color:#75A9FF;
    width:80%;
    margin:20px auto 60px;
  }
  .current-booking-status th, .current-booking-status td{
    padding:10px;
    font-size: 1em;
  }
  .current-booking-status th{
    width:30%;
    text-align: left;
  }
  .booking-change-btn{
    width: 100%;
    height:40px;
    font-size:1em;
    border:none;
    background-color:blue;
    color:white;
    cursor:pointer;
    position:absolute;
    bottom:0;
    left:0;
  }
  .error{
    font-size:15px;
    color:rgb(250, 15, 66);
    margin-bottom:5px;
  }
  @media screen and (max-width: 768px) {
    .booking-form{
      width:90%;
    }
    .current-booking-status{
      margin:10px auto 50px;
    }
    .booking-change-btn{
      height:30px;
    }
  }
</style>