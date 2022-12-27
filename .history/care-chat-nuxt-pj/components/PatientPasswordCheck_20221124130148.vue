<template>
  <div>
    <modal name="modal-patient-info" height="auto">
      <div class="modal-header">
        <h2>チャットID、パスワードの確認</h2>
      </div>
      <div class="modal-body">
        <div class="thanks">
          <div class="thanks_box">
            <h3 class="thanks_box_ttl">チャット管理は下記をご確認下さい。</h3>
            <p class="thanks_box_content">チャットID:</p>
            <p class="thanks_box_content_name">{{ this.patientName }}</p>
            <p class="thanks_box_content">チャットパスワード:</p>
            <p class="thanks_box_content_name">{{ this.patientPassword }}</p>
            <p class="thanks_box_content">上記の内容を一緒にご利用されたい方への共有をお願いします。</p>
            <p class="thanks_box_btn" @click="backChat()">チャットID:「{{ this.patientName }}」へ戻る</p>
          </div>
        </div>
        <p v-on:click="hidePatientInfo()" class="hide-btn">編集を中止する</p>
      </div>
    </modal>
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
    backChat() {
      this.$router.replace('patient-chat');
    },
    // patient_id からpatientの情報を検索
    async getPatientInfo(){
      this.patientId = this.$store.state.joinedPatientId;
      const getPatientInfo = await this.$axios.get("http://127.0.0.1:8000/api/v1/patient/" + this.patientId );
      this.patientName = getPatientInfo.data.data.name;
      this.patientPassword = getPatientInfo.data.data.password;
    },
    showPatientInfo() {
      this.$modal.show("modal-patient-info");
    },
    hidePatientInfo() {
      this.$modal.hide("modal-patient-info");
    },
  },
  async created() {
    // patient_id からpatientの情報を検索
    this.getPatientInfo();
  },
  beforeDestroy(){
    this.$store.commit("resetJoinPatientId");
  },
};
</script>

<style>
.modal-header,
.modal-body {
  padding: 5px 25px;
}
.modal-header {
  border-bottom: 1px solid #ddd;
  font-size: 20px;
}
.modal-body .hide-btn {
  list-style: none;
  font-size: 14px;
  cursor: pointer;
  text-decoration: underline;
}
.modal-body .hide-btn:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
.modal-body .update-name {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-name input {
  height: 30px;
  margin: 30px;
  font-size: 26px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-name_btn {
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}




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
  line-height: 50px;
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