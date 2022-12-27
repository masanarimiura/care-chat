<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="thanks">
      <div class="thanks_box">
        <h3 class="thanks_box_ttl">ご登録が完了しました。</h3>
        <p class="thanks_box_content">チャットID:</p>
        <p class="thanks_box_content_name">{{ this.$route.query.name }}</p>
        <p class="thanks_box_content">チャットパスワード:</p>
        <p class="thanks_box_content">{{ this.$route.query.password }}</p>
        <p class="thanks_box_content_name">上記の内容を一緒にご利用されたい方への共有をお願いします。</p>
          <br />
          <p class="thanks_box_content"><NuxtLink to="/">こちらより患者チャットへのログインして下さい</NuxtLink></p>
          <br />
      </div>
    </div>
  </div>
</template>

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
  color: #000;
}
.thanks_box_content_name{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
}
</style>