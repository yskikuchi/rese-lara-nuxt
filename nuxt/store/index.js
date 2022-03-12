export const state = () => ({
  shops: [],
  myBookings:[],
})

export const getters = {
  getCurrentShop: state => (id) => {
    const currentShop = state.shops.find(e => e.id == id);
    return currentShop;
  },
  getAreaList: state => {
    const areaList = state.shops.map(e => e.area);
    const formatAreaList = new Set(areaList);
    return formatAreaList;
  },
  getGenreList: state => {
    const genreList = state.shops.map(e => e.genre);
    const formatGenreList = new Set(genreList);
    return formatGenreList;
  },
  getValidBookings: state => {
    const today = new Date();
    const time = new Date();
    const hours = time.getHours() - 1;
    const minutes = time.getMinutes();
    const formatMinutes = ('0' + minutes).slice(-2);
    const nowTime = hours + ":" + formatMinutes;
    const formatDate = today.toISOString().slice(0, 10);
    return state.myBookings.filter(e => {
      if ( (e.date == formatDate) && (e.time >= nowTime) ) {
        return true;
      } else if(e.date > formatDate){
        return true;
      }
    });
  },
  getPastBookings: state => {
    const today = new Date();
    const time = new Date();
    const hours = time.getHours() - 1;
    const minutes = time.getMinutes();
    const formatMinutes = ('0' + minutes).slice(-2);
    const nowTime = hours + ":" + formatMinutes;
    const formatDate = today.toISOString().slice(0, 10);
    return state.myBookings.filter(e => {
      if ( (e.date == formatDate) && (e.time < nowTime) ) {
        return true;
      } else if(e.date < formatDate){
        return true;
      }
    });
  }
}

export const mutations = {
  setShops(state, payload) {
    state.shops = payload;
  },
  setMyBookings(state, payload) {
    state.myBookings = payload;
  }
}

export const actions = {
  async getShops({ commit }) {
    const shops = await this.$axios.get("/shops");
    const shopList = shops.data.data;
    commit('setShops', shopList);
  },
  async getMyBookings({ commit }) {
    const resData = await this.$axios.get('/booking');
    const bookingList = resData.data.data;
    commit('setMyBookings', bookingList);
  }
}