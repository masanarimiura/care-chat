<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="patient-login-register_ttl">
      <h2>患者様チャット</h2>
      <p>※チャットIDの分かる方は「チャットに参加」へ。初めてご利用される場合は「チャット作成」をお願いします。</p>
    </div>
    <div class="patient-login-register">
      <div class="patient-login">
        <div class="patient-login_box">
          <h3 class="patient-login_box_ttl">チャットに参加</h3>
          <p class="patient-login_box_content">※チャットIDが分かる方はこちらからログインして下さい。</p>
          <br />
          <p class="patient-login_box_input_ttl">チャットID</p>
          <input v-model="id" type="email" required placeholder="チャットID" />
          <br />
          <p class="patient-login_box_input_ttl">パスワード</p>
          <input v-model="password" type="password" required placeholder="パスワード" />
          <br />
          <button @click="login()" class="patient-login__btn">ログイン</button>
        </div>
      </div>
      <div class="register">
        <div class="register_box">
          <h3 class="register_box_ttl">チャットの新規作成</h3>
          <br />
          <NuxtLink to="/register-client" class="nuxt-link">患者様チャット新規作成ページへ</NuxtLink>
          <p class="register_box_content">※既にチャットIDを作成済みの方は作成者と「チャットID」「パスワード」を共有し、「チャットに参加」を利用して下さい。</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
</script>

<style>
.patient-login-register_ttl {
  margin: auto;
  width: 500px;
  height: auto;
  text-align: center;
}
.patient-login-register_ttl h2 {
  font-size: 50px;
}
.patient-login-register_ttl p {
  text-align: left;
  font-size: 14px;
}
.patient-login-register{
  margin: 10px 50px 0 50px;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}
.patient-login,.register{
  margin: 20px;
  display: flex;
  justify-content: center;
}
.patient-login_box,.register_box{
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(233, 245, 255);
  border-radius: 10px;
  padding: 50px;
}
.patient-login_box_ttl,.register_box_ttl{
  font-size: 30px;
}
.register_box_content,.login_box_content{
  margin-top: 10px;
  font-size: 12px;
}
.login_box_input_ttl{
  font-size: 20px;
}
.login_box input{
  margin: 10px;
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.login__btn {
  margin: 20px;
  width: 100px;
  border-radius: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
.register_box{
  background-color: rgb(211, 252, 237);
}
.register_box .nuxt-link {
  margin-top: 20px;
  display: inline-block;
  text-decoration: none;
  font-size: 20px;
  color: rgb(42, 171, 191);
  border-radius: 10px;
  padding: 20px 20px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
</style>