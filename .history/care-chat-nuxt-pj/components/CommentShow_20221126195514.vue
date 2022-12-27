<template>
  <div>
    <div class="login-register_ttl">
      <p>チャットID:</p>
      <h2>{{ this.patientName }}</h2>
    </div>
    <div class="chat-area">
      <div class="comment-null" v-if="comments.length == 0">
        <p>
          現在、チャットID:「{{
            this.patientName
          }}」に対するコメントはありません。
        </p>
      </div>
      <div class="v-for_box" v-for="comment in comments" :key="comment.id">
        <div class="client-balloon" v-if="comment.client_id == !null && comment.worker_id == null">
          <div @click="otherClientMyPage(comment.client_id)" class="client-balloon_img-box">
            <img src="../img/client.jpg" alt="client" />
            <p class="client_name">
              <span v-for="relation in comment.client.relations" :key="relation.id">
                <span v-if="relation.patient_id == comment.patient_id">{{ relation.relation_type.name }}:</span>
              </span>
                <span v-if="comment.client.relations.find((v) => v.patient_id === comment.patient_id) == null">クライアント:</span>
              <br />{{ comment.client.name }}
            </p>
          </div>
          <div class="client-balloon_comment">
            <div class="client-balloon_comment-box">
              <div
                class="update-delete"
                v-if="
                  $store.state.clientOrWorker == 'client' &&
                  comment.client_id == $store.state.loginUserId
                "
              >
                <img
                  @click="showUpdate(comment.id, comment.content)"
                  src="../img/update.jpg"
                  alt="update"
                  class="update_btn"
                />
                <img
                  @click="showDelete(comment.id, comment.content)"
                  src="../img/delete.jpg"
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
        <div class="worker-balloon" v-if="comment.worker_id == !null && comment.client_id == null">
          <div class="worker-balloon_img-box">
            <img src="../img/worker.jpg" alt="worker" />
            <p class="worker_name">
              <span v-if="comment.worker.role_id">{{ comment.worker.role.name }}:</span>
              <span v-if="comment.worker.role_id == null">ケアワーカー:</span>
              <br />{{ comment.worker.name }}
            </p>
          </div>
          <div class="worker-balloon_comment">
            <div class="worker-balloon_comment-box">
              <div
                class="update-delete"
                v-if="
                  $store.state.clientOrWorker == 'worker' &&
                  comment.worker_id == $store.state.loginUserId
                "
              >
                <img
                  @click="showUpdate(comment.id, comment.content)"
                  src="../img/update.jpg"
                  alt="update"
                  class="update_btn"
                />
                <img
                  @click="showDelete(comment.id, comment.content)"
                  src="../img/delete.jpg"
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
      <CommentShowModal :propsModal="{commentId,commentContent}"></CommentShowModal>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      patientName: "",
      patientId: "",
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
      this.patientId = this.$store.state.joinedPatientId;
      const getPatientInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/patient/" + this.patientId
      );
      this.patientName = getPatientInfo.data.data.name;
    },
    // patient_id からコメントと付随した情報を引き出す。
    async getComment() {
      const patientId = {
        patient_id: this.$store.state.joinedPatientId,
      };
      const getCommentForPatient = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/comment-search",
        { params: patientId }
      );
      // コメントの並び順を新しい順に並べて保管
      this.comments = getCommentForPatient.data.data.slice().reverse();
    },
    showUpdate(ReceiveCommentId, ReceiveCommentContent) {
      this.commentId = ReceiveCommentId;
      this.commentContent = ReceiveCommentContent;
      this.$modal.show("modal-update");
    },
    showDelete(ReceiveCommentId, ReceiveCommentContent) {
      this.commentId = ReceiveCommentId;
      this.commentContent = ReceiveCommentContent;
      this.$modal.show("modal-delete");
    },
    otherClientMyPage(commentClientId){
      if(this.$store.state.clientOrWorker == 'client' && commentClientId == this.$store.state.loginUserId){
        this.$router.replace('my-page')
      } else {
        this.$router.push({ path: 'other-my-page' , query :{ client_id: commentClientId}});
      }
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
.chat-area {
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
  cursor: pointer;
}
.client-balloon_img-box:hover {
  color: ;
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
.update-delete {
  position: absolute;
  top: 4px;
  right: 10px;
}
.update-delete img {
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
</style>