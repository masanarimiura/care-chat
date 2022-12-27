<template>
  <div>
    <modal name="modal-update-icon" height="auto">
      <div class="modal-header">
        <h2>アイコンの変更</h2>
      </div>
      <div class="modal-body">
        <div class="update-icon">
          <input
            type="file"
            name="アイコン"
            required
            accept="image/jpg,image/jpeg,image/png,image/gif,image/tif,image/tiff,image/psd,image/svg"
            @change="checkIcon"
          />
          <p v-if="overSizeIcon()" class="error">画像が10MBを超えています。10MB以下のみ使用可能です</p>
          <p v-if="exceptionIcon()" class="error">ファイル形式が読み取れません。jpg,jpeg,png,gif,tif,tiff,psd,svg など他の形式をお試し下さい。</p>
          <button
            @click="updateIcon"
            class="update-name_btn"
          >
            アイコンを登録する
          </button>
          <p v-on:click="hideIcon()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-update-name" height="auto">
      <div class="modal-header">
        <h2>お名前の変更</h2>
      </div>
      <div class="modal-body">
        <div class="update-name">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:100">
              <input
                v-model="propsModal.clientName"
                type="text"
                name="お名前"
                required
                placeholder="お名前"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateName()"
              class="update-name_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              お名前を登録する
            </button>
          </validation-observer>
          <p v-on:click="hideName()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-update-email" height="auto">
      <div class="modal-header">
        <h2>メールアドレスの変更</h2>
      </div>
      <div class="modal-body">
        <div class="update-email">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|email|max:256|">
              <p>変更前のメールアドレス</p>
              <p class="email">{{propsModal.clientEmail}}</p>
              <p>変更後のメールアドレス</p>
              <input
                v-model="newEmail"
                type="email"
                name="変更後のメールアドレス"
                required
                placeholder="メールアドレス"
              />
              <p>パスワード</p>
              <input
                v-model="password"
                type="password"
                name="パスワード"
                required
                placeholder="パスワード"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateEmail()"
              class="update-email_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              メールアドレスを変更する
            </button>
          </validation-observer>
          <p v-on:click="hideEmail()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-update-number" height="auto">
      <div class="modal-header">
        <h2>電話番号の登録</h2>
      </div>
      <div class="modal-body">
        <div class="update-number">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|phone">
              <input
                v-model="propsModal.clientPhoneNumber"
                type="tel"
                name="電話番号"
                required
                placeholder="090-XXXX-XXXX"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateNumber()"
              class="update-number_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              電話番号を登録する
            </button>
          </validation-observer>
          <button
            v-if="propsModal.clientPhoneNumber"
            @click="deleteNumber()"
            class="delete-number_btn"
          >
            電話番号を削除する
          </button>
          <p v-on:click="hideNumber()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-update-relation" height="auto">
      <div class="modal-header">
        <h2>チャットID対象者との関係性の登録</h2>
      </div>
      <div class="modal-body">
        <div class="update-relation">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider
              rules="oneOf:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18"
              v-slot="{ errors }"
              name="関係性"
            >
              <select v-model="value" name="関係性">
                <option value="" selected hidden>-選択して下さい-</option>
                <option value="1">本人</option>
                <option value="2">夫</option>
                <option value="3">妻</option>
                <option value="4">息子</option>
                <option value="5">義理の息子</option>
                <option value="6">娘</option>
                <option value="7">義理の娘</option>
                <option value="8">父親</option>
                <option value="9">義父</option>
                <option value="10">母親</option>
                <option value="11">義母</option>
                <option value="12">孫息子</option>
                <option value="13">孫娘</option>
                <option value="14">祖父</option>
                <option value="15">祖母</option>
                <option value="16">親戚</option>
                <option value="17">知人</option>
                <option value="18">その他</option>
              </select>
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateRelation()"
              class="update-relation_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              上記の関係性で登録する
            </button>
          </validation-observer>
          <p v-on:click="hideRelation()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import firebase from '~/plugins/firebase'
