<template>
  <div>
    <HeaderIn v-on:openModal="showPatientInfo"></HeaderIn>
    <CommentShow></CommentShow>
    <CommentForm></CommentForm>
  </div>
</template>

<script>
export default {
  methods: {
    showPatientInfo(){
      
      this.$modal.show("modal-patient-info");
    },
  },
};
</script>
