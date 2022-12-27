<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="register-client">
      <div class="register-client_box">
        <h3 class="register-client_box_ttl">ご登録が完了しました。</h3>
        <p class="register-client_box_content">続けて、<NuxtLink to="/register-worker">患者様チャットへのログインもしくは新規登録</NuxtLink>をお願いします</p>
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
}
.register-client_box_content{
  margin-top: 10px;
  font-size: 16px;
}
.error {
  color: red;
}
</style>