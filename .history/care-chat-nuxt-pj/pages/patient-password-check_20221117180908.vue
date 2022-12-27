<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="thanks">
      <div class="thanks_box">
        <h3 class="thanks_box_ttl">下記より、
          <h3 class="thanks_box_ttl">「チャットID」「パスワード」
          <h3 class="thanks_box_ttl">をご確認下さい。
        
        <p class="thanks_box_content">チャットID:</p>
        <p class="thanks_box_content_name">{{ this.patientName }}</p>
        <p class="thanks_box_content">チャットパスワード:</p>
        <p class="thanks_box_content_name">{{ this.patientPassword }}</p>
        <p class="thanks_box_content">上記の内容を一緒にご利用されたい方への共有をお願いします。</p>
        <br />
        <p class="thanks_box_btn" @click="join()">こちらより「{{ this.patientName }}」患者チャットへ参加して下さい</p>
        <br />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      patientId: "",
      patientName: "",
      patientPassword: "",
    };
  },
  methods: {
    async join() {
      this.$router.replace('patient-chat');
    },
  },
  async created() {
    // firebaseのログインチェック
    this.$store.dispatch('onAuth')
    this.patientId = this.$store.state.joinedPatientId;
    const patientId = {
      id : this.patientId
    }
    const getPatientInfo = await this.$axios.get("http://127.0.0.1:8000/api/v1/patient-show",{ params: patientId });
    this.patientName = getPatientInfo.data.data.name;
    this.patientPassword = getPatientInfo.data.data.password;
  }
}
</script>

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
.thanks_box_content_name{
  line-height:40px;
  font-size: 30px;
  color: rgb(167, 0, 0);
}
.thanks_box_btn{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
  color: rgb(0, 0, 238);
  text-decoration:underline;
  cursor: pointer;
}
.thanks_box_btn:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
</style>