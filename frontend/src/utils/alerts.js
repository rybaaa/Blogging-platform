import { toast } from 'vue3-toastify';

export const successAlert = (text) => {
    toast(text, {
      autoClose: 5000,
      position: toast.POSITION.BOTTOM_RIGHT,
      type: toast.TYPE.SUCCESS
    });
  }

export const errorAlert = (text) => {
toast(text, {
    autoClose: 5000,
    position: toast.POSITION.BOTTOM_RIGHT,
    type: toast.TYPE.ERROR
});
}