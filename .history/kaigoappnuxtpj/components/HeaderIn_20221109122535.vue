<template>
  <div class="header-in">
    <div class="header-in_inner">
      <NuxtLink to="/" class="nuxt-link">
        <img src="../img/logo.png" class="header-in_img">
        <div class="header-in_ttl">
          <h2>Care</h2>
          <h2>Chat</h2>
        </div>
      </NuxtLink>
    </div>
  </div>
</template>

<style>
.header-in_inner {
  padding-top: 10px;
  padding-left: 10px;
}
.header-in_inner .nuxt-link {
  text-decoration: none;
  display: flex;
}
.header-in_img {
  display: block;
  width: auto;
  height: 60px;
}
.header-in_ttl {
  font-size: 30px;
  padding-top: 0px;
  padding-left: 5px;
  display: inline-block;
  color: rgb(42, 171, 191);
}
</style>