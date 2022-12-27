<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="register-client">
      <div class="register-client_box">
        <h3 class="register-client_box_ttl">ご登録が完了しました。</h3>
        <p class="register-client_box_content">チャットID:</p>
        <p class="register-client_box_content">◯◯◯◯</p>
        <p class="register-client_box_content">チャットパスワード:</p>
        <p class="register-client_box_content">◯◯◯◯</p>
        <p class="register-client_box_content">上記の内容を一緒にご利用されたい方への共有をお願いします。</p>
          <br />
          <p class="register-client_box_content"><NuxtLink to="/patient">患者チャットへのログインもしくは新規登録</NuxtLink></p>
          <br />
      </div>
    </div>
  </div>
</template>

<style>
.register-client{
  display: flex;
  justify-content: center;
}
.register-client_box{
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.register-client_box_ttl{
  font-size: 30px;
  padding-bottom: 50px;
}
.register-client_box_content{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
}
</style>