export default {
  data() {
    return {
      iconFile:"",
      errIconFile:false,
      value: "",
      newEmail:"",
      password:"",
    };
  },
  // ClientMyPage.vueからデータの引き継ぎ
  props: ["propsModal"],
  methods: {
    // モーダルを閉じる
    hideIcon() {
      this.$modal.hide("modal-update-icon");
    },
    hideName() {
      this.$modal.hide("modal-update-name");
    },
    hideEmail() {
      this.$modal.hide("modal-update-email");
    },
    hideNumber() {
      this.$modal.hide("modal-update-number");
    },
    hideRelation() {
      this.$modal.hide("modal-update-relation");
    },
    // アイコンの投稿のファイル選択時のバリデーション
    overSizeIcon() {
      true
    },
    exceptionIcon() {
    },
    checkIcon(p) {
      this.iconFile = p.target.files[0]
      const size = this.iconFile.size;
      const type = this.iconFile.type;
      // 10MBまででファイル形式は3種類のみ、違えばエラーをupdateIconに渡す
      if (size > 10000000) {
      this.errIconFile = true;
      this.overSizeIcon()
      }
      if (type != 'image/jpg' && type != 'image/jpeg' && type != 'image/png' && type != 'image/gif' && type != 'image/tif' && type != 'image/tiff' && type != 'image/psd' && type != 'image/svg') {
      this.errIconFile = true;
      this.exceptionIcon()
      }
    },
    async updateIcon(){
      // checkIconでエラーがない時のみ処理を行う
      if(this.errIconFile == false){
        // ヘッダーでフォームデータを定義
        const config = {
            headers: { 'content-type': 'multipart/form-data',}
        };
        // Formデータ作成
        const formData = new FormData();
        formData.append("file",this.iconFile);
        formData.append("client_id",JSON.stringify(this.$store.state.loginUserId));
        await this.$axios
        .post(
          "http://127.0.0.1:8000/api/v1/client-icon_update", 
          formData , config
        )
        location.reload();
      } else if (this.errIconFile == true) {
        
      }
    },
    // clientの name number email の更新
    async updateName() {
      const UpdateName = {
        name: this.propsModal.clientName,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/client/" +
            this.$store.state.loginUserId,
          UpdateName
        )
        .then(() => {
          this.hideName();
        });
      location.reload();
    },
    async updateEmail() {
      // 再度ログインしてパスワードもチェック
      await this.login();
      // firebaseでメールアドレスの変更
      const user = firebase.auth().currentUser;
      user.updateEmail(this.newEmail)
      .then(() => {
        // firebaseのメールがupdateできたらデータベースも処理
        this.updateEmailDb()
      })
      .catch((error) => {
        switch (error.code) {
        case 'auth/invalid-email':
        alert('メールアドレスの形式が違います。')
        break
        case 'auth/user-disabled':
        alert('ユーザーが無効になっています。')
        break
        case 'auth/user-not-found':
        alert('ユーザーが存在しません。')
        break
        default:
        alert('エラーが起きました。しばらくしてから再度お試しください。')
        break
        }
      });
    },
    // firebase のメール変更のために再ログイン
    async login() {
      await firebase.auth()
      .signInWithEmailAndPassword(this.propsModal.clientEmail, this.password)
      .catch((error) => {
        const errorCode = error.code
        alert('error : ' + errorCode + 'メールアドレスの変更に失敗しました。メールアドレスとパスワードをご確認の上、再度お試し下さい。')
      });
    },
    // firebaseのメールがupdateできたら下の処理する
    async updateEmailDb() {
      const UpdateEmail = {
        email: this.newEmail,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/client/" +
            this.$store.state.loginUserId,
          UpdateEmail
        )
        .then(() => {
          this.hideName();
        });
      location.reload();
    },
    // clientの電話番号更新、削除
    async updateNumber() {
      const UpdateNumber = {
        number: this.propsModal.clientPhoneNumber,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/client/" +
            this.$store.state.loginUserId,
          UpdateNumber
        )
        .then(() => {
          this.hideNumber();
        });
      location.reload();
    },
    async deleteNumber() {
      const DeleteNumber = {
        number: null,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/client/" +
            this.$store.state.loginUserId,
          DeleteNumber
        )
        .then(() => {
          this.hideNumber();
        });
      location.reload();
    },
    // clientのrelation_typeの更新
    async updateRelation() {
      const checkRelation = {
        client_id: this.$store.state.loginUserId,
        patient_id: this.propsModal.clientRelationPatientId,
      };
      // 既存の relation_type_idを持っているか確認し、post と put に処理を分ける。
      const resultCheckRelation = await this.$axios.get("http://127.0.0.1:8000/api/v1/relation-check", { params: checkRelation });
      const updateRelationInfo = {
        relation_type_id: this.value,
        client_id: this.$store.state.loginUserId,
        patient_id: this.propsModal.clientRelationPatientId,
      };
        if (resultCheckRelation.data.data){
          await this.$axios.put("http://127.0.0.1:8000/api/v1/relation/" + resultCheckRelation.data.data.id, updateRelationInfo);
        } else if (resultCheckRelation.data.data == null) {
          await this.$axios.post("http://127.0.0.1:8000/api/v1/relation", updateRelationInfo)
        }
      this.hideRelation();
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
.modal-body .hide-btn {
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
.modal-body .update-icon .error {
  font-size: 16px;
}
.modal-body .update-icon input {
  height: 38px;
  margin: 30px;
  font-size: 20px;
}
.modal-body .update-name {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-name input {
  height: 30px;
  margin: 30px;
  font-size: 26px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-name_btn {
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
.modal-body .update-email {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-email p {
  margin-top: 30px;
}
.modal-body .update-email .email {
  display: inline-block;
  margin-top: 0;
  padding-top: 4px;
  width: 350px;
  height: 26px;
  color: #a80000;
  text-align: left;
  font-size: 20px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-email input {
  width: 350px;
  height: 30px;
  font-size: 20px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-email_btn {
  margin-top: 30px;
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
.modal-body .update-number {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-number input {
  height: 30px;
  margin: 30px;
  font-size: 26px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-number_btn {
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
.modal-body .delete-number_btn {
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
.modal-body .update-relation {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-relation select {
  height: 30px;
  margin: 30px;
  font-size: 14px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-relation_btn {
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
</style>