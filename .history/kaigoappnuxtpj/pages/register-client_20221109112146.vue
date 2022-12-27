<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="register-client">
      <div class="register-client_box">
        <h3 class="register-client_box_ttl">クライアント新規登録</h3>
        <p class="register-client_box_content">※患者様ご本人・ご家族様等のみこちらより作成をお願いします。</p>
        <p class="register-client_box_content">※医療福祉従事者の方は<NuxtLink to="/register-worker">ケアワーカー新規登録</NuxtLink>ページへ移動して下さい。</p>
        
        <br />
        <validation-observer ref="obs" v-slot="ObserverProps">
          <validation-provider v-slot="{ errors }" rules="required|max:20">
            <p class="register-client_box_input_ttl">メールアドレス</p>
            <input v-model="name" type="name" name="ユーザーネーム" required placeholder="ユーザーネーム" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" rules="required|email">
            <input v-model="email" type="email" name="メールアドレス" required placeholder="メールアドレス" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" rules="min:8|max:12">
            <input v-model="number" type="tel" name="電話番号" required placeholder="電話番号" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" vid="passwordConfirm" rules="required|min:6|max:256|alpha_dash">
            <input v-model="password" type="password" name="パスワード" required placeholder="パスワード" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <button @click="register()" class="register-client_btn"
            :disabled="ObserverProps.invalid || !ObserverProps.validated">新規登録</button>
        </validation-observer>
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