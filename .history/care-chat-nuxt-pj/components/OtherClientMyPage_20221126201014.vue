<template>
  <div v-if="$route.query.client_or_worker == 'client'" class="client_box">
    <div class="img-box">
      <img src="../img/client.jpg" alt="client" />
    </div>
    <div class="name-box">
      <p class="username">アカウント名:{{ clientInfo.name }}
      </p>
    </div>
    <div class="email-box">
      <p class="email">メールアドレス:{{ clientInfo.email }}
      </p>
    </div>
    <div class="number-box">
      <p v-if="clientInfo.number" class="number">電話番号:{{ clientInfo.number }}
      </p>
      <p v-if="clientInfo.number == null">電話番号:未登録</p>
    </div>
    <div class="relation-box">
      <p class="relation-ttl">-チャットID対象者との関係性-</p>
      <div v-if="clientInfo.client_patients" class="relation-info-box">
        <ul>
          <li v-for="record in clientInfo.client_patients" :key="record.id">
            <p>
              {{ record.patient.name }}:
              <span v-if="record.patient.relations.some((u) => u.client_id == [clientInfo.id])">
                <span v-for="relation in record.patient.relations" :key="relation.id">
                  <span v-if="relation.client_id == clientInfo.id">
                    {{relation.relation_type.name}}
                  </span>
                </span>
              </span>
              <span v-if="record.patient.relations.some((u) => u.client_id != [clientInfo.id])||record.patient.relations.length == 0" >
                未登録
              </span>
            </p>
          </li>
        </ul>
      </div>
      <div v-if="clientInfo.client_patients == 0" class="relation-info-box">
        <p class="relation-unregister">チャットへの参加がまだありません。</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clientInfo: "",
    };
  },
  methods: {
    // パラメータのからclientの情報を取得
    async getClientInfo() {
      const clientId = {
        id: this.$route.query.client_id,
      };
      const getClientInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/client-search",
        { params: clientId }
      );
      this.clientInfo = getClientInfo.data.data;
    },
  },
  mounted() {
    // clientかworkerを判断して、情報の取得をする
    if (this.$route.query.client_or_worker == "client") {
      this.getClientInfo();
    }
  },
};
</script>

<style>
.client_box p {
  font-size: 20px;
}
.client_box .name-box,
.client_box .email-box,
.client_box .number-box,
.client_box .relation-box {
  margin-top: 20px;
}
.client_box .img-box img {
  width: 100px;
}
.relation-info-box ul li {
  list-style: none;
}
</style>