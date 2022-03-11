<template>
  <section class="review-content" :review = "review">
    <p class="review-content_header">
      名前：{{review.user.name}}
      評価：{{review.star}}点/5点中
    </p>
    <p>{{review.comment}}</p>
  </section>
</template>

<script>
export default {
  props:{
    review:{
      type:Object
    },
  }
}
</script>

<style>
.review-content{
  padding:10px;
}
.review-content_header{
  margin-bottom:10px;
}

</style>