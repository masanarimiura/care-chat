<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="error">
      <div class="error_box">
        <h3 class="error_box_ttl">エラーが発生しました。</h3>
        <div class="error_box_content">
          <p>{{ error.statusCode }}</p>
          <p>{{ error.message }}</p>
          <p>{{ error.path }}</p>
          <NuxtLink />
        </div>
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
.error{
  display: flex;
  justify-content: center;
}
.error_box{
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.error_box_ttl{
  font-size: 30px;
  padding-bottom: 50px;
}
.error_box_content{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
}
</style>