<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="register">
      <div class="register_box">
        <h3 class="register_box_ttl">アカウントの登録が完了しました。</h3>
        <p class="register_box_content">続けて、
          <br />
          <NuxtLink to="/patient-index">患者チャットへの参加もしくは新規作成</NuxtLink>
          <br />
          をお願いします</p>
      </div>
    </div>
  </div>
</template>

<style>
.register{
  display: flex;
  justify-content: center;
}
.register_box{
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.register_box_ttl{
  font-size: 30px;
  padding-bottom: 50px;
}
.register_box_content{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
}
</style>