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
        </div>
        <div
          class="username-hamburger"
          @click="navOpen = !navOpen"
          :class="{ open: navOpen }"
        >
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
                @click="
                  navOpen = false;
                  openModalToMyPage();
                "
              >
                このチャットのパスワードを表示
              </p>
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
              <p
                @click="
                  logout();
                  navOpen = false;
                "
              >
                ログアウト
              </p>
            </li>
          </ul>
        </nav>
      </div>
    </div>
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
          this.$router.replace("/");
        });
    },
    // 親のpatient-chat.vueに送る
    openModalToMyPage() {
      this.$emit("openModal");
    },
  },
  async created() {
    // firebase のログインチェックとログイン情報の取得
    await this.$store.dispatch("onAuth");
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
@media screen and (max-width: 768px) {
  .header-in_outer {
    height: 50px;
  }
  .header-in_img {
    height: 40px;
  }
  .header-in_ttl {
    font-size: 20px;
  }
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
@media screen and (max-width: 768px) {
  .username-hamburger .username {
    top: 4px;
    right: 30px;
    width: 160px;
  }
  .username-hamburger .username p {
    font-size: 12px;
  }
  .username-hamburger .hamburger {
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
.drawer nav li a,
.drawer nav li p {
  color: rgb(42, 171, 191);
  text-decoration: underline;
}
.drawer nav li a:hover,
.drawer nav li p:hover {
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
</style>