import firebase from '~/plugins/firebase'
export const state = () => ({
  loginUserId: '',
  userUid: '',
  loggedIn: false,
});

export const mutations = {
  sendLoginUserId(state, receiveUserId) {
    state.loginUserId = receiveUserId;
  },
  loginStatusChange(state, status) {
    state.loggedIn = status
  },
  setUserUid(state, userUid) {
    state.userUid = userUid
  },
};

export const actions = {
  login( {commit},{email,password} ) {
    firebase.auth()
      .signInWithEmailAndPassword(email, password)
      .then((result) => {
      const user = result.user
      commit('loginStateChange', true)
      commit('setUserUid', user.uid)
      this.$router.push('/tweet')
    }).catch((error) => {
      const errorCode = error.code
      console.log('error : ' + errorCode)
    });
  },
  async onAuth({ commit }) {
    firebase
    .auth()
      .onAuthStateChanged(user => {
        if (user) {
          // User is signed in, see docs for a list of available properties
          // https://firebase.google.com/docs/reference/js/firebase.User
          var uid = user.uid;
          // ...
        } else {
          // User is signed out
          // ...
        }
      user = user ? user : {}
      commit('setUserUid', user.uid)
      commit('loginStatusChange', user.uid ? true : false)
      const searchUid = {
        uid: user.uid
      }
      this.$axios
        .get("http://127.0.0.1:8000/api/v1/client", { params: searchUid } )
        .then((userData) => {
          this.id = userData.data.data.id;
          const userId = {
            id: this.id
          };
          commit('sendLoginUserId', userId.id)
        })
    })
  },
}