import createPersistedState from 'vuex-persistedstate'
// 画面リロード時にvuex.storeの内容がリセットされないようにする。

export default ({ store }) => {
  createPersistedState({
    key: 'make-persisted-state',
    // デフォルトではローカルストレージに保管されるため、セッションに保存先を変更。
    storage: window.sessionStorage,
  })(store)
}