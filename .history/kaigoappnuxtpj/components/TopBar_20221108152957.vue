<template>
  <div class="top-bar">
    <div class="top-bar_inner">
      <NuxtLink to="/" class="nuxt-link">
        <img src="../img/logo.png" class="top-bar_img">
        <div class="top-bar_ttl">
          <h2>Care</h2>
          <h2>Chat</h2>
        </div>
      </NuxtLink>
    </div>
  </div>
</template>

<style>
.top-bar_inner {
  pa
  width: 100px;
}
.nuxt-link {
  text-decoration: none;
  display: flex;
}
.top-bar_img {
  display: block;
  width: 50px;
  height: auto;
}
.top-bar_ttl {
  padding-top: 10px;
  padding-left: 5px;
  display: inline-block;
  color: rgb(42, 171, 191);
}
</style>