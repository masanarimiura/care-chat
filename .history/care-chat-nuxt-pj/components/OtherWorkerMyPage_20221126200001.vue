<template>
  <div v-if="$route.query.client_or_worker == 'worker'" class="worker_box">
    <div class="img-box">
      <img src="../img/worker.jpg" alt="worker" />
    </div>
    <div class="name-box">
      <p class="username">アカウント名:{{ workerInfo.name }}
        <span @click="showUpdateName(workerInfo.name)" class="editable">
          <img src="../img/update.jpg" alt="update" />
        </span>
      </p>
    </div>
    <div class="email-box">
      <p class="email">メールアドレス:{{ workerInfo.email }}
        <span @click="showUpdateEmail(workerInfo.email)" class="editable">
          <img src="../img/update.jpg" alt="update" />
        </span>
      </p>
    </div>
    <div class="number-box">
      <p v-if="workerInfo.number" class="number">
        電話番号:{{ workerInfo.number }}
        <span @click="showUpdateNumber(workerInfo.number)" class="editable">
          <img src="../img/update.jpg" alt="update" />
        </span>
      </p>
      <p v-if="workerInfo.number == null">
        電話番号:
        <span @click="showUpdateNumber()" class="editable">
          未登録<img src="../img/update.jpg" alt="update" />
        </span>
      </p>
    </div>
    <div class="role-box">
      <p v-if="workerInfo.role_id" class="role">
        職種:{{ workerInfo.role.name }}
        <span @click="showUpdateRole(workerInfo.role_id)" class="editable">
          <img src="../img/update.jpg" alt="update" />
        </span>
      </p>
      <p v-if="workerInfo.role_id == null" class="role">
        職種:
        <span @click="showUpdateRole()" class="editable">
          未登録<img src="../img/update.jpg" alt="update" />
        </span>
      </p>
    </div>
    <div class="shop-box">
      <p class="shop-ttl">-所属事業所情報-
        <span @click="showUpdateShop()" class="editable">
          <img src="../img/update.jpg" alt="update" />
        </span>
      </p>
      <div v-if="workerInfo.shop_id == null" class="shop-info-box">
        <p @click="showUpdateShop()" class="shop-unregister editable" >
            現在、事業所に関する登録情報はありません。
        </p>
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
    <WorkerMyPageModal :propsModal="{workerName,workerEmail,workerPhoneNumber,workerInfo}"></WorkerMyPageModal>
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
      // loginUserIdからworkerの情報を取得
      const workerId = {
        id: this.$store.state.loginUserId,
      };
      const getWorkerInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/worker-search",
        { params: workerId }
      );
      this.workerInfo = getWorkerInfo.data.data;
    },
    // clients の name、number、relation_type の登録、更新のモーダル画面の出し入れ。
    showUpdateName(Name) {
      this.workerName = Name;
      this.$modal.show("modal-update-name");
    },
    showUpdateEmail(Email) {
      this.workerEmail = Email;
      this.$modal.show("modal-update-email");
    },
    showUpdateNumber(PhoneNumber) {
      this.workerPhoneNumber = PhoneNumber
      this.$modal.show("modal-update-number");
    },
    showUpdateRole(RoleId) {
      this.workerRoleId = RoleId
      this.$modal.show("modal-update-role_id");
    },
    showUpdateShop() {
      if(this.workerInfo.shop_id == null) {
        this.$modal.show("modal-update-shop_id");
      } else if (this.workerInfo.shop_id) {
        this.$modal.show("modal-update-shop_info");
      }
    },
  },
  mounted() {
    // clientかworkerを判断して、情報の取得をする
    if (this.$store.state.clientOrWorker == "worker") {
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