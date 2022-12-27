import createPersistedState from 'vuex-persistedstate'
// 画面リロード時にvuexの内容がリセットされないようにする。

export default ({ store }) => {
  createPersistedState({
    key: 'make-persisted-state',
    // デフォルトではローカルストレージに
    storage: window.sessionStorage,
  })(store)
}