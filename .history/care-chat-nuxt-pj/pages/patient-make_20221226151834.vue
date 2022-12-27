<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="patient-make">
      <div class="patient-make_box">
        <h3 class="patient-make_box_ttl">ケアチャット新規作成</h3>
        <p class="patient-make_box_content">
          ※既に作成済みのチャットに参加を希望する場合は作成者と「チャットID」「パスワード」を共有し、<NuxtLink
            to="/patient-index"
            >「チャットに参加」</NuxtLink
          >を利用して下さい。
        </p>
        <div class="form">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:100">
              <p class="patient-make_box_input_ttl">チャットID</p>
              <p class="patient-make_box_input_content">
                ※患者様のお名前などで自由に作成して下さい。
              </p>
              <p class="patient-make_box_input_content">
                ※20字以内の入力をお願いします。
              </p>
              <input
                v-model="name"
                type="text"
                name="チャットID"
                required
                placeholder="チャットID"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider
              v-slot="{ errors }"
              vid="password"
              rules="required|min:6|max:256|alpha_dash"
            >
              <p class="patient-make_box_input_ttl">チャットパスワード</p>
              <p class="patient-make_box_input_content">
                ※半角入力、アルファベット、数字を6文字以上で作成して下さい。
              </p>
              <input
                v-model="password"
                type="password"
                name="チャットパスワード"
                required
                placeholder="チャットパスワード"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider
              v-slot="{ errors }"
              rules="required|confirmed:password"
            >
              <p class="patient-make_box_input_ttl">チャットパスワード再確認</p>
              <p class="patient-make_box_input_content">
                ※上記と同じ内容を入力して下さい。
              </p>
              <input
                v-model="confirmation"
                type="password"
                name="チャットパスワード再確認"
                placeholder="チャットパスワード再確認"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="make()"
              class="patient-make_btn"
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
export default {
  data() {
    return {
      name: "",
      password: "",
      confirmation: "",
      newPatientId: "",
      newPatientInfo: {},
    };
  },
  methods: {
    // 患者チャット patient を作成する
    async make() {
      //  patient 情報を patientsテーブルに登録
      const newPatientNamePass = {
        name: this.name,
        password: this.password,
      };
      const getNewPatientId = await this.$axios
        .post("http://127.0.0.1:8000/api/v1/patient", newPatientNamePass)
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
        });
      // 既に存在するpasswordの場合、入力し直してもらう。
      if (getNewPatientId.status == 202) {
        alert(
          "ご入力頂いたパスワードが既に使用されているためご利用できません。他のパスワードをご入力下さい。"
        );
      } else if (getNewPatientId.data.data) {
        this.newPatientInfo = getNewPatientId.data.data;
        this.newPatientId = getNewPatientId.data.data.id;
        // ログインアカウントがclient か workerかを判別して、それぞれの中間テーブルに履歴を記録
        if (this.$store.state.clientOrWorker == "client") {
          const clientIdAndPatientId = {
            client_id: this.$store.state.loginUserId,
            patient_id: this.newPatientId,
          };
          await this.$axios
            .post(
              "http://127.0.0.1:8000/api/v1/client-patient",
              clientIdAndPatientId
            )
            .catch(() => {
              location.reload();
              alert("エラーが起きました。しばらくしてから再度お試しください。");
            });
          // patient_idをVuex.storeで保持
          await this.$store.commit("SetJoinPatientId", this.newPatientId);
          this.$router.replace("thanks-make-patient");
        } else if (this.$store.state.clientOrWorker == "worker") {
          const workerIdAndPatientId = {
            worker_id: this.$store.state.loginUserId,
            patient_id: this.newPatientId,
          };
          await this.$axios
            .post(
              "http://127.0.0.1:8000/api/v1/worker-patient",
              workerIdAndPatientId
            )
            .catch(() => {
              location.reload();
              alert("エラーが起きました。しばらくしてから再度お試しください。");
            });
          // patient_idをVuex.storeで保持
          await this.$store.commit("SetJoinPatientId", this.newPatientId);
          this.$router.replace("thanks-make-patient");
        } else {
          alert(
            "登録情報にエラーがある可能性があります。内容をご確認頂き、再度ログインをお試し下さい。"
          );
          this.$store.commit("logout");
          this.$router.replace("/");
        }
      }
    },
  },
};
</script>

<style>
.patient-make {
  display: flex;
  justify-content: center;
}
.patient-make_box {
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.patient-make_box_ttl {
  font-size: 30px;
}
.patient-make_box_content {
  margin-top: 10px;
  font-size: 12px;
}
.patient-make_box .form {
  margin-top: 20px;
  text-align: center;
}
.patient-make_box_input_ttl {
  margin-top: 20px;
  font-size: 20px;
  font-weight: bold;
}
.patient-make_box_input_content {
  font-size: 12px;
}
.patient-make_box input {
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.patient-make_btn {
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
.patient-make_btn:disabled {
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
  .patient-make {
    margin: 10px;
  }
  .patient-make_box {
    width: 80vw;
    padding: 20px;
  }
  .patient-make_box_ttl {
    font-size: 20px;
  }
  .patient-make_box_content {
    margin-top: 0px;
  }
  .patient-make_box .form {
    margin-top: 20px;
  }
  .patient-make_box_input_ttl {
    margin-top: 10px;
    font-size:  16px;
  }
  .patient-make_box_input_content {
    font-size: 12px;
  }
  .patient-make_box input {
    width: 80%;
    height: 20px;
  }
  .patient-make_btn {
    margin: 10px;
    width: 100px;
    padding-top: 5px;
    padding-bottom: 10px;
    background: rgb(42, 171, 191);
    color: #fff;
    border: 1px solid rgb(28, 117, 131);
    cursor: pointer;
  }
  .patient-make_btn:disabled {
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