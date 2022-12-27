<template>
  <div class="top-bar">
    <NuxtLink to="/" class="nuxt-link">
      <div class="top-bar_inner">
        <img src="../img/logo.png" class="top-bar_img">
        div
        <h2 class="top-bar_ttl">Care Chat</h2>
        <h2 class="top-bar_ttl">Care Chat</h2>
      </div>
    </NuxtLink>
  </div>
</template>

<style>
.nuxt-link {
  text-decoration: none;
}
.top-bar_inner {
  width: 300px;
  display: flex; 
}
.top-bar_img {
  width: 80px;
  height: auto;
}
.top-bar_ttl {
  padding-top: 20px;
  display: inline-block;
  color: rgb(42, 171, 191);
}
</style>