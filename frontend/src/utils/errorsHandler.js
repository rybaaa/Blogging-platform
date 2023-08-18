import { errorAlert } from './alerts'

export default (error, errorsStore) => {
  if (error.response.status == 422) {
    errorsStore.setErrors(error.response.data.errors)
    errorAlert(error.response.data.message)
  } else if (error.response.status == 500) {
    errorAlert('Unexpected error')
  } else if (error.response.status == 403) {
    errorAlert(error.response.data.message)
  } else if (error.response.status == 401) {
    errorsStore.setErrors(error.response.data)
    errorAlert('You are not authorized')
  } else {
    errorAlert('Unexpected error')
  }
}
