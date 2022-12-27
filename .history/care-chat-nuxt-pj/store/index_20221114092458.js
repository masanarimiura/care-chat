import firebase from '~/plugins/firebase'
export const state = () => ({
  // firebaseのログイン情報からvuexの「ログイン状態の変更」「worker_id or client_id の保管」「Uidの保管」の保持
  loginUserId: '',
  userUid: '',
  loggedIn: false,
  // ログインアカウントが「client_id」か「worker_id」かを見分ける情報を保持
  clientOrWorker: '',
});


export const mutations = {
  // firebaseのログイン情報からvuexの「ログイン状態の変更」「worker_id or client_id の保管」「Uidの保管」の変更
  sendLoginUserId(state, receiveUserId) {
    state.loginUserId = receiveUserId;
  },
  loginStatusChange(state, status) {
    state.loggedIn = status
  },
  setUserUid(state, userUid) {
    state.userUid = userUid
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
    state.userUid = '';
    loggedIn = false;
    clientOrWorker = '';
  },
};

export const actions = {
  // firebaseのアカウントのログイン
  async login( {commit},{email,password} ) {
    await firebase.auth()
    .signInWithEmailAndPassword(email, password)
    .then((result) => {
      const user = result.user
      // Vuexに「ログインid」「ログイン状態をtrue」と「firebaseのログインアカウントのuid」を保管しておく。
      commit('sendLoginUserId', user.id)
      commit('loginStateChange', true)
      commit('setUserUid', user.uid)
      // Vuexにログインアカウントが「client_id」か「worker_id」かを見分ける情報をを保管しておく。
      const searchUid = {
        uid: user.uid
      }
      this.$axios.get("http://127.0.0.1:8000/api/v1/client", { params: searchUid })
        .then((result) => {
          this.id = result.data.data.id;
          const userId = {
            id: this.id
          };
          commit('sendLoginUserId', userId.id)
          commit('clientLogin')
        })
      this.$axios
        .get("http://127.0.0.1:8000/api/v1/worker", { params: searchUid })
        .then((result) => {
          this.id = result.data.data.id;
          const userId = {
            id: this.id
          };
          commit('sendLoginUserId', userId.id)
          commit('workerLogin')
        })
    })
    .catch((error) => {
      // firebaseのログインに失敗した時の対応。とりあえずアラートで簡単に作ってるけど、エラーページに飛ぶ方がいいか？余裕があったら作る。
      const errorCode = error.code
      alert('error : ' + errorCode + 'ログインに失敗しました。メールアドレスとパスワードをご確認の上、再度お試し下さい。')
      this.$router.replace('/');
    });
  },

  // 認証ページのfirebaseのログインチェックとVuexの「id」「uid」「client or worker」「ログイン状態」の変更
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
              console
              if (result.data.data.id) {
                this.id = result.data.data.id;
                const userId = {
                id: this.id
              };
              } else {
                return
              }
          commit('sendLoginUserId', userId.id)
          commit('clientLogin')
          })
          this.$axios
          .get("http://127.0.0.1:8000/api/v1/worker", { params: searchUid })
          .then((result) => {
          this.id = result.data.data.id;
          const userId = {
            id: this.id
          };
          commit('sendLoginUserId', userId.id)
          commit('workerLogin')
          })
        } else {
          this.$router.replace('/').then(() => {
            alert('ログインアウトの状態です。再度ご利用になりたい場合はもう一度ログインをお願いします。')
          });
        }
    })
  },
}