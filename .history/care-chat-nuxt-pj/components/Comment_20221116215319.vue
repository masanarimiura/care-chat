<template>
  <div>
    <div class="login-register_ttl">
      <p>チャットID:</p>
      <h2>{{ this.patient_name }}</h2>
    </div>
    <div class="Chat-area">
      <div class="comment-null" v-if="comments.length == 0">
        <p>
          現在、チャットID:「{{
            this.patient_name
          }}」に対するコメントはありません。
        </p>
      </div>
      <div class="v-for_box" v-for="comment in comments" :key="comment.id">
        <div class="client-balloon" v-if="comment.client_id == !null">
          <div class="client-balloon_img-box">
            <img src="../img/client.png" alt="client" />
            <p class="client_name">義理の娘:<br />{{ comment.client.name }}</p>
          </div>
          <div class="client-balloon_comment">
            <div class="client-balloon_comment-box">
              <div
                class="put-delete"
                v-if="
                  $store.state.clientOrWorker == 'client' &&
                  comment.client_id == $store.state.loginUserId
                "
              >
                <img
                  @click="showPut(comment.id, comment.content)"
                  src="../img/put.png"
                  alt="put"
                  class="put_btn"
                />
                <img
                  @click="showDelete(comment.id, comment.content)"
                  src="../img/delete.png"
                  alt="delete_btn"
                  class="delete_btn"
                />
              </div>
              <p>{{ comment.content }}</p>
              <p class="datetime">投稿:{{ comment.created_at | moment }}</p>
              <p class="datetime">更新:{{ comment.updated_at | moment }}</p>
            </div>
          </div>
        </div>
        <div class="worker-balloon" v-if="comment.worker_id == !null">
          <div class="worker-balloon_img-box">
            <img src="../img/worker.png" alt="worker" />
            <p class="worker_name">
              作業療法士:<br />{{ comment.worker.name }}
            </p>
          </div>
          <div class="worker-balloon_comment">
            <div class="worker-balloon_comment-box">
              <div
                class="put-delete"
                v-if="
                  $store.state.clientOrWorker == 'worker' &&
                  comment.worker_id == $store.state.loginUserId
                "
              >
                <img
                  @click="showPut(comment.id, comment.content)"
                  src="../img/put.png"
                  alt="put"
                  class="put_btn"
                />
                <img
                  @click="showDelete(comment.id, comment.content)"
                  src="../img/delete.png"
                  alt="delete_btn"
                  class="delete_btn"
                />
              </div>
              <p>{{ comment.content }}</p>
              <p class="datetime">投稿:{{ comment.created_at | moment }}</p>
              <p class="datetime">更新:{{ comment.updated_at | moment }}</p>
            </div>
          </div>
        </div>
      </div>





      <modal
        name="modal-put"
        height="auto"
      >
        <div class="modal-header">
          <h2>コメントの編集</h2>
        </div>
        <div class="modal-body">
          <div class="comment-form">
            <validation-observer ref="obs" v-slot="ObserverProps">
              <validation-provider
                v-slot="{ errors }"
                rules="required|max:1000"
              >
                <textarea
                  v-model="commentContent"
                  type="text"
                  name="コメントの修正内容"
                  required
                  placeholder="コメントはこちらから記入して下さい。"
                  rows="10"
                ></textarea>
                <div class="error">{{ errors[0] }}</div>
              </validation-provider>
              <button
                @click="sendUpdateComment()"
                class="comment-form_btn"
                :disabled="ObserverProps.invalid || !ObserverProps.validated"
              >
                編集したコメントを送信
              </button>
            </validation-observer>
            <p v-on:click="hidePut()">編集を中止する</p>
          </div>
        </div>
      </modal>





      <modal name="modal-delete">
        <p>
          {{ commentId
          }}{{ commentContent }}削除でモーダルウィンドウで表示されるコンテンツ
        </p>
      </modal>
    </div>
    <div class="comment-form">
      <validation-observer ref="obs" v-slot="ObserverProps">
        <validation-provider v-slot="{ errors }" rules="required|max:1000">
          <textarea
            v-model="comment"
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
          編集したコメントを送信
        </button>
      </validation-observer>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      patient_name: "",
      patient_id: "",
      comment: "",
      comments: {},
      commentId: "",
      commentContent: "",
    };
  },
  filters: {
    // created_at と updated_atの表示形式指定
    moment: function (date) {
      return moment(date).format("YYYY年/MM月/DD日  HH:mm dddd");
    },
  },
  methods: {
    async getPatientName() {
      // チャットIDからpatientsのnameを検索して表示
      this.patient_id = this.$store.state.joinedPatientId;
      const patientId = {
        id: this.patient_id,
      };
      const getPatientInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/patient-show",
        { params: patientId }
      );
      this.patient_name = getPatientInfo.data.data.name;
    },
    // Vuexのログインid変更の検知から患者チャットの履歴 client-patients or worker-patientsテーブル を引き出す。
    async getComment() {
      const patientId = {
        patient_id: this.$store.state.joinedPatientId,
      };
      const getCommentForPatient = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/comment-search",
        { params: patientId }
      );
      this.comments = getCommentForPatient.data.data;
    },

    // コメント編集時、削除時のモーダル画面の出し入れ。commentsのidとcontentの受け渡し。
    showPut(ReceiveCommentId, ReceiveCommentContent) {
      this.commentId = ReceiveCommentId;
      this.commentContent = ReceiveCommentContent;
      this.$modal.show("modal-put");
    },
    hidePut() {
      this.$modal.hide("modal-put");
    },
    showDelete(ReceiveCommentId, ReceiveCommentContent) {
      this.commentId = ReceiveCommentId;
      this.commentContent = ReceiveCommentContent;
      this.$modal.show("modal-delete");
    },
    hideDelete() {
      this.$modal.hide("modal-delete");
    },





    // コメントの修正
    async sendUpdateComment() {
      //  ログインアカウントがclientかworkerかを判断し保存内容を変える。
      const updateCommentContent = {
        content: this.commentContent,
      };
      await this.$axios.post(
        "http://127.0.0.1:8000/api/v1/" + this.commentId,
        updateCommentContent,
        {headers :{
          'X-HTTP-Method-Override': 'PUT'
        }}
      );
    },






    // patient_idに対する comment を作成する
    async sendComment() {
      //  ログインアカウントがclientかworkerかを判断し保存内容を変える。
      if (this.$store.state.clientOrWorker == "client") {
        const newComment = {
          content: this.comment,
          patient_id: this.$store.state.joinedPatientId,
          client_id: this.$store.state.loginUserId,
        };
        await this.$axios.post(
          "http://127.0.0.1:8000/api/v1/comment",
          newComment
        );
      } else if (this.$store.state.clientOrWorker == "worker") {
        const newComment = {
          content: this.comment,
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
  created() {
    this.getPatientName();
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
.comment-null {
  margin: 0 auto;
  color: red;
}
.v-for_box {
  width: 100%;
}
.client-balloon {
  width: 100%;
  margin-top: 10px;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
}
.client-balloon_img-box {
  width: 16%;
  position: relative;
}
.client-balloon_img-box img {
  width: 60%;
  max-width: 130px;
  position: absolute;
  top: 35px;
}
.client-balloon_img-box .client_name {
  position: absolute;
  top: 0px;
  left: 0;
  color: rgb(80, 36, 0);
}
.client-balloon_comment {
  width: 63%;
}
.client-balloon_comment-box {
  width: 100%;
  position: relative;
  padding: 25px;
  background-color: rgb(211, 252, 237);
  font-size: 18px;
  color: rgb(80, 36, 0);
  border-radius: 12px;
  box-sizing: border-box;
}
.put-delete {
  position: absolute;
  top: 10px;
  right: 10px;
}
.put-delete img {
  width: 20px;
  cursor: pointer;
}
.client-balloon_comment-box .datetime {
  text-align: right;
  font-size: 14px;
  padding-top: 10px;
}
.client-balloon_comment-box::before {
  content: "";
  position: absolute;
  display: block;
  top: 30px;
  left: -30px;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 15px 30px 15px 0;
  border-color: transparent rgb(211, 252, 237) transparent transparent;
}
.worker-balloon {
  width: 100%;
  margin-top: 10px;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  flex-direction: row-reverse;
}
.worker-balloon_img-box {
  width: 16%;
  position: relative;
}
.worker-balloon_img-box img {
  width: 60%;
  max-width: 130px;
  position: absolute;
  top: 35px;
  right: 0px;
}
.worker-balloon_img-box .worker_name {
  position: absolute;
  top: 0px;
  right: 0px;
  color: rgb(80, 36, 0);
}
.worker-balloon_comment {
  width: 63%;
}
.worker-balloon_comment-box {
  width: 100%;
  position: relative;
  padding: 25px;
  background-color: rgb(233, 245, 255);
  font-size: 18px;
  color: rgb(80, 36, 0);
  border-radius: 12px;
  box-sizing: border-box;
}
.worker-balloon_comment-box .datetime {
  text-align: right;
  font-size: 14px;
  padding-top: 10px;
}
.worker-balloon_comment-box::before {
  content: "";
  position: absolute;
  display: block;
  top: 30px;
  right: -30px;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 15px 30px 15px 0;
  border-color: transparent rgb(233, 245, 255) transparent transparent;
  transform: rotate(180deg);
}

.modal-header,
.modal-body {
  padding: 5px 25px;
}
.modal-header {
  border-bottom: 1px solid #ddd;
  font-size: 30px;
}
.modal-body .comment-form p {
  list-style: none;
  font-size: 14px;
  cursor: pointer;
  text-decoration: underline;
}
.modal-body .comment-form p:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}

.comment-form {
  width: auto;
  height: auto;
  text-align: center;
}
.comment-form textarea {
  width: 90%;
  max-width: 1024px;
  height: auto;
  font-size: 18px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.comment-form_btn {
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
</style>