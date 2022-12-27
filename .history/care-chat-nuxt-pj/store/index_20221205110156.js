import firebase from '~/plugins/firebase'

export const state = () => ({
  // firebaseのログイン情報からvuexの「ログイン状態の変更」「worker_id or client_id の保管」「Uidの保管」の保持
  loginUserId: '',
  loginUserName: '',
  userUid: '',
  loggedIn: false,
  // ログインアカウントが「client_id」か「worker_id」かを見分ける情報を保持
  clientOrWorker: '',
  // 参加している「patient_id」
  joinedPatientId: '',
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
  },

  // 現在joinしていたpatient_idの破棄
  resetJoinPatientId(state) {
    state.joinedPatientId = ''
  }
};

export const actions = {
  // 認証ページのfirebaseのログインチェックとVuexの「id」「name」「uid」「client or worker」「ログイン状態」の変更
  onAuth({ commit }) {
    firebase.auth().onAuthStateChanged(user => {
      if (user) {
        // メール認証がまだの場合、メールの再送
        if (user.emailVerified == false) {
          alert('メールアドレスの確認が取れませんでした。再度ログインをお試し下さい。')
          this.$router.replace('/');
        // メール認証済みなら処理の継続、vuex.storeにログインした情報保持する
        } else if (user.emailVerified == true) {
          user = user ? user : {}
          commit('setUserUid', user.uid)
          commit('loginStatusChange', user.uid ? true : false)
          const searchUid = {
            uid: user.uid
          }
          this.$axios
            .get("http://127.0.0.1:8000/api/v1/client-check", { params: searchUid })
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
            .catch((error) => {
              console.log(error.message)
              alert('エラーが発生しました。内容をご確認頂き、再度ログインをお願いします。n')
              this.$router.replace('/')
            })
          this.$axios.get("http://127.0.0.1:8000/api/v1/worker-check", { params: searchUid })
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
        }
      // ログインしていない場合、firebaseのログアウト時にvuexのストアもリセットする。
      } else {
        commit('logout')
        alert('ログインアウトしました。再度ご利用になりたい場合はもう一度ログインをお願いします。')
        this.$router.replace('/')
      }
    })
  },
}