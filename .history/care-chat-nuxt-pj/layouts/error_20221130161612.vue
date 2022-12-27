<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="thanks">
      <div class="thanks_box">
        <h3 class="thanks_box_ttl">エラーが発生しました。</h3>
        <div class="error_content"></div>
        <p>{{ error.statusCode }}</p>
        <p>{{ error.message }}</p>
        <p>{{ error.path }}</p>
        <p class="thanks_box_content"></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
props: ["error"],
};
</script>

<style>
.thanks{
  display: flex;
  justify-content: center;
}
.thanks_box{
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.thanks_box_ttl{
  font-size: 30px;
  padding-bottom: 50px;
}
.thanks_box_content{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
}
</style>