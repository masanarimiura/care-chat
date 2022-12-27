<template>
  <div>
    <HeaderOut></HeaderOut>
    <div class="register-client">
      <div class="register-client_box">
        <h3 class="register-client_box_ttl">クライアント新規登録</h3>
        <p class="register-client_box_content">
          ※患者様ご本人・ご家族様等の方のみこちらより作成をお願いします。
        </p>
        <p class="register-client_box_content">
          ※医療福祉従事者の方は<NuxtLink to="/register-worker"
            >ケアワーカー新規登録</NuxtLink
          >ページへ移動して下さい。
        </p>
        <div class="form">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:100">
              <p class="register-client_box_input_ttl">お名前</p>
              <p class="register-client_box_input_content">
                ※患者様名ではなくご登録者様ご本人様のお名前を入力して下さい。
              </p>
              <p class="register-worker_box_input_content">
                ※患者様ご本人様が登録する場合は患者様のお名前を入力して下さい。
              </p>
              <input
                v-model="name"
                type="text"
                name="お名前"
                required
                placeholder="お名前"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider
              v-slot="{ errors }"
              rules="required|email|max:256|"
            >
              <p class="register-client_box_input_ttl">メールアドレス</p>
              <input
                v-model="email"
                type="email"
                name="メールアドレス"
                required
                placeholder="メールアドレス"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider
              v-slot="{ errors }"
              vid="password"
              rules="required|min:6|max:256|alpha_dash"
            >
              <p class="register-client_box_input_ttl">パスワード</p>
              <p class="register-client_box_input_content">
                ※半角入力、アルファベット、数字を6文字以上で作成して下さい。
              </p>
              <input
                v-model="password"
                type="password"
                name="パスワード"
                required
                placeholder="パスワード"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider
              v-slot="{ errors }"
              rules="required|confirmed:password"
            >
              <p class="register-client_box_input_ttl">パスワード再確認</p>
              <p class="register-client_box_input_content">
                ※上記と同じ内容を入力して下さい。
              </p>
              <input
                v-model="confirmation"
                type="password"
                name="パスワード再確認"
                placeholder="パスワード再確認"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="register()"
              class="register-client_btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              新規登録
            </button>
          </validation-observer>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import firebase from "~/plugins/firebase";
export default {
  data() {
    return {
      name: null,
      email: null,
      password: null,
      confirmation: null,
      uid: null,
    };
  },
  methods: {
    // clientとして登録
    async register() {
      // まずはfirebaseに登録。この時点ではclientとworker区別なし。
      await firebase
        .auth()
        .createUserWithEmailAndPassword(this.email, this.password)
        .then((data) => {
          this.uid = data.user.uid;
          data.user.sendEmailVerification({
            url: "http://localhost:3000/thanks-register-account",
            handleCodeInApp: true,
          });
        })
        .catch((error) => {
          switch (error.code) {
            case "auth/invalid-email":
              alert("メールアドレスの形式が違います。");
              break;
            case "auth/email-already-in-use":
              alert("このメールアドレスはすでに使われています。");
              break;
            case "auth/weak-password":
              alert("パスワードは6文字以上で入力してください。");
              break;
            default:
              alert("エラーが起きました。しばらくしてから再度お試しください。");
              break;
          }
        });
      // clientテーブルにfirebaseの登録情報を送信
      const newClientData = {
        name: this.name,
        email: this.email,
        password: this.password,
        uid: this.uid,
      };
      await this.$axios
        .post("http://127.0.0.1:8000/api/v1/client", newClientData)
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
      this.$router.replace("/wait-email-verification");
    },
  },
};
</script>

<style>
.register-client {
  display: flex;
  justify-content: center;
}
.register-client_box {
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
  margin-bottom: 100px;
}
.register-client_box_ttl {
  font-size: 30px;
}
.register-client_box_content {
  margin-top: 10px;
  font-size: 12px;
}
.register-client_box .form {
  margin-top: 20px;
  text-align: center;
}
.register-client_box_input_ttl {
  margin-top: 20px;
  font-size: 20px;
  font-weight: bold;
}
.register-client_box_input_content {
  font-size: 12px;
}
.register-client_box input {
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.register-client_btn {
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
.register-client_btn:disabled {
  margin: 20px;
  width: 100px;
  border-radius: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  background: rgb(171, 212, 218);
  cursor: not-allowed;
}
@media screen and (max-width: 768px) {
  .register-client {
    margin: 0 20px;
  }
  .register-client_box {
    width: 100%;
    padding: 10px;
  }
  .register-client_box_ttl {
    font-size: 20px;
  }
  .register-client_box_content {
    margin-top: 5px;
    font-size: 12px;
  }
  .register-client_box .form {
    margin-top: 10px;
  }
  .register-client_box_input_ttl {
    margin-top: 5px;
    font-size: 16px;
  }
  .register-client_box_input_content {
    font-size: 12px;
  }
  .register-client_box input {
    width: 80%;
    height: 20px;
    border: 2px solid rgb(42, 171, 191);
    border-radius: 10px;
  }
  .register-client_btn {
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
  .register-client_btn:disabled {
    margin: 20px;
    width: 100px;
    border-radius: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
    color: #fff;
    border: 1px solid rgb(28, 117, 131);
    background: rgb(171, 212, 218);
    cursor: not-allowed;
  }
}
</style>