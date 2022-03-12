<template>
  <div class="card" :shop="shop" :width="width" :style="('width:' + width +'%')">
    <img v-if="$config.nodeEnv == 'development'" class="card-img" :src="shop.images[0].path|imagePathFormat($config.apiURL)" alt="#">
    <img v-else class="card-img" :src="shop.images[0].path|imagePathFormatProduction($config.awsURL)" alt="">
    <div class="card-content">
        <p class="card-name" >{{shop.name}}</p>
        <span class="card-tag">&#035;{{shop.area}}</span>
        <span class="card-tag">&#035;{{shop.genre}}</span>
      <div>
          <NuxtLink :to="{path:'detail/' + shop.id}" class="card-detail-btn">詳しく見る</NuxtLink>
          <img v-if="$auth.loggedIn && shop.favorites[0]" @click="unfavorite(shop.favorites[0])" class="fav-btn" src="~/assets/images/heart_red.png">
          <img v-else @click="favorite(shop.id)" class="fav-btn" src="~/assets/images/heart_gray.png">
          <img v-if="! $auth.loggedIn" class="fav-btn" src="~/assets/images/heart_gray.png">
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props:{
    shop:{
      type:Object
    },
    width:{
      type:Number
    }
  },
  data(){
    return{
      processing:false,
    }
  },
  filters:{
    imagePathFormat:function(path, apiUrl){
      return apiUrl + '/storage/images/' + path;
    },
    imagePathFormatProduction:function(path, awsUrl){
      return awsUrl + '/' + path;
    }
  },
  methods:{
    async favorite(shop_id){
      if(this.processing){
        return;
      }
      this.processing = true;
      const sendData = {
      user_id:this.$auth.user.id,
      shop_id:shop_id,
      };
      await this.$axios.post("/favorite", sendData);
      await this.$store.dispatch('getShops');
      this.$emit('changeFav');
      this.processing = false;
    },
    async unfavorite(e){
      if(this.processing){
        return;
      }
      this.processing = true;
      await this.$axios.delete("/favorite/" + e.id);
      await this.$store.dispatch('getShops');
      this.$emit('changeFav');
      this.processing = false;
      },
  }
}
</script>

<style>
  .card{
    border-radius:5px;
    overflow:hidden;
    background-color:white;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
    margin:10px;
    position:relative;
  }
  .card-content{
    padding:10px 20px;
  }
  .card-img{
    max-width:100%;
    height:auto;
  }
  .card-name{
    font-weight:bold;
    font-size:1em;
    margin: 10px 0;
  }
  .card-tag{
    font-size:1em;
  }
  .card-detail-btn{
    display:inline-block;
    width:60%;
    font-size:1em;
    padding:7px 0px;
    margin-top:20px;
    text-align:center;
    text-decoration:none;
    background:royalblue;
    color:white;
    border-radius:5px;
  }
  .fav-btn{
    width:18%;
    cursor:pointer;
    display:inline-block;
    position:absolute;
    bottom:0;
    right:0;
  }
    @media screen and (max-width: 768px) {
    .card{
      width: 48%!important;
      margin:5px 0;
    }
    .card-content{
      padding:7px 14px;
    }
    .card-name{
      margin:5px 0;
    }
    .card-tag{
    font-size:10px;
    }
    .card-detail-btn{
      margin-top:5px;
      font-size:10px;
    }
    .fav-btn{
      width:22%;
    }
  }
</style>
