<template>
  <div>
    <HeaderIn v-on:openModalPatientInfo="showPatientInfo()"></HeaderIn>
    <div class="my-page">
      <div class="my-page_box">
        <ClientMyPage></ClientMyPage>
        <WorkerMyPage></WorkerMyPage>
        <PatientPasswordCheck></PatientPasswordCheck>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
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
  padding: 30px;
}
</style>