<template>
  <div>
    <HeaderIn v-on:openModal="showPatientInfo"></HeaderIn>
    <CommentShow></CommentShow>
    <CommentForm></CommentForm>
    <PatientPasswordCheckModal></PatientPasswordCheckModal>
  </div>
</template>

<script>
export default {
  methods: {
    // 子のHeaderInから情報もらってモーダル開く
    showPatientInfo(){
      this.$modal.show("modal-patient-info");
    },
  },
  created(){
    console.log(this.$store.state.joinedPatientId)
    if(this.$store.state.joinedPatientId == null){
      alert('チャットIDが読み取れませんでした。再度チャットへの参加をお願いします。')
      this.$router.replace('/patient-index')
    }
  },
  beforeDestroy(){
    this.$store.commit("resetJoinPatientId");
  },
};
</script>
