<template>
  <div class="default">
    <Nuxt />
  </div>
</template>

<style>
.default {
  font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN",
    "Hiragino Sans", Meiryo, sans-serif;
  width: 100%;
  min-height: 100vh;
  background-color: #ffffbe;
  color: rgb(42, 171, 191);
}
.error {
  color: red;
}
@media screen and (max-width: 768px) {
  .error {
    font-size: 14px;
  }
    .vm--modal {
    width: 80% !important;
    left: 10% !important;
  }
}
</style>
