<template>
  <div class="header">
    <div class="header_inner">
      <NuxtLink to="/" class="header_link">
        <img src="../img/logo.png" class="header_img"></img>
      </NuxtLink>
      <div class="link_box">
        <NuxtLink to="/" class="header_link">新規作成</NuxtLink>
        <NuxtLink to="/login" class="header__link">ログイン</NuxtLink>
      </div>
    </div>
  </div>
</template>

<style>
.header__inner {
  padding: 30px;
  display: flex;
  justify-content: space-between;
}
.header__img {
  width: 150px;
  height: auto;
  }
.header__link {
  margin: 10px;
  color: #fff;
  text-decoration: none;
}
</style>