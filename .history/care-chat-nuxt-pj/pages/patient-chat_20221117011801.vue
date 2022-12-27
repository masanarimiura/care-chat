<template>
  <div>
    <HeaderIn></HeaderIn>
    <CommentSho></Comment>
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