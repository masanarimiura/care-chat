<template>
  <div>
    <modal name="modal-patient-info" height="auto">
      <div class="modal-header">
        <h2>チャットID、パスワードの確認</h2>
        <p class="patient-info_content">
          下記の内容を一緒にご利用されたい方への共有をお願いします。
        </p>
      </div>
      <div class="modal-body">
        <p class="patient-info_content">チャットID:</p>
        <p class="patient-info_content_name">{{ this.patientName }}</p>
        <p class="patient-info_content">チャットパスワード:</p>
        <p class="patient-info_content_name">{{ this.patientPassword }}</p>
        <p v-on:click="hidePatientInfo()" class="hide-link">チャットに戻る</p>
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
      this.$router.replace("patient-chat");
    },
    // patient_id からpatientの情報を検索
    async getPatientInfo() {
      this.patientId = this.$store.state.joinedPatientId;
      const getPatientInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/patient/" + this.patientId
      )
      .catch(() => {
        location.reload();
        alert("エラーが起きました。しばらくしてから再度お試しください。");
      })
      ;
      this.patientName = getPatientInfo.data.data.name;
      this.patientPassword = getPatientInfo.data.data.password;
    },
    hidePatientInfo() {
      this.$modal.hide("modal-patient-info");
    },
  },
  async created() {
    // patient_id からpatientの情報を検索
    this.getPatientInfo();
  },
  beforeDestroy() {
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
.modal-header .patient-info_content {
  font-size: 18px;
}
.modal-body .patient-info_content {
  font-size: 18px;
}
.modal-body .patient-info_content_name {
  line-height: 40px;
  font-size: 30px;
  color: rgb(167, 0, 0);
}
.modal-body .hide-link {
  margin-top: 20px;
  display: inline-block;
  list-style: none;
  font-size: 20px;
  cursor: pointer;
  text-decoration: underline;
}
.modal-body .hide-link:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
</style>