import createPersistedState from 'vuex-persistedstate'

export default ({ store }) => {
  createPersistedState({
    key: 'joinedPatientIdmake-persisted-store'
  })(store)
}