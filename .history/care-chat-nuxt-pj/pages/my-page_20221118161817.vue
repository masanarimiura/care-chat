<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="my-page">
      <div class="my-page_box">
        <Wo>
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
.worker_box div {
  margin-top: 20px;
}
.worker_box p {
  font-size: 20px;
}
.worker_box .img-box img {
  width: 100px;
}
</style>