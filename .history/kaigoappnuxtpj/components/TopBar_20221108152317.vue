<template>
  <div class="top-bar">
    <NuxtLink to="/" class="nuxt-link">
      <div class="top-bar_inner">
        <img src="../img/logo.png" class="top-bar_img">
        <div class="top-bar_ttl">
          <h2>Care</h2>
          <h2>Chat</h2>
        </div>
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
  padding-top: 10px;
  margin-right: 10px;
  display: inline-block;
  color: rgb(42, 171, 191);
}
</style>