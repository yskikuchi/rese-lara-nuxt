<template>
  <div>
    <div class="search-wrapper">
      <button @click="clearSort" class="clear-btn">CLEAR</button>
      <select @change="changeArea" class="search-select" name="searchArea" v-model="selectedArea">
        <option value="All area">All area</option>
        <option v-for="area in $store.getters.getAreaList" :key="area" :value="area">{{area}}</option>
      </select>
      <select @change="changeGenre" class="search-select" name="searchGenre" v-model="selectedGenre">
        <option value="All genre">All genre</option>
        <option v-for="genre in $store.getters.getGenreList" :key="genre" :value="genre">{{genre}}</option>
      </select>
      <input @keyup="inputWord" class="search-input" type="text" placeholder="Search..." v-model="searchWord">
    </div>
    <div class="card-wrapper">
      <Shop v-for="shop in $store.state.shops" :key="shop.id" :shop="shop" :width="width" v-show="selectedList.includes(shop.name)"></Shop>
    </div>
  </div>
</template>

<script>
export default {
  auth:false,
  data(){
    return{
        width:22,
        selectedArea:"All area",
        selectedGenre:"All genre",
        searchWord:"",
        selectedList:[],
    };
  },
  mounted(){
    this.showAllShops();
  },
  methods:{
    async showAllShops(){
      this.selectedList = [];
      await this.$store.dispatch('getShops');
      for(let i = 0; i < this.$store.state.shops.length; i++){
        this.selectedList.push(this.$store.state.shops[i].name);
      }
    },
      async clearSort(){
        this.selectedArea = "All area";
        this.selectedGenre = "All genre";
        this.searchWord = "",
        this.showAllShops();
      },
      changeArea(){
        for(let i = 0; i < this.$store.state.shops.length; i++){
          const shopName = this.$store.state.shops[i].name;
          const shopArea = this.$store.state.shops[i].area;
          const shopGenre = this.$store.state.shops[i].genre;
          if(this.selectedArea == "All area"){
            if(this.selectedGenre == "All genre"){
              if(this.searchWord){
                this.searchedByWord(this.$store.state.shops[i].name);
              }else{
                if(!this.selectedList.includes(shopName)){
                this.selectedList.push(shopName);
                }
              }
            }else{
              if(shopGenre == this.selectedGenre){
                if(this.searchWord){
                  this.searchedByWord(this.$store.state.shops[i].name);
                }else{
                  if(!this.selectedList.includes(shopName)){
                  this.selectedList.push(shopName);
                  }
                }
              }
            }
          }else{
            if(this.selectedGenre == "All genre"){
              if(shopArea == this.selectedArea){
                if(this.searchWord){
                  this.searchedByWord(this.$store.state.shops[i].name);
                }else{
                  if(!this.selectedList.includes(shopName)){
                  this.selectedList.push(shopName);
                  }
                }
              }else{
                this.selectedList = this.selectedList.filter(function(e){
                  return ! shopName.includes(e);
                });
              }
            }else{
              if(shopGenre == this.selectedGenre && shopArea == this.selectedArea){
                if(this.searchWord){
                this.searchedByWord(this.$store.state.shops[i].name);
                }else{
                  if(!this.selectedList.includes(shopName)){
                  this.selectedList.push(shopName);
                  }
                }
              }else{
                this.selectedList = this.selectedList.filter(function(e){
                  return ! shopName.includes(e);
                })
              }
            }
          }
          }
      },
      changeGenre(){
        for(let i = 0; i < this.$store.state.shops.length; i++){
          const shopName = this.$store.state.shops[i].name;
          const shopArea = this.$store.state.shops[i].area;
          const shopGenre = this.$store.state.shops[i].genre;
          if(this.selectedGenre == "All genre"){
            if(this.selectedArea == "All area"){
              if(this.searchWord){
                this.searchedByWord(this.$store.state.shops[i].name);
              }else{
                if(!this.selectedList.includes(shopName)){
                this.selectedList.push(shopName);
                }
              }
            }else{
              if(shopArea == this.selectedArea){
                if(this.searchWord){
                  this.searchedByWord(this.$store.state.shops[i].name);
                }else{
                  if(!this.selectedList.includes(shopName)){
                  this.selectedList.push(shopName);
                  }
                }
              }
            }
          }else{
            if(this.selectedArea == "All area"){
              if(shopGenre == this.selectedGenre){
                if(this.searchWord){
                  this.searchedByWord(this.$store.state.shops[i].name);
                }else{
                  if(!this.selectedList.includes(shopName)){
                  this.selectedList.push(shopName);
                  }
                }
              }else{
              this.selectedList = this.selectedList.filter(function(e){
                return ! shopName.includes(e);
              });
              }
            }else{
              if(shopGenre == this.selectedGenre && shopArea == this.selectedArea){
                if(this.searchWord){
                  this.searchedByWord(this.$store.state.shops[i].name);
                }else{
                  if(!this.selectedList.includes(shopName)){
                  this.selectedList.push(shopName);
                  }
                }
              }else{
                this.selectedList = this.selectedList.filter(function(e){
                  return ! shopName.includes(e);
                })
              }
              }
          }
        }
      },
      searchedByWord(shopName){
            if(shopName.search(this.searchWord) != -1){
              if(!this.selectedList.includes(shopName)){
                this.selectedList.push(shopName);
              }
              }else{
                  this.selectedList = this.selectedList.filter(function(e){
                  return ! shopName.includes(e);
                  })
                }
      },
      inputWord(){
        for(let i = 0; i < this.$store.state.shops.length; i++){
          const shopName = this.$store.state.shops[i].name;
          const shopArea = this.$store.state.shops[i].area;
          const shopGenre = this.$store.state.shops[i].genre;
          if(this.selectedArea == "All area" && this.selectedGenre == "All genre"){
            this.searchedByWord(this.$store.state.shops[i].name);
          }
          if(shopArea == this.selectedArea && this.selectedGenre == "All genre"){
            this.searchedByWord(this.$store.state.shops[i].name);
          }
          if(this.selectedArea == "All area" && shopGenre == this.selectedGenre){
            this.searchedByWord(this.$store.state.shops[i].name);
          }
          if(shopArea == this.selectedArea && shopGenre == this.selectedGenre){
            this.searchedByWord(this.$store.state.shops[i].name);
          }
        }
      },
  },
}

</script>

<style>

  .search-wrapper{
    width:90%;
    text-align:right;
    margin-bottom:40px;
  }
  .clear-btn{
    margin-right: 5px;
    color:royalblue;
    background-color: inherit;
    border-color: rgb(139, 164, 241);
    box-shadow: 1px 2px 2px rgba(0, 0, 0, 0.3);
  }
  .search-select, .search-input{
    height:40px;
    border:none;
    background-color:white;
    box-shadow: 0px 5px 3px rgba(0, 0, 0, 0.3);
  }
  .search-select{
    width:100px;
  }
  .search-input{
    width:300px;
  }
  .card-wrapper{
    display:flex;
    flex-wrap:wrap;
  }
  @media screen and (max-width: 768px) {
    .search-select, .search-input{
    height:30px;
    }
    .search-select{
      margin-bottom:7px;
    }
  .card-wrapper{
    justify-content: space-between;
  }
  }
</style>
