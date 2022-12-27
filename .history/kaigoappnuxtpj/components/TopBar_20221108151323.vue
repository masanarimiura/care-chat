<template>
  <div class="top-bar">
    <NuxtLink to="/">
      <div class="top-bar_inner">
        <img src="../img/logo.png" class="top-bar_img">
        <h2 class="top-bar_ttl">Care Chat</h2>
      </div>
    </NuxtLink>
  </div>
</template>

<style>
.top-bar_inner {
  width: 300px;
  display: flex; 
}
.top-bar_img {
  width: 100px;
  height: auto;
}
.top-bar_ttl {
  pt20
  display: inline-block;
  text-decoration: none;
}
</style>