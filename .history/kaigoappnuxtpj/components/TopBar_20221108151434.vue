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
  width: 80px;
  height: auto;
}
.top-bar_ttl {
  padding-top: 20px;
  display: inline-block;
  text-decoration: none;
  color: rgb(13, 120, 104);
}
</style>