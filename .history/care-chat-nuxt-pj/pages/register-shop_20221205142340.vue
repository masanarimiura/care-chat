<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="register-shop">
      <div class="register-shop_box">
        <h3 class="register-shop_box_ttl">所属事業所の新規登録</h3>
        <div class="form">
          <validation-observer ref="obs" v-slot="ObserverProps">
            <validation-provider v-slot="{ errors }" rules="required|max:100">
              <p class="register-shop_box_input_ttl">事業所名</p>
              <p class="register-shop_box_input_content">
                ※検索しやすいように病院名、法人名などは正確にご記入下さい。
              </p>
              <input
                v-model="name"
                type="text"
                name="事業所名"
                required
                placeholder="事業所名"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider
              rules="required"
              v-slot="{ errors }"
              name="事業所分類"
            >
              <div id="app">
                <div style="max-width: 400px; margin: 0 auto">
                  <p class="register-shop_box_input_ttl">事業所分類</p>
                  <FilterableDropdown
                    v-model="shopTypeId"
                    :items="items"
                    :showEmptyItem="true"
                    :disabled="false"
                    :ignoreCase="true"
                    emptyItemValue="-事業所分類は未選択です-"
                    emptyItemText=""
                    placeholder="-事業所分類を選択して下さい-"
                    name="事業所分類"
                    idKey="id"
                    valueKey="id"
                    textKey="name"
                    filterTargetKey="name"
                  >
                  </FilterableDropdown>
                </div>
              </div>
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider v-slot="{ errors }" rules="email|max:256">
              <p class="register-shop_box_input_ttl">
                メールアドレス <span class="small">※任意</span>
              </p>
              <input
                v-model="email"
                type="email"
                name="メールアドレス"
                placeholder="メールアドレス"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <validation-provider v-slot="{ errors }" rules="phone">
              <p class="register-shop_box_input_ttl">
                電話番号<span class="small">※任意</span>
              </p>
              <input
                v-model="number"
                type="tel"
                name="電話番号"
                placeholder="電話番号"
              />
              <div class="error">{{ errors[0] }}</div>
            </validation-provider>
            <button
              @click="registerShop()"
              class="register-shop_btn"
              :disabled="ObserverProps.invalid"
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
      name: null,
      shopTypeId: null,
      items: [],
      number: null,
      email: null,
    };
  },
  methods: {
    // 事業所分類選択のために shop_types の情報を取得
    async getShopTypeInfo() {
      const getShopTypeInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/shop_type"
      )
      .catch(() => {
          location.reload();
          alert("エラーが起きました。しばらくしてから再度お試しください。");
        });
      this.items = getShopTypeInfo.data.data;
    },
    // shops に事業所情報を登録
    async registerShop() {
      // 情報が足りない場合の対処
      if (!this.name || !this.shopTypeId) {
        alert("エラーが起きました。しばらくしてから再度お試しください。");
        this.$router.replace("/register-shop");
      } else {
        // shop_types に登録情報を送信
        const newShopInfo = {
          name: this.name,
          shop_type_id: this.shopTypeId,
          number: this.number,
          email: this.email,
        };
        const getShopId = await this.$axios.post(
          "http://127.0.0.1:8000/api/v1/shop",
          newShopInfo
        );
        // shops から登録したidを取得してworkersに登録
        const shopId = {
          shop_id: getShopId.data.data.id,
        };
        await this.$axios.put(
          "http://127.0.0.1:8000/api/v1/worker/" +
            this.$store.state.loginUserId,
          shopId
        );
        this.$router.replace("/thanks-register-shop");
      }
    },
  },
  created() {
    // vuex の clientOrWorker が worker かを確認してケアワーカーのみ作成可能にする。
    if (this.$store.state.clientOrWorker != "worker") {
      alert("エラーが発生しました。アカウント情報に誤りがあります。");
      this.$router.replace("my-page");
    }
    // shop_types を選択肢で使うために取得
    this.getShopTypeInfo();
  },
};
</script>

<style>
.register-shop {
  display: flex;
  justify-content: center;
}
.register-shop_box {
  width: 400px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
  margin-bottom: 100px;
}
.register-shop_box_ttl {
  font-size: 30px;
}
.register-shop_box_content {
  margin-top: 10px;
  font-size: 12px;
}
.register-shop_box .form {
  margin-top: 20px;
  text-align: center;
}
.register-shop_box_input_ttl {
  margin-top: 20px;
  font-size: 20px;
  font-weight: bold;
}
.register-shop_box_input_ttl .small {
  padding-left: 10px;
  font-size: 14px;
  font-weight: normal;
  color: #a80000;
}
.register-shop_box_input_content {
  font-size: 12px;
}
.register-shop_box input {
  width: 400px;
  height: 30px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.register-shop_btn {
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
</style>