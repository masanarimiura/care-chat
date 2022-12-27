<template>
  <div v-if="$route.query.client_or_worker == 'worker'" class="worker_box">
    <div class="img-box">
      <img src="../img/worker.jpg" alt="worker" />
    </div>
    <div class="name-box">
      <p class="username">アカウント名:{{ workerInfo.name }}
      </p>
    </div>
    <div class="email-box">
      <p class="email">メールアドレス:{{ workerInfo.email }}
      </p>
    </div>
    <div class="number-box">
      <p v-if="workerInfo.number" class="number">
        電話番号:{{ workerInfo.number }}
      </p>
      <p v-if="workerInfo.number == null">
        電話番号:未登録
      </p>
    </div>
    <div class="role-box">
      <p v-if="workerInfo.role_id" class="role">
        職種:{{ workerInfo.role.name }}
      </p>
      <p v-if="workerInfo.role_id == null" class="role">職種:未登録</p>
    </div>
    <div class="shop-box">
      <p class="shop-ttl">-所属事業所情報-</p>
      <div v-if="workerInfo.shop_id == null" class="shop-info-box">
        <p class="shop-unregister" >現在、事業所に関する登録情報はありません。</p>
      </div>
      <div v-if="workerInfo.shop_id" class="shop-info-box">
        <p class="shop-name">事業所名:{{ workerInfo.shop.name }}</p>
        <p class="shop-type">分類:{{ workerInfo.shop.shop_type.name }}</p>
        <p v-if="workerInfo.shop.email" class="shop-email">
          メールアドレス:{{ workerInfo.shop.email }}
        </p>
        <p v-if="workerInfo.shop.email == null" class="shop-email">
          メールアドレス:未登録
        </p>
        <p v-if="workerInfo.shop.number" class="shop-number">
          電話番号:{{ workerInfo.shop.number }}
        </p>
        <p v-if="workerInfo.shop.number == null" class="shop-number">
          電話番号:未登録
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      workerInfo: "",
      workerName: "",
      workerEmail: "",
      workerPhoneNumber: "",
    };
  },
  methods: {
    async getWorkerInfo() {
      // route.query の worker_id からworkerの情報を取得
      const workerId = {
        id: this.$route.query.worker_id,
      };
      const getWorkerInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/worker-search",
        { params: workerId }
      );
      this.workerInfo = getWorkerInfo.data.data;
    },
  },
  mounted() {
    // clientかworkerを判断して、情報の取得をする
    if (this.$route.query.client_or_wo == "worker") {
      this.getWorkerInfo();
    }
  },
};
</script>

<style>
.worker_box p {
  font-size: 20px;
}
.worker_box .name-box,
.worker_box .email-box,
.worker_box .number-box,
.worker_box .role-box,
.worker_box .shop-box {
  margin-top: 20px;
}
.worker_box .img-box img {
  width: 100px;
}
.relation-info-box ul li {
  list-style: none;
}
.editable {
  position: relative;
  text-decoration: underline;
}
.editable:hover {
  color: #a80000;
  cursor: pointer;
}
.editable img {
  position: absolute;
  right: -22px;
  bottom: 2px;
  width: 16px;
  cursor: pointer;
}
</style>