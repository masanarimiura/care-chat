import createPersistedState from 'vuex-persistedstate'
// v

export default ({ store }) => {
  createPersistedState({
    key: 'make-persisted-state',
    storage: window.sessionStorage,
  })(store)
}