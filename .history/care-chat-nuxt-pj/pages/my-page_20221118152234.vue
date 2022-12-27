<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="my-page">
      <div class="my-page_box">
        <div class="img-box">
          <img src="../img/worker.png" alt="worker" />
        </div>
        <div class="name-box">
          <p class="username">アカウント名:{{ $store.state.loginUserName }}</p>
        </div>
        <div class="email-box">
          <p class="email">メールアドレス:</p>
        </div>
        <div class="number-box">
          <p class="number">電話番号:</p>
        </div>
        <div
          v-if="$store.state.clientOrWorker == 'client'"
          class="relation-box"
        >
          <p class="relation">本人との関係:</p>
        </div>
        <div v-if="$store.state.clientOrWorker == 'worker'" class="role-box">
          <p class="role">職種:</p>
        </div>
        <div v-if="$store.state.clientOrWorker == 'worker'" class="shop-box">
          <p class="shop">所属事業所情報</p>
          <p class="shop-name">事業所名:</p>
          <p class="shop-type">分類:</p>
          <p class="shop-email">メールアドレス:</p>
          <p class="shop-number">電話番号:</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      workerInfos: {},
    };
  },
  methods: {
    async getClientInfo() {
    },
    async getWorkerInfo() {
      // loginUserIdからworkerの情報を取得
      const workerId ={

       this.$store.state.loginUserId}
      const getWorkerInfo = await this.$axios.get("http://127.0.0.1:8000/api/v1/worker-search" ,{ params: workerId });
      this.workerInfos = getWorkerInfo.data.data;
    },
  },
  async created() {
    // firebaseのログインチェック
    this.$store.dispatch("onAuth");
  },
  mounted() {
    // clientかworkerを判断して、情報の取得をする
    if(this.$store.state.clientOrWorker =='client'){
      this.getClientInfo();
    } else if(this.$store.state.clientOrWorker =='worker'){
      this.getWorkerInfo();
    }
  },
};
</script>

<style>
.my-page {
  display: flex;
  justify-content: center;
}
.my-page_box {
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 30px;
}
.my-page_box div {
  margin-top: 20px;
}
.my-page_box p {
  font-size: 20px;
}
.my-page_box .img-box img {
  width: 100px;
}
</style>