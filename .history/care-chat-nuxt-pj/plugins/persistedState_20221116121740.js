import createPersistedState from 'vuex-persistedstate'
// 画面リロード時にvuexの内容がリセットされないようにする。

export default ({ store }) => {
  createPersistedState({
    key: 'make-persisted-state',
    // デフォルトではローカルストレージに保管されるため、
    storage: window.sessionStorage,
  })(store)
}