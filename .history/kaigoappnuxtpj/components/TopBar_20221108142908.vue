<template>
  <div class="top-bar">
    <div class="top-bar_inner">
      <NuxtLink to="/">
        <img src="../img/logo.png" class="top-bar_img">
        <h2 class="top-bar_ttl">Care Chat</h2>
      </NuxtLink>
    </div>
  </div>
</template>

<style>
.top-bar_inner {
  padding: 30px;
  display: flex;
  justify-content: space-between;
}
.top-bar_img {
  width: 50px;
  height: auto;
}
.top-bar_ttl {
  height: auto;
}
</style>