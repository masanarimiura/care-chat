import createPersistedState from 'vuex-persistedstate'

export default ({ store }) => {
  createPersistedState({
    key: 'joinedPatientIPersisted-store'
  })(store)
}