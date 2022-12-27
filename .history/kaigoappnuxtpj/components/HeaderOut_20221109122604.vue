<template>
  <div class="header-out">
    <div class="header-out_inner">
      <NuxtLink to="/" class="nuxt-link">
        <img src="../img/logo.png" class="header-out_img">
        <div class="header-out_ttl">
          <h2>Care</h2>
          <h2>Chat</h2>
        </div>
      </NuxtLink>
    </div>
  </div>
</template>

<style>
.header-out_inner {
  padding-top: 10px;
  padding-left: 10px;
}
.header-out_inner .nuxt-link {
  text-decoration: none;
  display: flex;
}
.header-out_img {
  display: block;
  width: auto;
  height: 60px;
}
.header-out_ttl {
  font-size: 30px;
  padding-top: 0px;
  padding-left: 5px;
  display: inline-block;
  color: rgb(42, 171, 191);
}
</style>