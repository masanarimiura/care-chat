<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="register-patient">
      <div class="register-patient_box">
        <h3 class="register-patient_box_ttl">患者チャット新規作成</h3>
        <p class="register-patient_box_content">※既に作成済みのチャットに参加を希望する場合は作成者と「チャットID」「パスワード」を共有し、<NuxtLink to="/patient">「チャットに参加」</NuxtLink>を利用して下さい。</p>
        <br />
        <validation-observer ref="obs" v-slot="ObserverProps">
          <validation-provider v-slot="{ errors }" rules="required|max:20">
            <p class="register-patient_box_input_ttl">チャットID</p>
            <p class="register-patient_box_input_content">※患者様のお名前などで自由に作成して下さい。</p>
            <p class="register-patient_box_input_content">※20字以内の入力をお願いします。</p>
            <input v-model="name" type="text" name="チャットID" required placeholder="チャットID" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <validation-provider v-slot="{ errors }" vid="passwordConfirm" rules="required|min:6|max:256|alpha_dash">
            <p class="register-patient_box_input_ttl">チャットパスワード</p>
            <p class="register-patient_box_input_content">※半角入力、アルファベット、数字を6文字以上で作成して下さい。</p>
            <input v-model="password" type="password" name="チャットパスワード" required placeholder="チャットパスワード" />
            <div class="error">{{ errors[0] }}</div>
          </validation-provider>
          <br />
          <button @click="register()" class="register-patient_btn"
            :disabled="ObserverProps.invalid || !ObserverProps.validated">新規登録</button>
        </validation-observer>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      password: "",
      newPatientId: "",
    };
  },
  methods: {
    async register() {
      const newPatientNamePass = {
        name: this.name,
        password: this.password,
      };
      await this.$axios.post("http://127.0.0.1:8000/api/v1/patient", newPatientNamePass);
      const GetNewPatientId = await this.$axios.post("http://127.0.0.1:8000/api/v1/patient-search", newPatientNamePass);
      this.newPatientId = GetNewPatientId.data.data.id;
      console.log(this.newPatientId)
      console.log(GetNewPatientId)
      console.log(this.$store.state.loginUserId)

      // this.$router.push({ path: 'thanks-register-patient' , query :{ name: this.name, password: this.password }});
    },
  },
  created() {
    this.$store.dispatch('onAuth')
  }
}
</script>

<style>
.register-patient{
  display: flex;
  justify-content: center;
}
.register-patient_box{
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.register-patient_box_ttl{
  font-size: 30px;
}
.register-patient_box_content{
  margin-top: 10px;
  font-size: 12px;
}
.register-patient_box_input_ttl{
  font-size: 20px;
  font-weight: bold;
}
.register-patient_box_input_content{
  
  font-size: 12px;
}
.register-patient_box input{
  margin: 0 10px 10px 10px;
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.register-patient_btn{
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