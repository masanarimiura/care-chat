<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="thanks">
      <div class="thanks_box">
        <h3 class="thanks_box_ttl">アカウント内容の登録が完了しました。</h3>
        <p class="thanks_box_content">
          続けて、
          <NuxtLink to="/patient-index"
            >患者チャットへの参加もしくは新規作成</NuxtLink
          >
          へお進み下さい。
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
    width: px;
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