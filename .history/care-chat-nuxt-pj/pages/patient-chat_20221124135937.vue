<template>
  <div>
    <HeaderIn v-on:openModal="showPatientInfo"></HeaderIn>
    <CommentShow></CommentShow>
    <CommentForm></CommentForm>
    <PatientPasswordCheckModal></PatientPasswordCheckModa>
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
  beforeDestroy(){
    this.$store.commit("resetJoinPatientId");
  },
};
</script>
