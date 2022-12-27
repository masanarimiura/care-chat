<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="patient-join-make_ttl">
      <h2>ケアチャット</h2>
      <p>
        ※チャットIDの分かる方は「チャットに参加」へ。初めてご利用される場合は「チャット作成」をお願いします。
      </p>
    </div>
    <div class="patient-join-record">
      <h3>過去に参加したチャット</h3>
      <p v-if="patientsData.length == 0">参加履歴はありません。<br>「チャットに参加」または「チャットの新規作成」をご利用下さい。</p>
      <ul>
        <li v-for="patient in patientsData" :key="patient.patient.name">
          <p @click="joinRecord(patient.patient.id)">
            {{ patient.patient.name }}
          </p>
        </li>
      </ul>
    </div>
    <div class="patient-join-make">
      <div class="patient-join">
        <div class="patient-join_box">
          <h3 class="patient-join_box_ttl">チャットに参加</h3>
          <p class="patient-join_box_content">
            ※チャットIDが分かる方はこちらからログインして下さい。
          </p>
          <br />
          <p class="patient-join_box_input_ttl">チャットID</p>
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:100">
              <input
                v-model="name"
                type="text"
                name="チャットID"
                required
                placeholder="チャットID"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <br />
            <p class="patient-join_box_input_ttl">チャットパスワード</p>
            <validation-provider
              v-slot="{ errors }"
              rules="required|min:6|max:256|alpha_dash"
            >
              <input
                v-model="password"
                type="password"
                name="チャットパスワード"
                required
                placeholder="チャットパスワード"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <br />
            <button
              @click="joinIdPass()"
              class="patient-join__btn"
              :disabled="ObserverProps.invalid || !ObserverProps.validated"
            >
              ログイン
            </button>
          </validation-observer>
        </div>
      </div>
      <div class="patient-make">
        <div class="patient-make_box">
          <h3 class="patient-make_box_ttl">チャットの新規作成</h3>
          <br />
          <NuxtLink to="/patient-make" class="nuxt-link"
            >ケアチャット新規作成ページへ</NuxtLink
          >
          <p class="patient-make_box_content">
            ※既にチャットIDを作成済みの方は作成者と「チャットID」「パスワード」を共有し、「チャットに参加」を利用して下さい。
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: null,
      password: null,
      patientId: null,
      patientsData: {},
    };
  },
  methods: {
    async getRecord() {
      // Vuexのログインid変更の検知から患者チャットの履歴 client-patients or worker-patientsテーブル を引き出す。
      if (this.$store.state.clientOrWorker == "client") {
        const clientId = {
          client_id: this.$store.state.loginUserId,
        };
        const getClientPatientRecord = await this.$axios.get(
          "http://127.0.0.1:8000/api/v1/client-patient-search",
          { params: clientId }
        )
        .catch(() => {
          location.reload();

              alert("エラーが起きました。しばらくしてから再度お試しください。");
        });;
        this.patientsData = getClientPatientRecord.data.data;
      } else if (this.$store.state.clientOrWorker == "worker") {
        const workerId = {
          worker_id: this.$store.state.loginUserId,
        };
        const getWorkerPatientRecord = await this.$axios.get(
          "http://127.0.0.1:8000/api/v1/worker-patient-search",
          { params: workerId }
        );
        this.patientsData = getWorkerPatientRecord.data.data;
      }
    },
    // 履歴をクリックするとそのpatientのページにアクセス
    async joinRecord(recordedPatientId) {
      // 次のページでpatient_idを利用するためvuexに保管する。
      this.patientId = recordedPatientId;
      this.$store.commit("SetJoinPatientId", this.patientId);
      this.$router.replace("patient-chat");
    },
    // チャットIDとパスワードでjoinするとそのpatientのページにアクセス
    async joinIdPass() {
      // ここでpatientのnameとpasswordを使ってidを取得、
      const patientNamePass = {
        name: this.name,
        password: this.password,
      };
      const getPatientId = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/patient-search",
        { params: patientNamePass }
      );
      this.patientId = getPatientId.data.data.id;
      // 次のページでpatient_idを利用するためvuexに保管する。
      this.$store.commit("SetJoinPatientId", this.patientId);
      // ログインアカウントがclient or workerかを判別する。
      if (this.$store.state.clientOrWorker == "client") {
        // clientの場合、client-patientsテーブルに患者チャット参加の履歴があるか確認し保存。
        const clientIdPatientId = {
          client_id: this.$store.state.loginUserId,
          patient_id: this.patientId,
        };
        await this.$axios.post(
          "http://127.0.0.1:8000/api/v1/client-patient",
          clientIdPatientId
        );
      } else if (this.$store.state.clientOrWorker == "worker") {
        // workerの場合、まずworker-patientsテーブルに患者チャット参加の履歴があるか確認し保存。
        const workerIdPatientId = {
          worker_id: this.$store.state.loginUserId,
          patient_id: this.patientId,
        };
        await this.$axios.post(
          "http://127.0.0.1:8000/api/v1/worker-patient",
          workerIdPatientId
        );
      }
      this.$router.replace("patient-chat");
    },
  },
  mounted() {
    // Vuexのログインid変更を検知して、client-patients or worker-patients テーブルで参加履歴を検索するgetRecord()を起動
    this.$store.subscribe((mutation) => {
      if (mutation.type === "clientLogin" || mutation.type === "workerLogin") {
        this.getRecord();
      }
    });
  },
};
</script>

<style>
.patient-join-make_ttl {
  margin: auto;
  width: 500px;
  height: auto;
  text-align: center;
}
.patient-join-make_ttl h2 {
  font-size: 50px;
}
.patient-join-make_ttl p {
  text-align: left;
  font-size: 14px;
}
.patient-join-record_ttl {
  margin: auto;
  width: 500px;
  height: auto;
  text-align: center;
}
.patient-join-record {
  margin: 30px 100px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(233, 245, 255);
  border-radius: 10px;
  padding: 50px;
}
.patient-join-record h3 {
  font-size: 30px;
}
.patient-join-record p {
  margin-top: 20px;
  font-size: 16px;
  color: #a80000;
  line-height: 20px;
}
.patient-join-record ul {
  margin: 20px;
  display: block;
  text-align: center;
}
.patient-join-record ul li {
  display: list-item;
  margin: 10px;
  list-style: none;
  text-align: center;
}
.patient-join-record ul li p {
  display: inline-block;
  width: fit-content;
  font-size: 20px;
  text-decoration: underline;
}
.patient-join-record ul li p:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
.patient-join-make {
  margin: 10px 50px 0 50px;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}
.patient-join,
.patient-make {
  margin: 20px;
  display: flex;
  justify-content: center;
}
.patient-join_box,
.patient-make_box {
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(233, 245, 255);
  border-radius: 10px;
  padding: 50px;
}
.patient-join_box_ttl,
.patient-make_box_ttl {
  font-size: 30px;
}
.patient-make_box_content,
.patient-join_box_content {
  margin-top: 10px;
  font-size: 12px;
}
.patient-join_box_input_ttl {
  font-size: 20px;
}
.patient-join_box input {
  margin: 10px;
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.patient-join__btn {
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
.patient-join__btn:disabled {
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
.patient-make_box {
  background-color: rgb(211, 252, 237);
}
.patient-make_box .nuxt-link {
  margin-top: 50px;
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
</style>