<template>
  <div class="top__bar">
    <div class="top__bar__inner">
      <NuxtLink to="/" class="top__bar__link">
        <img src="../img/logo.png" class="top__bar__img"></img>
      </NuxtLink>
      <div class="link__box">
        <NuxtLink to="/" class="top__bar__link">新規作成</NuxtLink>
        <NuxtLink to="/login" class="top__bar__link">ログイン</NuxtLink>
      </div>
    </div>
  </div>
</template>

<style>
.top__bar__inner {
  padding: 30px;
  display: flex;
  justify-content: space-between;

}
.top__bar__img {
  width: 150px;
  height: auto;
  }
.top__bar__link {
  margin: 10px;
  color: #fff;
  text-decoration: none;
}
</style>