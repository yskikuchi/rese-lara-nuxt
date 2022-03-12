<template>
  <div class="shop-image-container">
    <h2>写真一覧</h2>
    <div class="shop-image-main">
      <h3>外観</h3>
      <div v-if="exteriorImages.length != 0" class="shop-image-content">
        <div class="shop-image-card" v-for="image in exteriorImages" :key="image.id">
          <img v-if="$config.nodeEnv == 'development'" :src="image.path|imagePathFormat($config.apiURL)">
          <img v-else :src="image.path|imagePathFormatProduction($config.awsURL)">
        </div>
      </div>
      <div v-else>この店舗の画像はまだありません</div>
      <h3>店内</h3>
      <div v-if="interiorImages.length != 0" class="shop-image-content">
        <div class="shop-image-card" v-for="image in interiorImages" :key="image.id">
          <img v-if="$config.nodeEnv == 'development'" :src="image.path|imagePathFormat($config.apiURL)">
          <img v-else :src="image.path|imagePathFormatProduction($config.awsURL)">
        </div>
      </div>
      <div v-else>この店舗の画像はまだありません</div>
      <div>
        <h3>料理</h3>
        <div v-if="foodImages.length != 0" class="shop-image-content">
          <div class="shop-image-card" v-for="image in foodImages" :key="image.id">
          <img v-if="$config.nodeEnv == 'development'" :src="image.path|imagePathFormat($config.apiURL)">
          <img v-else :src="image.path|imagePathFormatProduction($config.awsURL)">
          </div>
        </div>
        <div v-else>この店舗の画像はまだありません</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      id:this.$route.params.shopId,
      images:[],
      exteriorImages:[],
      interiorImages:[],
      foodImages:[],
    }
  },
  async mounted(){
    const resData = await this.$axios.get('/images/' + this.$route.params.shopId);
    this.images = resData.data.data;
    this.exteriorImages = this.images.filter(e => e.type == '外観');
    this.interiorImages = this.images.filter(e => e.type == '店内');
    this.foodImages = this.images.filter(e => e.type == '料理');
  },
  filters:{
    imagePathFormat:function(path, apiUrl){
      return apiUrl + '/storage/images/' + path;
    },
    imagePathFormatProduction:function(path, awsUrl){
      return awsUrl + '/' + path;
    }
  }
}
</script>

<style scoped>
  .shop-image-container h2{
    font-size:25px;
  }
  .shop-image-container h3{
    font-size: 18px;
    margin:20px 0 10px;
  }
  .shop-image-main{
    margin-top:15px;
  }
  .shop-image-content{
    display: flex;
    flex-wrap:wrap;
  }
  .shop-image-card{
    width:19%;
    margin-left:10px;
  }
  .shop-image-card img{
    width:100%;
    margin:5px;
  }
  @media screen and (max-width: 768px) {
    .shop-image-card{
      width:47%;
      margin-left:5px;
    }
  }
</style>