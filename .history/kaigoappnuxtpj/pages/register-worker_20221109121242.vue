<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="register-worker">
      <div class="register-worker_box">
        <h3 class="register-worker_box_ttl">ケアワーカー新規登録</h3>
        <p class="register-worker_box_content">※患者様ご本人・ご家族様等のみこちらより作成をお願いします。</p>
        <p class="register-worker_box_content">※は<NuxtLink to="/register-client">ケアワーカー新規登録</NuxtLink>ページへ移動して下さい。</p>
        
        <br />
        <validation-observer ref="obs" v-slot="ObserverProps">
          <validation-provider v-slot="{ errors }" rules="required|max:20">
            <p class="register-worker_box_input_ttl">お名前</p>
            <p class="register-worker_box_input_content">※患者様名ではなくご登録者様ご本人様のお名前を入力して下さい。</p>
            <p class="register-worker_box_input_content">※患者様ご本人様が登録する場合は患者様のお名前を下さい。</p>
            <input v-model="name" type="name" name="お名前" required placeholder="お名前" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" rules="required|email">
            <p class="register-worker_box_input_ttl">メールアドレス</p>
            <input v-model="email" type="email" name="メールアドレス" required placeholder="メールアドレス" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" rules="min:8|max:12">
            <p class="register-worker_box_input_ttl">電話番号</p>
            <input v-model="number" type="tel" name="電話番号" required placeholder="電話番号" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" vid="passwordConfirm" rules="required|min:6|max:256|alpha_dash">
            <p class="register-worker_box_input_ttl">パスワード</p>
            <p class="register-worker_box_input_content">※半角入力、アルファベット、数字を6文字以上で作成して下さい。</p>
            <input v-model="password" type="password" name="パスワード" required placeholder="パスワード" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <button @click="register()" class="register-worker_btn"
            :disabled="ObserverProps.invalid || !ObserverProps.validated">新規登録</button>
        </validation-observer>
      </div>
    </div>
  </div>
</template>

<style>
.register-worker{
  display: flex;
  justify-content: center;
}
.register-worker_box{
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.register-worker_box_ttl{
  font-size: 30px;
}
.register-worker_box_content{
  margin-top: 10px;
  font-size: 12px;
}
.register-worker_box_input_ttl{
  font-size: 20px;
  font-weight: bold;
}
.register-worker_box_input_content{
  
  font-size: 12px;
}
.register-worker_box input{
  margin: 0 10px 10px 10px;
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.register-worker_btn{
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
</style>