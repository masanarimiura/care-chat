<template>
  <div>
    <div class="header-in_outer">
      <div class="header-in">
        <div class="header-in_logo">
          <NuxtLink to="/patient-index" class="nuxt-link">
            <img src="../img/logo.jpg" class="header-in_img" />
            <div class="header-in_ttl">
              <h2>Care</h2>
              <h2>Chat</h2>
            </div>
          </NuxtLink>
          <div class="vuex-check" @click="vuexCheck()">
            <p>Vuex-check</p>
          </div>
        </div>
        <div class="username-hamburger" @click="navOpen = !navOpen" :class="{ open: navOpen }">
          <div class="username">
            <p v-if="this.$store.state.clientOrWorker == 'client'">
              アカウント:クライアント
            </p>
            <p v-if="this.$store.state.clientOrWorker == 'worker'">
              アカウント:ケアワーカー
            </p>
            <p>アカウント名：{{ this.$store.state.loginUserName }}</p>
          </div>
          <div class="hamburger">
            <div class="menu">
              <span class="menu__line--top"></span>
              <span class="menu__line--middle"></span>
              <span class="menu__line--bottom"></span>
            </div>
          </div>
        </div>
      </div>
      <div
        class="drawer-back"
        :class="{ open: navOpen }"
        @click="navOpen = false"
      ></div>
      <div class="drawer" :class="{ open: navOpen }">
        <nav>
          <ul>
            <li v-if="$store.state.joinedPatientId == !null">
              <p
                @click="showPatientInfo()"
                @click.native="navOpen = false"
                >このチャットのパスワードを表示</p
              >
            </li>
            <li>
              <NuxtLink to="my-page" @click.native="navOpen = false"
                >マイページへ</NuxtLink
              >
            </li>
            <li>
              <NuxtLink to="patient-index" @click.native="navOpen = false"
                >他のチャットへ移動する</NuxtLink
              >
            </li>
            <li>
              <p @click="logout();navOpen = false;">ログアウト</p>
            </li>
          </ul>
        </nav>
      </div>
    </div>




    <modal name="modal-patient-info" height="auto">
      <div class="modal-header">
        <h2>チャットID、パスワードの確認</h2>
      </div>
      <div class="modal-body">
        <div class="thanks">
          <div class="thanks_box">
            <h3 class="thanks_box_ttl">チャット管理は下記をご確認下さい。</h3>
            <p class="thanks_box_content">チャットID:</p>
            <p class="thanks_box_content_name">{{ this.patientName }}</p>
            <p class="thanks_box_content">チャットパスワード:</p>
            <p class="thanks_box_content_name">{{ this.patientPassword }}</p>
            <p class="thanks_box_content">上記の内容を一緒にご利用されたい方への共有をお願いします。</p>
            <p class="thanks_box_btn" @click="backChat()">チャットID:「{{ this.patientName }}」へ戻る</p>
          </div>
        </div>
        <p v-on:click="hidePatientInfo()" class="hide-btn">編集を中止する</p>
      </div>
    </modal>
    







  </div>
</template>

<script>
import firebase from "~/plugins/firebase";
export default {
  data() {
    return {
      navOpen: false,
      patientId: "",
      patientName: "",
      patientPassword: "",
    };
  },
  methods: {
    logout() {
      firebase
        .auth()
        .signOut()
        .then(() => {
          this.$store.commit("logout");
        });
    },
    vuexCheck() {
      console.log("loginUserId: " + this.$store.state.loginUserId);
      console.log("loginUserName: " + this.$store.state.loginUserName);
      console.log("userUid: " + this.$store.state.userUid);
      console.log("loggedIn: " + this.$store.state.loggedIn);
      console.log("clientOrWorker: " + this.$store.state.clientOrWorker);
      console.log("joinedPatientId: " + this.$store.state.joinedPatientId);
    },
    backChat() {
      this.$router.replace('patient-chat');
    },
    // patient_id からpatientの情報を検索
    async getPatientInfo(){
      this.patientId = this.$store.state.joinedPatientId;
      const getPatientInfo = await this.$axios.get("http://127.0.0.1:8000/api/v1/patient/" + this.patientId );
      this.patientName = getPatientInfo.data.data.name;
      this.patientPassword = getPatientInfo.data.data.password;
    },
    showPatientInfo() {
      this.$modal.show("modal-patient-info");
    },
    hidePatientInfo() {
      this.$modal.hide("modal-patient-info");
    },
  },
  async created() {
    // firebase のログインチェックとログイン情報の取得
    await this.$store.dispatch("onAuth");
    // patient_id からpatientの情報を検索
    this.getPatientInfo();
  },
  beforeDestroy(){
    this.$store.commit("resetJoinPatientId");
  },
};
</script>

