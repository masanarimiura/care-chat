import firebase from '~/plugins/firebase'
export const state = () => ({
  // アカウントのログイン状態の管理
  loginUserId: '',
  userUid: '',
  loggedIn: false,
  // クライアントかワーカーか見分ける状態
  workerOrClient: '',
});

export const mutations = {
  // アカウントのログイン状態の管理
  sendLoginUserId(state, receiveUserId) {
    state.loginUserId = receiveUserId;
  },
  loginStatusChange(state, status) {
    state.loggedIn = status
  },
  setUserUid(state, userUid) {
    state.userUid = userUid
  },

  // ログアウト時のユーザーID、UIDのリセット
  logout(state) {
    state.loginUserId = '';
    state.userUid = '';
    loggedIn = false;
    workerOrClient = '';
  },

  // クライアントかワーカーか見分ける
  clientLogin(state) {
    state.workerOrClient = 'client';
  },
  WorkerLogin(state) {
    state.workerOrClient = 'worker';
  },
};

export const actions = {
  // アカウントのログイン
  async login( {commit},{email,password} ) {
    await firebase
      .auth()
      .signInWithEmailAndPassword(email, password)
      .then((result) => {
      const user = result.user
      commit('loginStateChange', true)
      commit('setUserUid', user.uid)
      })
      .catch((error) => {
      const errorCode = error.code
      console.log('error : ' + errorCode)
    });
  },
  // アカウントのログインチェック
  async onAuth({ commit }) {
    firebase
      .auth()
      .onAuthStateChanged(user => {
        if (user) {
          user = user ? user : {}
          commit('setUserUid', user.uid)
          commit('loginStatusChange', user.uid ? true : false)
          const searchUid = {
            uid: user.uid
          }
          this.$axios
          .get("http://127.0.0.1:8000/api/v1/client", { params: searchUid })
          .then((userData) => {
            this.id = userData.data.data.id;
            const userId = {
              id: this.id
            };
            if (userId.id == '') {
              commit('sendLoginUserId', userId.id)
              commit('clientLogin')
            } else {
              this.$axios
              .get("http://127.0.0.1:8000/api/v1/worker", { params: searchUid })
              .then((userData) => {
                this.id = userData.data.data.id;
                const userId = {
                  id: this.id
                };
                commit('sendLoginUserId', userId.id)
                commit('WorkerLogin')
              })
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