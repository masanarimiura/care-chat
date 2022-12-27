<template>
  <div>
    <HeaderIn></HeaderIn>
    <CommentShow></CommentShow>
    <CommentForm></CommentForm>
  </div>
</template>

<script>
export default {
  async created() {
    // firebaseのログインチェック
    await this.$store.dispatch("onAuth");
  },
};
</script>

<style>
.comment-form {
  position: fixed;
  bottom: 0;
  z-index: 1;
  width: 100%;
  box-shadow: 0 0 1px 0 #999;
  background-color: #ffffbe;
  text-align: center;
}
</style>