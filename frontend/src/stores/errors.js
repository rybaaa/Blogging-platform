import { ref } from 'vue'
import { defineStore } from 'pinia'

export const errorsStore = defineStore('errors', () => {
  let errors = ref({})
  let frontendErrors = ref({})

  function eraseErrors() {
    errors.value = {}
    frontendErrors.value = {}
  }

  function setErrors(newErrors) {
    errors.value = newErrors
  }

  function getError(key) {
    return errors.value[key]? errors.value[key][0] : null
  }

  function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if(!emailPattern.test(email)){
      frontendErrors.value.email = ['The email field must be a valid email address.']
    }    
  }

  function validatePassword(password) {
    if (password.length < 8) {
      frontendErrors.value.password = ['The email field must be a valid email address.']
    }
  }

  function validateName(name) {
    if(!name.length){
      frontendErrors.value.name = ['The field is required']
    }
  }

  function validateSurname(surname) {
    if(!surname.length){
      frontendErrors.value.surname = ['The field is required']
    }
  }

  function validateCvv(cvv, cardNumber) {
    if(!cvv.length ){
      frontendErrors.value.cvv = ['The field is required']
    } else if(hasNonDigitSymbols(cvv)) {
      frontendErrors.value.cvv = ['Wrong CVV']
    } else if (cardNumber.startsWith('34') || cardNumber.startsWith('37')) {
      if(cvv.length !== 4) {
        frontendErrors.value.cvv = ['CVV is wrong']
      }      
    } else if (cvv.length !== 3){
      frontendErrors.value.cvv = ['Wrong CVV']
    }
  }

  function validateCardNumber(cardNumber) {
    if(!cardNumber.length ){
      frontendErrors.value.credit_card_number = ['The field is required']
    } else if (cardNumber.length!== 16 || cardNumber.length!== 19 || hasNonDigitSymbols(cardNumber)) {
      frontendErrors.value.credit_card_number = ['Card number should be between 16 and 19 digits long']
    }
  }

  function validateDate(month, year) {
    const date = new Date();
    const monthNow = date.getMonth() + 2;
    const yearNow = date.getFullYear().toString().slice(2);
    console.log(+month, monthNow);
    if (hasNonDigitSymbols(month) || hasNonDigitSymbols(year)) {
      frontendErrors.value.expiry_date = ['Wrong date, digits only']
    } else if (month.length !== 2 || year.length !== 2) {
      frontendErrors.value.expiry_date = ['Wrong format']
    } else if (+month > 12 || +month === 0) {
      frontendErrors.value.expiry_date = ['Wrong date']
    } else if (+year < yearNow) {
      frontendErrors.value.expiry_date = ['The card is expired']
    } else if (+year == yearNow) {
      console.log('test');
        if (+month < monthNow) {
          frontendErrors.value.expiry_date = ['The card is expired']
        }
    }
  }

  function validateArticleTitle(title) {
    if(!title.length){
      frontendErrors.value.title = ['The field is required']
    }
  }

  function validateSubscription(name, surname, cvv, cardNumber, expiryMonth, expiryYear) {
    validateName(name)
    validateSurname(surname)
    validateCvv(cvv, cardNumber)
    validateCardNumber(cardNumber)
    validateDate(expiryMonth, expiryYear)
  }

  const hasNonDigitSymbols = (str) => {
    const pattern = /\D/;
    return pattern.test(str);
}

  function validateAll() {
    if(isEmptyObject(frontendErrors.value)){
      return true
    } else {
      errors.value = frontendErrors.value
    }
  }

  function isEmptyObject(obj) {
    for (const key in obj) {
      if (obj.hasOwnProperty(key)) {
        return false; 
      }
    }
    return true; 
  }

  return { 
    errors,
    eraseErrors,
    setErrors, 
    getError, 
    validateEmail, 
    validatePassword, 
    validateName, 
    validateAll, 
    validateCvv, 
    validateCardNumber, 
    validateSurname,
    validateDate,
    validateArticleTitle,
    validateSubscription,
    frontendErrors }
})
