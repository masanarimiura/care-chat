<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="login-register">
      <div class="login">
        <div class="login_box">
          <h3 class="login_box_ttl">ログイン</h3>
          <p class="login_box_content">※既にアカウントが登録済みの方はこちらからログインして下さい。</p>
          <p class="login_box_content">※患者様アカウントのみではログインできません。ご自身のアカウントを新規作成してからログインして下さい。</p>
          <br />
          <input v-model="email" type="email" required placeholder="メールアドレス" />
          <br />
          <input v-model="password" type="password" required placeholder="パスワード" />
          <br />
          <button @click="login()" class="login__btn">ログイン</button>
        </div>
      </div>
      <div class="register">
        <div class="register_box">
          <h3 class="register_box_ttl">新規登録</h3>
          <p class="register_box_content">※ご自身のアカウントの登録がお済み出ない方はこちらからご登録をお願いします。</p>
          <p class="register_box_content">※患者様アカウントのみではログインできません。ご自身のアカウントを新規作成してからログインして下さい。</p>
          <br />
          <NuxtLink to="/" class="nuxt-link">クライアントとして新規登録</NuxtLink>
          <br />
          <NuxtLink to="/" class="nuxt-link">ケアワーカーとして新規登録</NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
</script>

<style>
.login-register{
  margin: 100px 50px 0 50px;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}
.login,.register{
  margin: 20px;
  display: flex;
  justify-content: center;
}
.login_box,.register_box{
  width: 400px;
  height: 300px;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 234, 252);
  border-radius: 10px;
  padding: 50px;
}
.login_box_ttl,.register_box_ttl{
  font-size: 20px;
}
.register.login_box_content{
  margin-top: 10px;
  font-size: 12px;
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
  text-decoration: none;
  font-size: 20px;
  margin-top: 60px;
  display: inline-block;
  color: rgb(42, 171, 191);
  border-radius: 10px;
  padding: 20px 20px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
</style>