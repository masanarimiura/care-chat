<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="register-client">
      <div class="register-client_box">
        <h3 class="register-client_box_ttl">ご登録が完了しました。</h3>
        <p class="register-client_box_content">※患者様ご本人・ご家族様等のみこちらより作成をお願いします。</p>
        
      </div>
    </div>
  </div>
</template>

<style>
.register-client{
  display: flex;
  justify-content: center;
}
.register-client_box{
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.register-client_box_ttl{
  font-size: 30px;
}
.register-client_box_content{
  margin-top: 10px;
  font-size: 12px;
}
.register-client_box input{
  margin: 10px;
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.register-client_btn{
  margin: 20px;
  width: 100px;
  border-radius: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
.error {
  color: red;
}
</style>