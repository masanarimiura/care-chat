<template>
  <div>
    <div class="login-register_ttl">
      <p>チャットID:</p>
      <h2>{{ this.patient_name }}</h2>
    </div>
    <div class="Chat-area">
      <div class="v-for_box"  v-for="comment in comments" :key="comment.id">
        <div class="client-balloon"  v-if="comment.client_id == !null">
          <div class="client-balloon_img-box">
            <img src="../img/client.png" alt="client" />
            <p class="client_name">{{ comment.client.name }}</p>
          </div>
          <div class="client-balloon_comment-box">
            <div class="fukidasi">
              <p>{{ comment.content }}</p>
              <p class="datetime">作成日:{{ comment.created_at }}</p>
              <p class="datetime">更新日{{ comment.updated_at }}</p>
            </div>
          </div>
        </div>
        <div class="onebox"  v-if="comment.worker_id == !null">
          <div class="imgArea">
            <img src="../img/worker.png" alt="worker" />
            <p class="worker_name">{{ comment.worker.name }}</p>
          </div>
          <div class="client-balloon_comment-box">
            <div class="fukidasi">
              <p>{{ comment.content }}</p>
              <p class="datetime">作成日:{{ comment.created_at }}</p>
              <p class="datetime">更新日{{ comment.updated_at }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="comment-form">
      <validation-observer ref="obs" v-slot="ObserverProps">
        <validation-provider v-slot="{ errors }" rules="required|max:1000">
          <p class="comment-form_textarea_ttl">コメントを書く</p>
          <textarea v-model="comment" type="text" name="コメント" required placeholder="コメントの内容" cols="30" rows="10"></textarea>
          <div class="error">{{ errors[0] }}</div>
        </validation-provider>
        <button @click="sendComment()" class="comment-form_btn"
          :disabled="ObserverProps.invalid || !ObserverProps.validated">新規登録</button>
      </validation-observer>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      patient_name: "",
      patient_id: "",
      comment: "",
      comments: {},
    };
  },
  methods: {
    async getComment() {
      // Vuexのログインid変更の検知から患者チャットの履歴 client-patients or worker-patientsテーブル を引き出す。
      const patientId = {
        patient_id: this.$store.state.joinedPatientId,
      };
      const getCommentForPatient = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/comment-search",
        { params: patientId }
      );
      this.comments = getCommentForPatient.data.data;
    },
    // patient_idに対する comment を作成する
    async sendComment() {
      //  ログインアカウントがclientかworkerかを判断し保存内容を変える。
      if (this.$store.state.clientOrWorker == 'client') {
        const newComment = {
          content:this.comment,
          patient_id:this.$store.state.joinedPatientId,
          client_id:this.$store.state.loginUserId,
        };
        await this.$axios.post("http://127.0.0.1:8000/api/v1/comment", newComment);
      } else if (this.$store.state.clientOrWorker == 'worker') {
        const newComment = {
          content:this.comment,
          patient_id:this.$store.state.joinedPatientId,
          worker_id:this.$store.state.loginUserId,
        };
        await this.$axios.post("http://127.0.0.1:8000/api/v1/comment", newComment);
      }
      location.reload();
    },
  },
  async created() {
    this.patient_id = this.$store.state.joinedPatientId;
    const patientId = {
      id : this.patient_id
    }
    const getPatientInfo = await this.$axios.get("http://127.0.0.1:8000/api/v1/patient-show",{ params: patientId });
    this.patient_name = getPatientInfo.data.data.name;
  },
  mounted() {
      this.getComment();
  },
};
</script>

<style>
.login-register_ttl {
  margin: auto;
  width: 500px;
  height: auto;
  text-align: center;
}
.login-register_ttl h2 {
  display: inline-block;
  font-size: 40px;
}
.login-register_ttl p {
  display: inline-block;
  margin-top: 10px;
  text-align: left;
  font-size: 20px;
}


.Chat-area {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  max-width: 1024px;
  margin: 50px auto;
  padding: 0 10px;
}
.client-balloon {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
}
.client-balloon_img-box {
  width: 16%;
  position: relative;
}
.client-balloon_img-box img {
  width: 100%;
  max-width: 130px;
  position: absolute;
  top: 30px;
}
.client-balloon_img-box .client_name {
  position: absolute;
  top: 0px;
  color: rgb(80, 36, 0);
}
.client-balloon_comment-box {
  width: 63%;
}
.Chat-area .client-balloon .fukidasi {
  width: 100%;
  position: relative;
  padding: 25px;
  background-color: rgb(233, 245, 255);
  font-size: 18px;
  color: rgb(80, 36, 0);
  border-radius: 12px;
  box-sizing: border-box;
}
.Chat-area .client-balloon .fukidasi .datetime {
  text-align: right;
  font-size: 16px;
  padding-top: 10px;
}
.Chat-area .client-balloon .fukidasi::before {
  content: "";
  position: absolute;
  display: block;
  top: 22px;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 15px 30px 15px 0;
  border-color: transparent rgb(233, 245, 255) transparent transparent;
}
.Chat-area .client-balloon:nth-child(odd) .fukidasi::before {
  left: -20px;
}
.Chat-area .client-balloon:nth-child(even) .fukidasi {
  background-color: rgb(211, 252, 237);
}
.Chat-area .client-balloon:nth-child(even) .fukidasi::before {
  right: -20px;
  border-color: transparent rgb(211, 252, 237) transparent transparent;
  transform: rotate(180deg);
}
.comment-form{
  width: auto;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 10px;
}
.comment-form_textarea_ttl{
  font-size: 30px;
  font-weight: bold;
}
.comment-form textarea{
  margin: 0 10px 10px 10px;
  width: 90%;
  height: auto;
  font-size: 18px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.comment-form_btn{
  width: 100px;
  border-radius: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
@media screen and (max-width: 1024px) {
  .Chat-area .client-balloon .imgArea img {
    max-width: 70%;
  }
  .Chat-area .client-balloon .imgArea .worker_name,
  .client_name {
    font-size: 14px;
  }
  .Chat-area .client-balloon .fukidasi {
    padding: 15px;
    font-size: 14px;
  }
  .Chat-area .client-balloon .fukidasi::before {
    top: 8px;
  }
}
</style>