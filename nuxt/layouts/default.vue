<template>
  <div>
    <div class="ttl-wrapper">
      <ModalGuest v-if="!$auth.loggedIn"/>
      <ModalAuth v-if="$auth.loggedIn"/>
      <h1>
        <NuxtLink to="/" class="ttl-name">Rese</NuxtLink>
      </h1>
    </div>
    <Nuxt/>
  </div>
</template>

<style>
  body{
    background-color:whitesmoke;
    width:90%;
    margin:0 auto;
  }
  .ttl-wrapper{
  display:flex;
  margin:40px 0;
  }
  .ttl-wrapper h1{
    color:#4169e1;
    font-weight:bold;
    margin:0 20px;
  }

  .ttl-name{
    color:#4169e1;
    text-decoration:none;
    font-size:40px;
    font-weight:bold;
    font-family: 'Spline Sans', sans-serif;
  }

</style>