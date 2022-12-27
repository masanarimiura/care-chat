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
        )
        .catch((error) => { 
          const Errors = error.response.data.errors
          for (let key in Errors) {
            alert('エラーコード:'+error.response.data.status+' / エラー項目「'+ key + '」\nエラー内容:' + Errors[key]);
          }
          location.reload();
        });
      } else if (this.$store.state.clientOrWorker == "worker") {
        const newComment = {
          content: this.commentContent,
          patient_id: this.$store.state.joinedPatientId,
          worker_id: this.$store.state.loginUserId,
        };
        await this.$axios.post(
          "http://127.0.0.1:8000/api/v1/comment",
          newComment
        )
        .catch((error) => { 
          const Errors = error.response.data.errors
          for (let key in Errors) {
            alert('エラーコード:'+error.response.data.status+' / エラー項目「'+ key + '」\nエラー内容:' + Errors[key]);
          }
          location.reload();
        });
      } else {
        alert('登録情報にエラーがある可能性があります。内容をご確認頂き、再度ログインをお試し下さい。')
        this.$store.commit('logout')
        this.$router.replace('/')
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
.comment-form_btn:disabled {
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  background: rgb(171, 212, 218);
  cursor: not-allowed;
}
@media screen and (max-width: 768px) {
  .thanks_box {
    width: 80vw;
    padding: 20px;
  }
  .thanks_box_ttl {
    font-size: 20px;
    padding-bottom: 20px;
  }
  .thanks_box_content {
    line-height: 20px;
    font-size: 16px;
  }
}
</style>