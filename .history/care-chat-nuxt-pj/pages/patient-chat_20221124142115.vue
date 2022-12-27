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
    if(this.$store.state.joinedPatientId == null){
      alert('チャットIDが読み取れませんでした。再度')
    }
  },
  beforeDestroy(){
    this.$store.commit("resetJoinPatientId");
  },
};
</script>
