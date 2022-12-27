<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="login-register_ttl">
      <h2>Care Chat</h2>
      <h2>アカウントページ</h2>
      <p>
        ※「ケアチャット」を利用するにはまず、ご本人様の<NuxtLink
          to="/register-client"
          >「クライアントアカウント」</NuxtLink
        >もしくは,<NuxtLink to="/register-worker"
          >「ケアワーカーアカウント」</NuxtLink
        >の作成が必要です。
      </p>
      <p>
        ※患者様ご本人様も<NuxtLink to="/register-client"
          >「クライアントアカウント」</NuxtLink
        >の作成が必要になります。
      </p>
    </div>
    <div class="login-register">
      <div class="login">
        <div class="login_box">
          <h3 class="login_box_ttl">ログイン</h3>
          <p class="login_box_content">
            ※ログイン後にチャットIDの作成、チャット参加が可能となります。
          </p>
          <p class="login_box_content">
            ※チャットIDとチャットパスワードのみではログインできません。ご自身のアカウントを新規作成してからログインして下さい。
          </p>
          <br />
          <p class="login_box_input_ttl">メールアドレス</p>
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider
              v-slot="{ errors }"
              rules="required|email|max:256"
            >
              <input
                v-model="email"
                type="email"
                name="メールアドレス"
                required
                placeholder="メールアドレス"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <p class="login_box_input_ttl">パスワード</p>
            <validation-provider
              v-slot="{ errors }"
              rules="required|min:6|max:256|alpha_dash"
            >
              <input
                v-model="password"
                type="password"
                name="パスワード"
                required
                placeholder="パスワード"
              />
              <p class="login_box_password-reset" @click="showResetPassword()">
                ※パスワードを忘れてしまった場合はこちら
              </p>
              <br />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="loginFirebase()"
              class="login__btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              ログイン
            </button>
          </validation-observer>
        </div>
      </div>
      <div class="register">
        <div class="register_box">
          <h3 class="register_box_ttl">新規登録</h3>
          <p class="register_box_content">
            ※アカウント作成しログイン後にチャットID作成、ログインが可能となります。
          </p>
          <br />
          <NuxtLink to="/register-client" class="nuxt-link"
            >クライアントとして新規登録</NuxtLink
          >
          <p class="register_box_content">
            ※患者様ご本人・ご家族様等はこちらより作成をお願いします。
          </p>
          <br />
          <NuxtLink to="/register-worker" class="nuxt-link"
            >ケアワーカーとして新規登録</NuxtLink
          >
          <p class="register_box_content">
            ※医療福祉従事者の方はこちらより作成をお願いします。
          </p>
        </div>
      </div>
    </div>
    <modal name="modal-reset-password" height="auto">
      <div class="modal-header">
        <h2>パスワードを忘れてしまった場合</h2>
        <p>
          メールアドレスに新しいパスワードを設定できるようにURLをお送りします。
        </p>
      </div>
      <div class="modal-body">
        <div class="reset-password">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:100">
              <p>こちらにメールアドレスをご入力下さい。</p>
              <input
                v-model="emailPasswordReset"
                type="email"
                name="メールアドレス"
                required
                placeholder="メールアドレス"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="resetPassword()"
              class="reset-password_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              パスワード変更のメールを送る
            </button>
          </validation-observer>
          <p v-on:click="hideResetPassword()" class="hide-btn">
            編集を中止する
          </p>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import firebase from "~/plugins/firebase";
