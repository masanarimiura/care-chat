<template>
  <div v-if="$store.state.clientOrWorker == 'client'" class="client_box">
    <div class="img-box">
      <img v-if="clientInfo.icon_path == null" src="../img/client.jpg" alt="client" class="icon-default" />
      <img v-if="clientInfo.icon_path" :src="`${$axios.defaults.baseURL}${clientInfo.icon_path}`" alt="client-icon" class="icon-own" />
      <span @click="showUpdateIcon(clientInfo.icon)" class="editable">
        <img src="../img/update.jpg" alt="update" />
      </span>
    </div>
    <div class="name-box">
      <p class="username">アカウント名:{{ clientInfo.name }}
        <span @click="showUpdateName(clientInfo.name)" class="editable">
          <img src="../img/update.jpg" alt="update" />
        </span>
      </p>
    </div>
    <div class="email-box">
      <p class="email">メールアドレス:{{ clientInfo.email }}
        <span @click="showUpdateEmail(clientInfo.email)" class="editable">
          <img src="../img/update.jpg" alt="update" />
        </span>
      </p>
    </div>
    <div class="number-box">
      <p v-if="clientInfo.number" class="number">
        電話番号:{{ clientInfo.number
        }}<span @click="showUpdateNumber(clientInfo.number)" class="editable"
          ><img src="../img/update.jpg" alt="update"
        /></span>
      </p>
      <p v-if="clientInfo.number == null">
        電話番号:
        <span @click="showUpdateNumber()" class="editable"
          >未登録<img src="../img/update.jpg" alt="update"
        /></span>
      </p>
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
                  <span v-if="relation.client_id == clientInfo.id" class="editable">
                    {{relation.relation_type.name}}<img src="../img/update.jpg" alt="update" 
                    @click="showUpdateRelation(record.patient.id)" />
                  </span>
                </span>
              </span>
              <span v-if="record.patient.relations.some((u) => u.client_id != [clientInfo.id])||record.patient.relations.length == 0" class="editable" @click="showUpdateRelation(record.patient.id)">
                未登録<img src="../img/update.jpg" alt="update" />
              </span>
            </p>
          </li>
        </ul>
      </div>
      <div v-if="clientInfo.client_patients == 0" class="relation-info-box">
        <p class="relation-unregister">チャットへの参加がまだありません。</p>
      </div>
    </div>
    <ClientMyPageModal
      :propsModal="{
        clientIcon,
        clientName,
        clientEmail,
        clientPhoneNumber,
        clientRelationPatientId,
      }"
    ></ClientMyPageModal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clientInfo: "",
      clientIcon: "",
      clientName: "",
      clientEmail: "",
      clientPhoneNumber: "",
      clientRelationPatientId: "",
    };
  },
  methods: {
    // loginUserIdからclientの情報を取得
    async getClientInfo() {
      const clientId = {
        id: this.$store.state.loginUserId,
      };
      const getClientInfo = await this.$axios.get(
        "http://127.0.0.1:8000/api/v1/client-search",
        { params: clientId }
      );
      this.clientInfo = getClientInfo.data.data;
    },
    // clients の name、number、relation_type の登録、更新のモーダル画面の出し入れ。
    showUpdateIcon(Icon) {
      this.clientIcon = Icon;
      this.$modal.show("modal-update-icon");
    },
    showUpdateName(Name) {
      this.clientName = Name;
      this.$modal.show("modal-update-name");
    },
    showUpdateEmail(Email) {
      this.clientEmail = Email;
      this.$modal.show("modal-update-email");
    },
    showUpdateNumber(PhoneNumber) {
      this.clientPhoneNumber = PhoneNumber;
      this.$modal.show("modal-update-number");
    },
    showUpdateRelation(RelationPatientId) {
      this.clientRelationPatientId = RelationPatientId;
      this.$modal.show("modal-update-relation");
    },
  },
  mounted() {
    // clientかworkerを判断して、情報の取得をする
    if (this.$store.state.clientOrWorker == "client") {
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
.client_box .img-box .icon-default {
  width: 100px;
}
.client_box .img-box .icon-own {
  max-width: 120px;
  max-height: 120px;
  border-radius:50%;
  margin: 0 auto;
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