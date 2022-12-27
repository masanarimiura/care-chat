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
          <p v-if="this.overSizeIcon == true" class="error">
            画像が10MBを超えています。10MB以下のみ使用可能です
          </p>
          <p v-if="this.exceptionIcon == true" class="error">
            ファイル形式が読み取れません。jpg,jpeg,png,gif,tif,tiff,psd,svg
            など他の形式をお試し下さい。
          </p>
          <button
            v-if="this.errIconFile == false"
            @click="updateIcon"
            class="update-icon_btn"
          >
            アイコンを登録する
          </button>
          <button
            v-if="this.errIconFile == true"
            class="update-icon_btn-disable"
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
                v-model="propsModal.workerName"
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
            <validation-provider
              v-slot="{ errors }"
              rules="required|email|max:256|"
            >
              <p>変更前のメールアドレス</p>
              <p class="email">{{ propsModal.workerEmail }}</p>
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
    <modal name="modal-update-number" height="auto" class="modal-box">
      <div class="modal-header">
        <h2>電話番号の登録</h2>
      </div>
      <div class="modal-body">
        <div class="update-number">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|phone">
              <input
                v-model="propsModal.workerPhoneNumber"
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
            v-if="propsModal.workerPhoneNumber"
            @click="deleteNumber()"
            class="delete-number_btn"
          >
            電話番号を削除する
          </button>
          <p v-on:click="hideNumber()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-update-role_id" height="auto">
      <div class="modal-header">
        <h2>職種の登録</h2>
      </div>
      <div class="modal-body">
        <div class="update-role_id">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider
              rules="oneOf:1,2,3,4,5,6,7,8,9,10,11,12"
              v-slot="{ errors }"
              name="職種"
            >
              <select v-model="value" name="職種">
                <option value="" selected hidden>-選択して下さい-</option>
                <option value="1">医師</option>
                <option value="2">看護師</option>
                <option value="3">介護士</option>
                <option value="4">薬剤師</option>
                <option value="5">栄養士</option>
                <option value="6">理学療法士</option>
                <option value="7">作業療法士</option>
                <option value="8">言語聴覚士</option>
                <option value="9">ケアマネージャー</option>
                <option value="10">支援相談員</option>
                <option value="11">施設担当者</option>
                <option value="12">その他</option>
              </select>
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateRoleId()"
              class="update-role_id_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              職種を登録
            </button>
          </validation-observer>
          <p v-on:click="hideRoleId()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-update-shop_id" height="auto">
      <div class="modal-header">
        <h2>所属事業所の登録</h2>
      </div>
      <div class="modal-body">
        <div class="update-shop_id">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider
              rules="required"
              v-slot="{ errors }"
              name="所属事業所"
            >
              <div id="app">
                <div style="max-width: 400px; margin: 0 auto">
                  <p>下記より検索をご利用下さい。</p>
                  <p class="update-shop_id_small-explain">
                    ※検索に存在しない場合は<NuxtLink to="/register-shop"
                      >「所属事業所の新規作成」</NuxtLink
                    >して下さい。
                  </p>
                  <FilterableDropdown
                    v-model="selectedValue"
                    :items="shops"
                    :showEmptyItem="true"
                    :disabled="false"
                    :ignoreCase="true"
                    emptyItemValue="-所属事業所は未選択です-"
                    emptyItemText=""
                    placeholder="-所属事業所を検索し選択して下さい-"
                    name="所属事業所"
                    idKey="id"
                    valueKey="id"
                    textKey="name"
                    filterTargetKey="name"
                  >
                  </FilterableDropdown>
                </div>
              </div>
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateShopId()"
              class="update-shop_id_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              選択した所属事業所を登録
            </button>
          </validation-observer>
          <NuxtLink to="/register-shop">
            <button class="store-shop_id_btn">
              選択肢に無い事業所を新規作成
            </button>
          </NuxtLink>
          <p v-on:click="hideShopId()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
    <modal name="modal-update-shop_info" height="auto">
      <div class="modal-header">
        <h2>事業所情報の編集</h2>
        <p>
          ※別な事業所を選択する場合は<span
            class="link"
            @click="showUpdateShop()"
            >選択画面</span
          >に移動して下さい。
        </p>
        <p>※選択肢に事業所が存在しない場合は新規作成が可能となります。</p>
      </div>
      <div class="modal-body">
        <div class="update-shop_info">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:100">
              <p class="update-shop_box_input_ttl">
                事業所名:{{ propsModal.workerInfo.shop.name }}
              </p>
              <p class="update-shop_box_input_content">
                ※検索しやすいように病院名、法人名などは正確にご記入下さい。
              </p>
              <input
                v-model="propsModal.workerInfo.shop.name"
                type="text"
                name="事業所名"
                required
                placeholder="事業所名"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider
              rules="required"
              v-slot="{ errors }"
              name="事業所分類"
            >
              <div id="app">
                <div style="max-width: 400px; margin: 0 auto">
                  <p class="update-shop_box_input_ttl">
                    事業所分類:{{ propsModal.workerInfo.shop.shop_type.name }}
                  </p>
                  <FilterableDropdown
                    v-model="propsModal.workerInfo.shop.shop_type.id"
                    :items="shopTypes"
                    :showEmptyItem="true"
                    :disabled="false"
                    :ignoreCase="true"
                    emptyItemValue="-事業所分類は未選択です-"
                    emptyItemText=""
                    placeholder="-事業所分類を選択して下さい-"
                    name="事業所分類"
                    idKey="id"
                    valueKey="id"
                    textKey="name"
                    filterTargetKey="name"
                  >
                  </FilterableDropdown>
                </div>
              </div>
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider v-slot="{ errors }" rules="email|max:256">
              <p class="update-shop_box_input_ttl">
                メールアドレス:{{ propsModal.workerInfo.shop.email
                }}<span v-if="propsModal.workerInfo.shop.email == null"
                  >未登録</span
                ><span class="small">※任意</span>
              </p>
              <input
                v-model="propsModal.workerInfo.shop.email"
                type="email"
                name="メールアドレス"
                placeholder="メールアドレス"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider v-slot="{ errors }" rules="phone">
              <p class="update-shop_box_input_ttl">
                電話番号:{{ propsModal.workerInfo.shop.number
                }}<span v-if="propsModal.workerInfo.shop.number == null"
                  >未登録</span
                >
                <span class="small">※任意</span>
              </p>
              <input
                v-model="propsModal.workerInfo.shop.number"
                type="tel"
                name="電話番号"
                placeholder="電話番号"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="updateShopInfo()"
              class="update-shop_info_btn"
              :disabled="ObserverProps.invalid"
            >
              編集した内容を登録
            </button>
          </validation-observer>
          <button @click="showUpdateShop()" class="change-shop_info_btn">
            事業所を再選択する
          </button>
          <p v-on:click="hideShopInfo()" class="hide-btn">編集を中止する</p>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import firebase from "~/plugins/firebase";