export default {
  data() {
    return {
      email: null,
      password: null,
      emailPasswordReset: null,
    };
  },
  methods: {
    // firebaseにログイン情報を送信
    async loginFirebase() {
      await firebase
        .auth()
        .signInWithEmailAndPassword(this.email, this.password)
        .then(() => {
          // メール認証が済んでいない場合は確認メールの再送
          if (firebase.auth().currentUser.emailVerified == false) {
            alert(
              "確認メールを送信しましたので、ご自身のメールをご確認下さい。"
            );
            firebase.auth().currentUser.sendEmailVerification({
              url: "http://localhost:3000/thanks-register-account",
              handleCodeInApp: true,
            });
          } else if (firebase.auth().currentUser.emailVerified == true) {
            this.$router.replace("/patient-index");
          }
        })
        .catch((error) => {
          switch (error.code) {
            case "auth/user-disabled":
              alert(
                "入力頂いたアカウントのサービスの利用が停止されています。内容をご確認の上再度お試し下さい。"
              );
              break;
            case "auth/user-not-found":
              alert(
                "メールアドレスまたはパスワードが違います。内容をご確認の上再度お試し下さい。"
              );
              break;
            case "auth/wrong-password":
              alert(
                "パスワードが間違っています。内容をご確認の上再度お試し下さい。"
              );
              break;
            case "auth/requires-recent-login":
              alert(
                "認証の有効期限が切れています。内容をご確認の上再度お試し下さい。"
              );
              break;
            default:
              alert("エラーが起きました。しばらくしてから再度お試しください。");
              break;
          }
          location.reload();
        });
    },
    hideResetPassword() {
      this.$modal.hide("modal-reset-password");
    },
    showResetPassword() {
      this.$modal.show("modal-reset-password");
    },
    async resetPassword() {
      await firebase
        .auth()
        .sendPasswordResetEmail(this.emailPasswordReset)
        .then(() => {
          this.$router.replace("/wait-email-verification");
        })
        .catch((error) => {
          location.reload();
          switch (error.code) {
            case "auth/user-disabled":
              alert(
                "入力頂いたアカウントのサービスの利用が停止されています。内容をご確認の上再度お試し下さい。"
              );
              break;
            case "auth/user-not-found":
              alert(
                "入力頂いたメールアドレスが見つかりません。内容をご確認の上再度お試し下さい。"
              );
              break;
            case "auth/requires-recent-login":
              alert(
                "認証の有効期限が切れています。内容をご確認の上再度お試し下さい。"
              );
              break;
            default:
              alert("エラーが起きました。しばらくしてから再度お試しください。");
              break;
          }
        });
    },
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
  font-size: 50px;
}
.login-register_ttl p {
  margin-top: 10px;
  text-align: left;
  font-size: 14px;
}
@media screen and (max-width: 768px) {
  .login-register_ttl {
    width: 100%;
  }
  .login-register_ttl h2 {
    font-size: 20px;
  }
  .login-register_ttl p {
    margin-top: 5px;
    padding-left: 10px;
    text-align: left;
    font-size: 12px;
  }
}
.login-register {
  margin: 10px 50px 0 50px;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}
.login,
.register {
  margin: 20px;
  display: flex;
  justify-content: center;
}
.login_box,
.register_box {
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(233, 245, 255);
  border-radius: 10px;
  padding: 50px;
}
.login_box_ttl,
.register_box_ttl {
  font-size: 30px;
}
.register_box_content,
.login_box_content {
  margin-top: 10px;
  font-size: 12px;
}
.login_box_input_ttl {
  font-size: 20px;
}
.login_box input {
  margin: 10px;
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.login_box_password-reset {
  display: inline-block;
  font-size: 14px;
  cursor: pointer;
  text-decoration: underline;
}
.login_box_password-reset:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
.login__btn {
  margin: 20px;
  width: 100px;
  border-radius: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
.login__btn:disabled {
  margin: 20px;
  width: 100px;
  border-radius: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: rgb(171, 212, 218);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: not-allowed;
}
.register_box {
  background-color: rgb(211, 252, 237);
}
.register_box .nuxt-link {
  margin-top: 20px;
  display: inline-block;
  text-decoration: none;
  font-size: 20px;
  color: rgb(42, 171, 191);
  border-radius: 10px;
  padding: 20px 20px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
@media screen and (max-width: 768px) {
  .login-register {
    margin: 0px;
  }
  .login_box,
  .register_box {
    max-width: 750px;
    width: 90vw;
    padding: 10px;
  }
  .login_box_ttl,
  .register_box_ttl {
    font-size: 20px;
  }
  .register_box_content,
  .login_box_content {
    text-align: left;
    margin-top: 5px;
    font-size: 12px;
  }
  .login_box_input_ttl {
    font-size: 12px;
  }
  .login_box input {
    width: 80%;
    margin: 5px;
    height: 20px;
    border: 2px solid rgb(42, 171, 191);
    border-radius: 10px;
  }
  .login_box_password-reset {
    font-size: 12px;
  }
  .login__btn {
    margin: 5px;
    width: 100px;
    padding-top: 5px;
    padding-bottom: 5px;
  }
  .login__btn:disabled {
    margin: 5px;
    width: 100px;
    padding-top: 5px;
    padding-bottom: 5px;
  }
  .register_box .nuxt-link {
  margin-top: 6px;
  font-size: 16px;
  padding: 10px;
}
}
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
.modal-body .reset-password {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .reset-password p {
  margin-top: 20px;
}
.modal-body .reset-password input {
  margin-top: 10px;
  width: 300px;
  height: 30px;
  font-size: 18px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .reset-password_btn {
  margin-top: 20px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}
.modal-body .reset-password_btn:disabled {
  margin-top: 20px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: rgb(171, 212, 218);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: not-allowed;
}
</style>