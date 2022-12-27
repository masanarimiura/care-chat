import createPersistedState from 'vuex-persistedstate'
// vuex

export default ({ store }) => {
  createPersistedState({
    key: 'make-persisted-state',
    storage: window.sessionStorage,
  })(store)
}