<template>
  <div class="header">
    <div class="header_inner">
      <NuxtLink to="/" class="header_link">
      </NuxtLink>
      <div class="link_box">
        <NuxtLink to="/" class="header_link">新規作成</NuxtLink>
        <NuxtLink to="/login" class="header_link">ログイン</NuxtLink>
      </div>
    </div>
  </div>
</template>

<style>
.header_inner {
  padding: 30px;
  display: flex;
  justify-content: space-between;
}
.header_img {
  width: 150px;
  height: auto;
  }
.header_link {
  margin: 10px;
  color: #fff;
  text-decoration: none;
}
</style>