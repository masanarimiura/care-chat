import createPersistedState from 'vuex-persistedstate'

export default ({ store }) => {
  createPersistedState({
    key: 'make-persisted-state',
    storage: window.sessionStorage
  })(store)
}