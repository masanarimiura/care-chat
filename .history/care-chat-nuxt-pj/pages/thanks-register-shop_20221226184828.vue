<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="thanks">
      <div class="thanks_box">
        <h3 class="thanks_box_ttl">事業所情報の登録が完了しました。</h3>
        <p class="thanks_box_content">
          <NuxtLink to="/my-page">マイページにて</NuxtLink>
          ご確認ををお願いします
        </p>
      </div>
    </div>
  </div>
</template>

<style>
.thanks {
  display: flex;
  justify-content: center;
}
.thanks_box {
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.thanks_box_ttl {
  font-size: 30px;
  padding-bottom: 50px;
}
.thanks_box_content {
  margin-top: 10px;
  line-height: 40px;
  font-size: 20px;
}
@media screen and (max-width: 768px) {
  .thanks_box {
    width: 80%;
    height: auto;
    text-align: center;
    border: 2px solid rgb(42, 171, 191);
    background-color: rgb(211, 252, 237);
    border-radius: 10px;
    padding: 50px;
  }
  .thanks_box_ttl {
    font-size: 30px;
    padding-bottom: 50px;
  }
  .thanks_box_content {
    margin-top: 10px;
    line-height: 40px;
    font-size: 20px;
  }
}
</style>