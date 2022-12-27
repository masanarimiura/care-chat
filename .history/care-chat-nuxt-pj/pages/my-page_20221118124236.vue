<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="my-page">
      <div class="my-page_box">
        <div class="img-box">
          <img src="../img/worker.png" alt="worker" />
        </div>
        <div class="name-box">
          <p class="username">{{ this.$store.state.loginUserName }}</p>
        </div>
        <div class="email-box">
          <p class="email">{{ this.$store.state.loginUserName }}のメールアドレス取得して表示</p>
        </div>
        <div class="number-box">
          <p class="number">デフォルトは「未設定」ある時は表示する。</p>
        </div>

        <h3 class="my-page_box_ttl">ご登録が完了しました。</h3>
        <p class="my-page_box_content">チャットID:</p>
        <p class="my-page_box_content_name">{{ this.patientName }}</p>
        <p class="my-page_box_content">チャットパスワード:</p>
        <p class="my-page_box_content_name">{{ this.patientPassword }}</p>
        <p class="my-page_box_content">
          上記の内容を一緒にご利用されたい方への共有をお願いします。
        </p>
        <p class="my-page_box_btn" @click="join()">
          こちらより「{{ this.patientName }}」患者チャットへ参加して下さい
        </p>
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
      this.$router.replace("patient-chat");
    },
  },
  async created() {
    // firebaseのログインチェック
    this.$store.dispatch("onAuth");
    // patient_id からpatientの情報を検索
    this.patientId = this.$store.state.joinedPatientId;
    const patientId = {
      id: this.patientId,
    };
    const getPatientInfo = await this.$axios.get(
      "http://127.0.0.1:8000/api/v1/patient-show",
      { params: patientId }
    );
    this.patientName = getPatientInfo.data.data.name;
    this.patientPassword = getPatientInfo.data.data.password;
  },
};
</script>

<style>
.my-page {
  display: flex;
  justify-content: center;
}
.my-page_box {
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.my-page_box_ttl {
  font-size: 30px;
  padding-bottom: 50px;
}
.my-page_box_content {
  margin-top: 10px;
  line-height: 40px;
  font-size: 20px;
}
.my-page_box_content_name {
  line-height: 40px;
  font-size: 30px;
  color: rgb(167, 0, 0);
}
.my-page_box_btn {
  margin-top: 10px;
  line-height: 40px;
  font-size: 20px;
  color: rgb(0, 0, 238);
  text-decoration: underline;
  cursor: pointer;
}
.my-page_box_btn:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
</style>