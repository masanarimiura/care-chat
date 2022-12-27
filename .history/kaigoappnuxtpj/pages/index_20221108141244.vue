<template>
  <div class="register">
    <TopBar></TopBar>
    <div class="login__inner">
      <div class="login__box">
        <p>ログイン</p>
        <br />
        <input v-model="email" type="email" required placeholder="メールアドレス" />
        <br />
        <input v-model="password" type="password" required placeholder="パスワード" />
        <br />
        <button @click="login()" class="login__btn">ログイン</button>
      </div>
    </div>
    <div class="register__inner">
      <div class="register__box">
        <p>新規登録</p>
        <br />
        <NuxtLink to="/">クライアントとして新規登録</NuxtLink>
        <NuxtLink to="/">クライアントとして新規登録</NuxtLink>
      </div>
    </div>
  </div>
</template>

<script>
</script>

<style>
.register__inner{
  display: flex;
  justify-content: center;
}
.register__box{
  width: 500px;
  background-color: #fff;
  border-radius: 10px;
  padding: 50px;
  text-align: center;
}
p{
  color: #000;
  font-weight: bold;
}
.login__inner{
  display: flex;
  justify-content: center;
}
.login__box{
  width: 500px;
  background-color: #fff;
  border-radius: 10px;
  padding: 50px;
  text-align: center;
}
p{
  color: #000;
  font-weight: bold;
}
input{
  margin: 10px;
  width: 400px;
  height: 30px;
}
.login__btn {
  margin: 20px;
  width: 100px;
  border-radius: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: #5a419d;
  color: #fff;
  border: 3px outset #401092;
  cursor: pointer;
}
</style>