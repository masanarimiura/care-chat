import createPersistedState from 'vuex-persistedstate'

export default ({ store }) => {
  createPersistedState({
    key: 'joinedPatientIPersistedSt'
  })(store)
}