import createPersistedState from 'vuex-persistedstate'
// vuexの

export default ({ store }) => {
  createPersistedState({
    key: 'make-persisted-state',
    storage: window.sessionStorage,
  })(store)
}