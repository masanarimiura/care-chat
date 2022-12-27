<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="register">
      <div class="register_box">
        <h3 class="register_box_ttl">ご登録が完了しました。</h3>
        <p class="register_box_content">チャットID:</p>
        <p class="register_box_content">◯◯◯◯</p>
        <p class="register_box_content">チャットパスワード:</p>
        <p class="register_box_content">◯◯◯◯</p>
        <p class="register_box_content">上記の内容を一緒にご利用されたい方への共有をお願いします。</p>
          <br />
          <p class="register_box_content"><NuxtLink to="/">こちらより患者チャットへのログインして下さい</NuxtLink></p>
          <br />
      </div>
    </div>
  </div>
</template>

<style>
.register{
  display: flex;
  justify-content: center;
}
.register_box{
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.register_box_ttl{
  font-size: 30px;
  padding-bottom: 50px;
}
.register_box_content{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
}
</style>