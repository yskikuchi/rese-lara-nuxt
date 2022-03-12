<template>
  <div class="detail-wrapper">
    <div class="shop-detail">
      <p class="shop-name">
        <span class="back-btn"><NuxtLink to="/history">&lt;</NuxtLink></span>
        {{shop.name}}
      </p>
      <img class="shop-detail_img" :src="image" alt="#">
      <div class="shop-tag">
        <span>&#035;{{shop.area}}</span>
        <span>&#035;{{shop.genre}}</span>
      </div>
      <p class="shop-intro">{{shop.detail}}</p>
    </div>
    <div class="review-form">
      <label class="review-label" for="rating">評価（５点満点）</label>
      <select type="text" name="rating" v-model="rating">
        <option v-for="rating in ratingList" :key="rating">{{rating}}</option>
      </select>
      <p class="error">{{errors.star}}</p>
      <label class="review-label" for="comment">コメント</label>
      <textarea name="comment" class="review-comment" cols="30" rows="10" v-model="comment" placeholder="コメントを記入してください"></textarea>
      <p class="error">{{errors.comment}}</p>
      <p class="error">{{errors.hasBookingHistory}}</p>
      <button class="comment-btn" @click="postComment">投稿する</button>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      errors:{
        comment:"",
        star:"",
        hasBookingHistory:"",
      },
      shop:"",
      image:"",
      ratingList:[],
      rating:"",
      comment:"",
      processing:false,
    }
  },
  async mounted(){
    const resData = await this.$axios.get('/shops/' + this.$route.params.shopId);
    this.shop = resData.data.data;
    this.image = this.$config.apiURL + '/' + this.shop.images[0].path;
    for(let i = 1; i <= 5 ;i++){
      let rate = i + '点';
      this.ratingList.push(rate);
      }
  },
  methods:{
    async postComment(){
      try{
        if(this.processing){
          return;
        }
        Object.keys(this.errors).forEach((key) =>{
          this.errors[key] = "";
        })
      const sendData = {
        user_id:this.$auth.user.id,
        shop_id:this.shop.id,
        comment:this.comment,
        star:this.rating.slice(0, -1),
      }
        if(confirm('この内容で投稿してよろしいですか？')){
          this.processing = true;
          await this.$axios.post("/review",sendData);
          this.$router.push('/posted');
        }
      }catch(e){
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

<style scoped>
  .detail-wrapper{
    display:flex;
    justify-content:space-around;
    margin-bottom:50px;
  }
  .shop-detail{
    width:40%;
  }
  .back-btn{
    display:inline-block;
    width:20px;
    background-color:white;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.3);

  }
  .back-btn a{
    text-decoration:none;
  }
  .shop-name{
    font-size:25px;
    margin-bottom:20px;
  }
  .shop-detail_img{
    width:100%;
    height:auto;
  }
  .shop-tag{
    margin:10px 1px 20px 5px;
  }
  .shop-intro{
    font-size: 1em;
    line-height: 1.5rem;
  }
  .review-form{
    width:40%;
    background-color:royalblue;
    color:white;
    position:relative;
    padding:0 20px;
    border-radius:10px;
    overflow:hidden;
  }
  .review-form input, .review-form select{
    display:block;
    height:30px;
    margin-bottom:10px;
  }
  .review-form input{
    width:200px;
  }
  .review-label{
    display: block;
    margin:10px 0;
    font-size:20px;
  }
  .review-comment{
    width:90%;
    height: 50%;
    margin-bottom:50px;
  }
  .comment-btn{
    width: 100%;
    height:40px;
    border:none;
    background-color:blue;
    color:white;
    position:absolute;
    bottom:0;
    left:0;
    cursor:pointer;
  }
  .error{
    font-size:15px;
    color:rgb(250, 15, 66);
    margin-bottom:5px;
  }
  @media screen and (max-width: 768px) {
    .detail-wrapper{
      flex-direction: column;
    }
    .shop-detail, .review-form{
      width:90%;
    }
  }
</style>