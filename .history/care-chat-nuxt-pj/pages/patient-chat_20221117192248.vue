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
</style>