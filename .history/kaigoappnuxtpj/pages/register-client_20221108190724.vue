<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="register__inner">
      <div class="register__box">
        <p>新規登録</p>
        <br />
        <validation-observer ref="obs" v-slot="ObserverProps">
          <validation-provider v-slot="{ errors }" rules="required|max:20">
            <input v-model="name" type="name" name="ユーザーネーム" required placeholder="ユーザーネーム" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" rules="required">
            <input v-model="relation_id" type="number" name="患者様との関係" required placeholder="患者様との関係" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" rules="required|email">
            <input v-model="email" type="email" name="メールアドレス" required placeholder="メールアドレス" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" rules="digits:8-12">
            <input v-model="number" type="number" name="電話番号" required placeholder="電話番号" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" vid="passwordConfirm" rules="required|min:6|alpha_dash">
            <input v-model="password" type="password" name="パスワード" required placeholder="パスワード" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <button @click="register()" class="register__btn"
            :disabled="ObserverProps.invalid || !ObserverProps.validated">新規登録</button>
        </validation-observer>
      </div>
    </div>
  </div>
</template>

<style>
.register__inner{
  display: flex;
  justify-content: center;
}
.register__box{
  width: 500px;
  background-color: #fff;
  border-radius: 10px;
  padding: 50px;
  text-align: center;
}
p{
  color: #000;
  font-weight: bold;
}
input{
  margin: 10px;
  width: 400px;
  height: 30px;
}
.register__btn{
  margin: 20px;
  width: 100px;
  border-radius: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: #5a419d;
  color: #fff;
  border: 3px outset #401092;
  cursor: pointer;
}
.error {
  color: red;
}
</style>