import FilterableDropdown from "./FilterableDropdown.vue";
export default {
  components: {
    FilterableDropdown,
  },
  data() {
    return {
      iconFile: "",
      errIconFile: true,
      overSizeIcon: false,
      exceptionIcon: false,
      value: null,
      selectedValue: null,
      shopTypes: [],
      shops: [],
      newEmail: "",
      password: "",
    };
  },
  // WorkerMyPage.vueからデータの引き継ぎ
  props: ["propsModal"],
  methods: {
    // 所属事業所選択のためにshop の情報を取得
    async getShopInfo() {
      const getShopInfo = await this.$axios
        .get("http://127.0.0.1:8000/api/v1/shop")
        .catch(() => {
          location.reload();
          alert("エラーが起きました。しばらくしてから再度お試しください。");
        });
      this.shops = getShopInfo.data.data;
    },
    // 
    showUpdateShop() {
      this.hideShopInfo();
      this.$modal.show("modal-update-shop_id");
    },
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
    hideRoleId() {
      this.$modal.hide("modal-update-role_id");
    },
    hideShopId() {
      this.$modal.hide("modal-update-shop_id");
    },
    hideShopInfo() {
      this.$modal.hide("modal-update-shop_info");
    },
    // アイコンの投稿のファイル選択時のバリデーション
    checkIcon(p) {
      this.iconFile = p.target.files[0];
      const size = this.iconFile.size;
      const type = this.iconFile.type;
      // 10MBまででファイル形式は3種類のみ、違えばエラー表示と送信ボタンが使えない状態にする。
      if (size > 10000000) {
        this.errIconFile = true;
        this.overSizeIcon = true;
      }
      if (
        type != "image/jpg" &&
        type != "image/jpeg" &&
        type != "image/png" &&
        type != "image/gif" &&
        type != "image/tif" &&
        type != "image/tiff" &&
        type != "image/psd" &&
        type != "image/svg"
      ) {
        this.errIconFile = true;
        this.exceptionIcon = true;
      }
      if (size <= 10000000) {
        this.overSizeIcon = false;
        if (
          type == "image/jpg" ||
          type == "image/jpeg" ||
          type == "image/png" ||
          type == "image/gif" ||
          type == "image/tif" ||
          type == "image/tiff" ||
          type == "image/psd" ||
          type == "image/svg"
        ) {
          this.errIconFile = false;
          this.exceptionIcon = false;
        }
      }
    },
    async updateIcon() {
      // checkIconでエラーがない時のみ処理を行う
      if (this.errIconFile == false) {
        // ヘッダーでフォームデータを定義
        const config = {
          headers: { "content-type": "multipart/form-data" },
        };
        // Formデータ作成
        const formData = new FormData();
        formData.append("file", this.iconFile);
        formData.append(
          "worker_id",
          JSON.stringify(this.$store.state.loginUserId)
        );
        await this.$axios
          .post(
            "http://127.0.0.1:8000/api/v1/worker-icon_update",
            formData,
            config
          )
          .catch(() => {
            location.reload();
            alert("エラーが起きました。しばらくしてから再度お試しください。");
          });
        location.reload();
      } else {
        location.reload();
      }
    },
    // workerの name number の更新
    async updateName() {
      const UpdateName = {
        name: this.propsModal.workerName,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/worker/" +
            this.$store.state.loginUserId,
          UpdateName
        )
        .then(() => {
          this.hideName();
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
    async updateEmail() {
      // 再度ログインしてパスワードもチェック
      await this.login();
      // firebaseでメールアドレスの変更
      const user = firebase.auth().currentUser;
      user
        .updateEmail(this.newEmail)
        .then(() => {
          // firebaseのメールがupdateできたらデータベースも処理
          this.updateEmailDb();
        })
        .catch((error) => {
          switch (error.code) {
            case "auth/invalid-email":
              alert("メールアドレスの形式が違います。");
              break;
            case "auth/user-disabled":
              alert("ユーザーが無効になっています。");
              break;
            case "auth/user-not-found":
              alert("ユーザーが存在しません。");
              break;
            default:
              alert("エラーが起きました。しばらくしてから再度お試しください。");
              break;
          }
        });
    },
    // firebase のメール変更のために再ログイン
    async login() {
      await firebase
        .auth()
        .signInWithEmailAndPassword(this.propsModal.workerEmail, this.password)
        .catch((error) => {
          const errorCode = error.code;
          alert(
            "error : " +
              errorCode +
              "メールアドレスの変更に失敗しました。メールアドレスとパスワードをご確認の上、再度お試し下さい。"
          );
        });
    },
    // firebaseのメールがupdateできたら下の処理する
    async updateEmailDb() {
      const UpdateEmail = {
        email: this.newEmail,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/worker/" +
            this.$store.state.loginUserId,
          UpdateEmail
        )
        .then(() => {
          this.hideName();
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
    async updateNumber() {
      const UpdateNumber = {
        number: this.propsModal.workerPhoneNumber,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/worker/" +
            this.$store.state.loginUserId,
          UpdateNumber
        )
        .then(() => {
          this.hideNumber();
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
    // workerの電話番号削除
    async deleteNumber() {
      const DeleteNumber = {
        number: null,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/worker/" +
            this.$store.state.loginUserId,
          DeleteNumber
        )
        .then(() => {
          this.hideNumber();
        })
        .catch(() => {
          location.reload();
          alert("エラーが起きました。しばらくしてから再度お試しください。");
        });
      location.reload();
    },
    // workerの role_id の更新
    async updateRoleId() {
      const UpdateRoleId = {
        role_id: this.value,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/worker/" +
            this.$store.state.loginUserId,
          UpdateRoleId
        )
        .then(() => {
          this.hideRoleId();
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
    // workerの shop_id の更新
    async updateShopId() {
      const UpdateShopId = {
        shop_id: this.selectedValue,
      };
      await this.$axios
        .put(
          "http://127.0.0.1:8000/api/v1/worker/" +
            this.$store.state.loginUserId,
          UpdateShopId
        )
        .then(() => {
          this.hideRoleId();
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
    // shops に事業所情報の更新
    async updateShopInfo() {
      // 情報が足りない場合の対処
      if (
        !this.propsModal.workerInfo.shop.name ||
        !this.propsModal.workerInfo.shop.shop_type.id
      ) {
        alert(
          "エラーが起きました。入力項目に誤りがありました。内容をご確認の上、再度お試し下さい"
        );
        this.$router.replace("/my-page");
      } else {
        // shops に登録情報を送信
        const updateShopInfo = {
          name: this.propsModal.workerInfo.shop.name,
          shop_type_id: this.propsModal.workerInfo.shop.shop_type.id,
          number: this.propsModal.workerInfo.shop.number,
          email: this.propsModal.workerInfo.shop.email,
        };
        await this.$axios
          .put(
            "http://127.0.0.1:8000/api/v1/shop/" +
              this.propsModal.workerInfo.shop.id,
            updateShopInfo
          )
          .then(() => {
            this.hideShopInfo();
          });
        location.reload();
      }
    },
    // 事業所分類選択のために shop_types の情報を取得
    async getShopTypeInfo() {
      const getShopTypeInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/shop_type"
      );
      this.shopTypes = getShopTypeInfo.data.data;
    },
  },
  created() {
    // shops から事業所情報を取得、modal-update-shop_idで検索で使用
    this.getShopInfo();
    // vuex の clientOrWorker が worker かを確認してケアワーカーのみ作成可能にする。
    if (this.$store.state.clientOrWorker != "worker") {
      alert("エラーが発生しました。アカウント情報に誤りがあります。");
      this.$router.replace("my-page");
    }
    // shop_types をmodal-update-shop_infoで選択肢で使うために取得
    this.getShopTypeInfo();
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
.modal-body .update-icon input {
  height: 38px;
  margin: 30px;
  font-size: 20px;
}
.modal-body .update-icon .error {
  font-size: 16px;
}
.modal-body .update-icon_btn {
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
.modal-body .update-icon_btn-disable {
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
.modal-body .update-name_btn:disabled {
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
.modal-body .update-email_btn:disabled {
  margin-top: 30px;
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
.modal-body .update-number_btn:disabled {
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
.modal-body .update-role_id {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-role_id select {
  height: 30px;
  margin: 30px;
  font-size: 14px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-role_id_btn {
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
.modal-body .update-role_id_btn:disabled {
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
.modal-body .update-shop_id {
  position: static;
  z-index: 1;
  width: 100%;
  height: 600px;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-shop_id .update-shop_id_small-explain {
  font-size: 12px;
  margin-top: 10px;
  margin-bottom: 30px;
}
.modal-body .update-shop_id_btn {
  margin-top: 380px;
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
.modal-body .update-shop_id_btn:disabled {
  margin-top: 380px;
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
.modal-body .store-shop_id_btn {
  margin-top: 380px;
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: #a80000;
  color: #fff;
  border: 1px solid #500000;
  cursor: pointer;
}
.modal-body .store-shop_id_btn {
  margin-top: 380px;
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: #a80000;
  color: #fff;
  border: 1px solid #500000;
  cursor: pointer;
}
.modal-body .update-shop_info {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-shop_box_input_ttl {
  margin-top: 20px;
  font-size: 16px;
  font-weight: bold;
}
.modal-body .update-shop_box_input_ttl .small {
  padding-left: 10px;
  font-size: 14px;
  font-weight: normal;
  color: #a80000;
}
.modal-body .update-shop_box_input_content {
  font-size: 12px;
}
.modal-header p {
  font-size: 14px;
  margin-top: 10px;
}
.modal-header .link {
  color: #551a8b;
  cursor: pointer;
  text-decoration: underline;
}
.modal-body .update-shop_info input {
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-shop_info .update-shop_info_small-explain {
  font-size: 12px;
  margin-top: 10px;
  margin-bottom: 30px;
}
.modal-body .update-shop_info_btn {
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
.modal-body .update-shop_info_btn:disabled {
  margin-top: 30px;
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
.modal-body .change-shop_info_btn {
  margin-top: 30px;
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
</style>