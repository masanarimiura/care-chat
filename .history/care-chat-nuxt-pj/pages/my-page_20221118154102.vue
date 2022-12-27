<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="my-page">
      <div class="my-page_box">

        <div v-if="$store.state.clientOrWorker == 'worker'" class="worker_box">
          <div class="img-box">
            <img src="../img/worker.png" alt="worker" />
          </div>
          <div class="name-box">
            <p class="username">アカウント名:{{ workerInfo.name }}</p>
          </div>
          <div class="email-box">
            <p class="email">メールアドレス:{{ workerInfo.email }}</p>
          </div>
          <div class="number-box">
            <p class="number">電話番号:{{ workerInfo.number }}</p>
          </div>
          <div class="role-box">
            <p class="role">職種:{{ workerInfo.number }}</p>
          </div>
          <div class="shop-box">
            <p class="shop">所属事業所情報</p>
            <p class="shop-name">事業所名:</p>
            <p class="shop-type">分類:</p>
            <p class="shop-email">メールアドレス:</p>
            <p class="shop-number">電話番号:</p>
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
      workerInfo: "",
    };
  },
  methods: {
    async getClientInfo() {},
    async getWorkerInfo() {
      // loginUserIdからworkerの情報を取得
      const workerId = {
        id: this.$store.state.loginUserId,
      };
      const getWorkerInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/worker-search",
        { params: workerId }
      );
      this.workerInfo = getWorkerInfo.data.data;
      console.log(this.workerInfo);
    },
  },
  async created() {
    // firebaseのログインチェック
    this.$store.dispatch("onAuth");
  },
  mounted() {
    // clientかworkerを判断して、情報の取得をする
    if (this.$store.state.clientOrWorker == "client") {
      this.getClientInfo();
    } else if (this.$store.state.clientOrWorker == "worker") {
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