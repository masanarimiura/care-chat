<template>
  <div class="comment-form-outer">
    <div class="comment-form">
      <validation-observer ref="obs" v-slot="ObserverProps">
        <validation-provider v-slot="{ errors }" rules="required|max:1000">
          <textarea
            v-model="commentContent"
            type="text"
            name="コメント"
            required
            placeholder="コメントはこちらから記入して下さい。"
            rows="10"
          ></textarea>
          <div class="error">{{ errors[0] }}</div>
        </validation-provider>
        <button
          @click="sendComment()"
          class="comment-form_btn"
          :disabled="ObserverProps.invalid || !ObserverProps.validated"
        >
          コメントを送信
        </button>
      </validation-observer>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      commentContent: "",
    };
  },
    methods: {
    // patient_idに対する新規の comment を作成する
    async sendComment() {
      //  ログインアカウントがclientかworkerかを判断し保存内容を変える。
      if (this.$store.state.clientOrWorker == "client") {
        const newComment = {
          content: this.commentContent,
          patient_id: this.$store.state.joinedPatientId,
          client_id: this.$store.state.loginUserId,
        };
        await this.$axios.post(
          "http://127.0.0.1:8000/api/v1/comment",
          newComment
        );
      } else if (this.$store.state.clientOrWorker == "worker") {
        const newComment = {
          content: this.commentContent,
          patient_id: this.$store.state.joinedPatientId,
          worker_id: this.$store.state.loginUserId,
        };
        await this.$axios.post(
          "http://127.0.0.1:8000/api/v1/comment",
          newComment
        );
      }
      location.reload();
    },
  },
  async created() {
    // firebaseのログインチェック
    await this.$store.dispatch("onAuth");
  },
};
</script>

<style>
.comment-form-outer {
  height: 120px;
}
.comment-form {
  position: fixed;
  bottom: 0;
  z-index: 1;
  width: 100%;
  box-shadow: 0 0 1px 0 #999;
  background-color: #ffffbe;
  text-align: center;
}
.comment-form textarea {
  margin-top: 10px;
  width: 90%;
  max-width: 1024px;
  height: 80px;
  font-size: 18px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.comment-form_btn {
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
.comment-form_btn {
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);

}
</style>