<style>
.header-in_outer {
  height: 100px;
}
.header-in {
  position: fixed;
  top: 0;
  z-index: 5;
  width: 100%;
  display: flex;
  justify-content: space-between;
  box-shadow: 0 0 5px 0 #999;
  background-color: #ffffbe;
}
.header-in_logo {
  padding-top: 1px;
  padding-left: 10px;
}
.header-in_logo .nuxt-link {
  text-decoration: none;
  display: flex;
}
.header-in_img {
  display: block;
  width: auto;
  height: 60px;
}
.header-in_ttl {
  font-size: 30px;
  padding-top: 0px;
  padding-left: 5px;
  display: inline-block;
  color: rgb(42, 171, 191);
}
.username-hamburger {
  position: relative;
  cursor: pointer;
}
.username-hamburger .username {
  position: absolute;
  top: 20px;
  right: 50px;
  width: 200px;
}
.username-hamburger .username p {
  display: inline-block;
  font-size: 16px;
  font-weight: bold;
}
.username-hamburger .hamburger {
  position: absolute;
  top: 20px;
  right: 20px;
}
.menu {
  display: inline-block;
  width: 36px;
  height: 32px;
  position: relative;
  right: 0px;
  top: 0px;
  z-index: 3;
  cursor: pointer;
}
.menu__line--top,
.menu__line--middle,
.menu__line--bottom {
  display: inline-block;
  width: 100%;
  height: 4px;
  background-color: rgb(42, 171, 191);
  position: absolute;
  transition: 0.5s;
}
.menu__line--top {
  top: 0;
}
.menu__line--middle {
  top: 14px;
}
.menu__line--bottom {
  bottom: 0;
}
.username-hamburger.open span:nth-of-type(1) {
  top: 14px;
  transform: rotate(45deg);
}
.username-hamburger.open span:nth-of-type(2) {
  opacity: 0;
}
.username-hamburger.open span:nth-of-type(3) {
  top: 14px;
  transform: rotate(-45deg);
}
.drawer {
  position: fixed;
  top: 0;
  right: 0;
  z-index: 2;
  width: 400px;
  height: 100vh;
  transform: translateX(100%);
  background-color: #ffff83;
  transition: 0.5s;
  box-shadow: 0 0 5px 0 #999;
}
.drawer nav {
  margin-top: 100px;
}
.drawer nav li {
  margin: 30px;
  font-size: 20px;
}
.drawer nav li a,.drawer nav li p{
  color: rgb(42, 171, 191);
  text-decoration: underline;
}
.drawer nav li a:hover,.drawer nav li p:hover{
  color: #a80000;
  cursor: pointer;
}
.drawer.open {
  transform: translateX(0%);
}
.drawer-back {
  position: fixed;
  display: none;
  top: 0;
  left: 0;
  z-index: 2;
  width: 100%;
  height: 100%;
  background: black;
  opacity: 0.5;
}
.drawer-back.open {
  display: block;
}







.modal-header,
.modal-body {
  padding: 5px 25px;
}
.modal-header {
  border-bottom: 1px solid #ddd;
  font-size: 20px;
}
.modal-body .hide-btn {
  list-style: none;
  font-size: 14px;
  cursor: pointer;
  text-decoration: underline;
}
.modal-body .hide-btn:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}
.modal-body .update-name {
  position: static;
  z-index: 1;
  width: 100%;
  box-shadow: none;
  background-color: #ffffff;
  text-align: center;
}
.modal-body .update-name input {
  height: 30px;
  margin: 30px;
  font-size: 26px;
  border: 2px solid rgb(42, 171, 191);
  border-radius: 10px;
}
.modal-body .update-name_btn {
  margin-bottom: 10px;
  width: auto;
  border-radius: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
  background: rgb(42, 171, 191);
  color: #fff;
  border: 1px solid rgb(28, 117, 131);
  cursor: pointer;
}




.thanks{
  display: flex;
  justify-content: center;
}
.thanks_box{
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 50px;
}
.thanks_box_ttl{
  line-height: 50px;
  font-size: 30px;
  padding-bottom: 50px;
}
.thanks_box_content{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
}
.thanks_box_content_name{
  line-height:40px;
  font-size: 30px;
  color: rgb(167, 0, 0);
}
.thanks_box_btn{
  margin-top: 10px;
  line-height:40px;
  font-size: 20px;
  color: rgb(0, 0, 238);
  text-decoration:underline;
  cursor: pointer;
}
.thanks_box_btn:hover {
  background-color: transparent;
  color: #a80000;
  cursor: pointer;
}




</style>