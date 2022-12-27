<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="my-page">
      <div class="my-page_box">
        <WorkerMyPage></WorkerMyPage>
        <ClientMyPage></WorkerMyPage>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  async created() {
    // firebaseのログインチェック
    this.$store.dispatch("onAuth");
  }
};
</script>

<style>
.my-page {
  display: flex;
  justify-content: center;
}
.my-page_box {
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 30px;
}
</style>