<template>
  <div class="header-out_outer">
    <div class="header-out">
      <div class="header-out_logo">
        <NuxtLink to="/" class="nuxt-link">
          <img src="../img/logo.jpg" class="header-out_img" />
          <div class="header-out_ttl">
            <h2>Care</h2>
            <h2>Chat</h2>
          </div>
        </NuxtLink>
      </div>
    </div>
  </div>
</template>

<style>
.header-out_outer {
  height: 100px;
}
.header-out {
  position: fixed;
  top: 0;
  z-index: 5;
  width: 100%;
  display: flex;
  justify-content: space-between;
  box-shadow: 0 0 5px 0 #999;
  background-color: #ffffbe;
}
.header-out_logo {
  padding-top: 1px;
  padding-left: 10px;
}
.header-out_logo .nuxt-link {
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
@media screen and (max-width: 768px) {
  .login-register_ttl {
    width: 100%;
  }
  .login-register_ttl h2 {
    font-size: 20px;
  }
  .login-register_ttl p {
    margin-top: 5px;
    padding-left: 10px;
    text-align: left;
    font-size: 12px;
  }
}
</style>