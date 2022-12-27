<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="login-register_ttl">
      <p>patient_id:{{ this.$store.state.joinedPatientId }}</p>
      <p>チャットID:</p>
      <h2>「◯◯◯◯」</h2>
    </div>
    <div class="section">
      <div class="oneArea">
        <div class="onebox">
          <div class="imgArea">
            <img src="../img/worker.png" alt="worker" />
            <p class="worker_name">作業療法士:三浦雅成</p>
          </div>
          <div class="fukiArea">
            <div class="fukidasi">
              <p>
                こんにちは。◯◯◯◯様の最近の状況報告です。書くことで頭の中を整理できて、気持ちのリフレッシュにもなる日記。振り返ってみると、平凡に感じていた日常も意外な「気づき」に溢れているはず。日付を自分で書き込む「フリータイプ」や、毎日コツコツ書く「連用タイプ」、お子様の成長を記録する「育児日記」など種類豊富に取り揃えています。
              </p>
              <p class="datetime">2022.12.22 11:11</p>
            </div>
          </div>
        </div>
        <div class="onebox">
          <div class="imgArea">
            <img src="../img/client.png" alt="client" />
            <p class="client_name">娘:三浦仁子</p>
          </div>
          <div class="fukiArea">
            <div class="fukidasi">
              <p>
                こんにちは。◯◯◯◯様の最近の状況報告です。書くことで頭の中を整理できて、気持ちのリフレッシュにもなる日記。振り返ってみると、平凡に感じていた日常も意外な「気づき」に溢れているはず。日付を自分で書き込む「フリータイプ」や、毎日コツコツ書く「連用タイプ」、お子様の成長を記録する「育児日記」など種類豊富に取り揃えています。
              </p>
              <p class="datetime">2022.12.22 12:34</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      patient_id: "",
    };
  },
  methods: {},
  created() {
    // firebaseのログインチェック
    this.$store.dispatch("onAuth");
    this.patient_id = this.$store.state.joinedPatientId;
    const patientId = this.patient_id;
    const getPatientInfo = await this.$axios.get(
      "http://127.0.0.1:8000/api/v1/patient-show",
      { params: patientId }
    );
    this.newPatientId = getPatientInfo.data.data.id;
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
.oneArea {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  max-width: 1024px;
  margin: 50px auto;
  padding: 0 10px;
}
.oneArea .onebox {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
}
.oneArea .onebox:nth-child(even) {
  flex-direction: row-reverse;
  margin-top: 20px;
}
.oneArea .onebox .imgArea {
  width: 16%;
  position: relative;
}
.oneArea .onebox .imgArea img {
  width: 100%;
  max-width: 130px;
  position: absolute;
  top: 30px;
}
.oneArea .onebox .imgArea .worker_name {
  position: absolute;
  top: 0px;
  color: rgb(80, 36, 0);
}
.oneArea .onebox .imgArea .client_name {
  position: absolute;
  top: 0px;
  left: 40px;
  color: rgb(80, 36, 0);
}
.oneArea .onebox:nth-child(odd) .imgArea img {
  left: 0;
  padding-right: 30px;
}
.oneArea .onebox:nth-child(even) .imgArea img {
  right: 0;
  padding-left: 30px;
}
.oneArea .onebox .fukiArea {
  width: 63%;
}
.oneArea .onebox .fukidasi {
  width: 100%;
  position: relative;
  padding: 25px;
  background-color: rgb(233, 245, 255);
  font-size: 18px;
  color: rgb(80, 36, 0);
  border-radius: 12px;
  box-sizing: border-box;
}
.oneArea .onebox .fukidasi .datetime {
  text-align: right;
  font-size: 16px;
  padding-top: 10px;
}
.oneArea .onebox .fukidasi::before {
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
.oneArea .onebox:nth-child(odd) .fukidasi::before {
  left: -20px;
}
.oneArea .onebox:nth-child(even) .fukidasi {
  background-color: rgb(211, 252, 237);
}
.oneArea .onebox:nth-child(even) .fukidasi::before {
  right: -20px;
  border-color: transparent rgb(211, 252, 237) transparent transparent;
  transform: rotate(180deg);
}
@media screen and (max-width: 1024px) {
  .oneArea .onebox .imgArea img {
    max-width: 70%;
  }
  .oneArea .onebox .imgArea .worker_name,
  .client_name {
    font-size: 14px;
  }
  .oneArea .onebox .fukidasi {
    padding: 15px;
    font-size: 14px;
  }
  .oneArea .onebox .fukidasi::before {
    top: 8px;
  }
}
</style>