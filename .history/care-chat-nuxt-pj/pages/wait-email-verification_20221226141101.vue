<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="thanks">
      <div class="thanks_box">
        <h3 class="thanks_box_ttl">確認用メールを送信しました</h3>
        <p class="thanks_box_content">ご自身のメールをご確認頂き、URLをクリックして下さい。</p>
      </div>
    </div>
  </div>
</template>

<style>
.thanks{
  display: flex;
  justify-content: center;
}
.thanks_box{
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.thanks_box_ttl{
  font-size: 30px;
  padding-bottom: 50px;
}
.thanks_box_content{
  margin-top: 10px;
  line-height:40px;
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