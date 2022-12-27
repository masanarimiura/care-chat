import firebase from '~/plugins/firebase'
import createPersistedState from 'vuex-persistedstate'
export const state = () => ({
  // firebaseのログイン情報からvuexの「ログイン状態の変更」「worker_id or client_id の保管」「Uidの保管」の保持
  loginUserId: '',
  loginUserName: '',
  userUid: '',
  loggedIn: false,
  // ログインアカウントが「client_id」か「worker_id」かを見分ける情報を保持
  clientOrWorker: '',
  // 参加している「patient_id」
  joinedPatientIPersistedState: '',
});


export const mutations = {
  // firebaseのログイン情報からvuexの「ログイン状態の変更」「ログインid の保管」「ログインnameの保管」「Uidの保管」の変更
  sendLoginUserId(state, receiveUserId) {
    state.loginUserId = receiveUserId;
  },
  sendLoginUserName(state, receiveUserName) {
    state.loginUserName = receiveUserName;
  },
  loginStatusChange(state, receiveTrueOrFalse) {
    state.loggedIn = receiveTrueOrFalse
  },
  setUserUid(state, receiveUserUid) {
    state.userUid = receiveUserUid
  },

  // ログインアカウントが「client_id」か「worker_id」かを見分ける情報を変更
  clientLogin(state) {
    state.clientOrWorker = 'client';
  },
  workerLogin(state) {
    state.clientOrWorker = 'worker';
  },

  // firebaseからログアウト時「Vuexのログインに関する情報」のリセット
  logout(state) {
    state.loginUserId = '';
    state.loginUserName  = '';
    state.userUid = '';
    state.loggedIn = false;
    state.clientOrWorker = '';
    state.joinedPatientId = '';
  },

  // 現在joinしているpatient_idの保管
  SetJoinPatientId(state, receivePatientId) {
    state.joinedPatientId = receivePatientId
  }
};

export const actions = {
  // firebaseのアカウントのログイン
  async login( {commit},{email,password} ) {
    await firebase.auth()
    .signInWithEmailAndPassword(email, password)
    .catch((error) => {
      // firebaseのログインに失敗した時の対応。とりあえずアラートで簡単に作ってるけど、エラーページに飛ぶ方がいいか？余裕があったら作る。
      const errorCode = error.code
      alert('error : ' + errorCode + 'ログインに失敗しました。メールアドレスとパスワードをご確認の上、再度お試し下さい。')
      this.$router.replace('/');
    });
  },

  // 認証ページのfirebaseのログインチェックとVuexの「id」「name」「uid」「client or worker」「ログイン状態」の変更
  async onAuth({ commit }) {
    firebase.auth()
      .onAuthStateChanged(user => {
        if (user) {
          user = user ? user : {}
          commit('setUserUid', user.uid)
          commit('loginStatusChange', user.uid ? true : false)
          const searchUid = {
            uid: user.uid
          }
          this.$axios.get("http://127.0.0.1:8000/api/v1/client", { params: searchUid })
          .then((result) => {
            if (result.data.data != undefined) {
              this.id = result.data.data.id;
              this.name = result.data.data.name;
              const userIdName = {
                id: this.id,
                name: this.name
              }; 
              commit('sendLoginUserId', userIdName.id)
              commit('sendLoginUserName', userIdName.name)
              commit('clientLogin')
            } 
          })
          this.$axios
          .get("http://127.0.0.1:8000/api/v1/worker", { params: searchUid })
          .then((result) => {
            if (result.data.data != undefined) {
              this.id = result.data.data.id;
              this.name = result.data.data.name;
              const userIdName = {
                id: this.id,
                name: this.name
              }; 
              commit('sendLoginUserId', userIdName.id)
              commit('sendLoginUserName', userIdName.name)
              commit('workerLogin')
            }
          })
        } else {
          this.$router.replace('/').then(() => {
            alert('ログインアウトの状態です。再度ご利用になりたい場合はもう一度ログインをお願いします。')
          });
        }
    })
  },
}