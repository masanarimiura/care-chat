<template>
  <div>
    <modal name="modal-update" height="auto">
      <div class="modal-header">
        <h2>コメントの編集</h2>
      </div>
      <div class="modal-body">
        <div class="comment-form">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:1000">
              <textarea
                v-model="propsModal.commentContent"
                type="text"
                name="コメントの修正内容"
                required
                placeholder="コメントはこちらから記入して下さい。"
                rows="10"
              ></textarea>
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateComment()"
              class="comment-form_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              編集したコメントを送信
            </button>
          </validation-observer>
          <p v-on:click="hideUpdate()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-delete" height="auto">
      <div class="modal-header">
        <h2>コメントの削除</h2>
        <p>以下のコメントを本当に削除してよろしいでしょうか？</p>
      </div>
      <div class="modal-body">
        <div class="delete-content_box">
          <p>{{ this.propsModal.commentContent }}</p>
        </div>
        <button @click="deleteComment()" class="comment-delete_btn">
          上記のコメントを削除する
        </button>
        <p v-on:click="hideDelete()" class="hide-btn">
          コメントの削除を中止する
        </p>
      </div>
    </modal>
  </div>
</template>

<script>
export default {
  // CommentShow.vueからデータの引き継ぎ
  props: ["propsModal"],
  // コメントの編集を保存
  methods: {
    hideUpdate() {
      this.$modal.hide("modal-update");
    },
    hideDelete() {
      this.$modal.hide("modal-delete");
    },
    async updateComment() {
      const updateCommentContent = {
        content: this.propsModal.commentContent,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/comment/" + this.propsModal.commentId,
          updateCommentContent
        )
        .then(() => {
          this.hideUpdate();
        })
        .catch((error) => {
          const Errors = error.response.data.errors;
          for (let key in Errors) {
            alert(
              "エラーコード:" +
                error.response.data.status +
                " / エラー項目「" +
                key +
                "」\nエラー内容:" +
                Errors[key]
            );
          }
          location.reload();
        });
      location.reload();
    },
    // コメントの削除
    async deleteComment() {
      await this.$axios
        .delete(
          "http://127.0.0.1:8000/api/v1/comment/" + this.propsModal.commentId
        )
        .then(() => {
          this.hideUpdate();
        })
        .catch(() => {
          location.reload();
          alert("エラーが起きました。しばらくしてから再度お試しください。");
        });
      location.reload();
    },
  },
};
</script>

<style>
.modal-header,
.modal-body {
  padding: 5px 25px;
}
.modal-header {
  border-bottom: 1px solid #ddd;
  font-size: 20px;
}
.modal-body .comment-form {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .comment-form textarea {
  width: 100%;
  margin-top: 10px;
  height: 300px;
  font-size: 18px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .comment-form_btn {
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
.modal-body .comment-form_btn:disabled {
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
.modal-body .comment-delete_btn {
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: #a80000;
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
.modal-body .delete-content_box {
  min-height: 100px;
}
.modal-body .delete-content_box p {
  color: rgb(80, 36, 0);
}
.modal-body .hide-btn {
  display: inline-block;
  list-style: none;
  font-size: 14px;
  cursor: pointer;
  text-decoration: underline;
}
.modal-body .hide-btn:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
@media screen and (max-width: 768px) {
  .modal-body .comment-form textarea {
    font-size: 16px;
  }
  .modal-body .comment-delete_btn {
    margin-bottom: 10px;
    width: auto;
    border-radius: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    background: #a80000;
    color: #fff;
    border: 1px solid rgb(28, 117, 131);
    cursor: pointer;
  }
  .modal-body .delete-content_box {
    min-height: 100px;
    m
  }
  .modal-body .delete-content_box p {
    color: rgb(80, 36, 0);
    font-size: 14px;
  }
  .modal-body .hide-btn {
    display: inline-block;
    list-style: none;
    font-size: 14px;
    cursor: pointer;
    text-decoration: underline;
  }
  .modal-body .hide-btn:hover {
    background-color: transparent;
    color: #a80000;
    cursor: pointer;
  }
}
</style>