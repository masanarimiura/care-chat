<template>
  <div>
    <HeaderIn v-on:openModal="showPatientInfo"></HeaderIn>
    <CommentShow></CommentShow>
    <CommentForm></CommentForm>
    <PatientPasswordCheck></PatientPasswordCheck>
  </div>
</template>

<script>
export default {
  methods: {
    // 子のHeaderInから情報もらって
    showPatientInfo(){
      console.log('showPatientInfo拾った')
      this.$modal.show("modal-patient-info");
    },
  },
};
</script>
